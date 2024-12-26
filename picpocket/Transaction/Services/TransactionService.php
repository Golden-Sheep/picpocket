<?php

namespace Picpocket\Transaction\Services;

use Illuminate\Support\Facades\DB;
use Picpocket\Account\Service\AccountServiceInterface;
use Picpocket\Api\External\PaymentGateways\PaymentGatewayInterface;
use Picpocket\Notifications\Api\External\NotificationServiceInterface;
use Picpocket\Transaction\Actions\TransactionActionInterface;
use Picpocket\Transaction\DTO\CreateTransactionDTO;
use Picpocket\Transaction\Enums\TransactionStatusEnum;
use Picpocket\Transaction\Model\Transaction;
use Picpocket\Transaction\Services\Exceptions\TransactionServiceException;
use Picpocket\Wallet\Actions\WalletActionInterface;
use Picpocket\Wallet\Model\Wallet;
use Psr\Log\LoggerInterface;

/**
 * Class TransactionService
 *
 * Handles the business logic for processing transactions.
 *
 * Author: Victor Silva
 * Email: dev.jvictor@gmail.com
 * GitHub: github.com/golden-sheep
 */
class TransactionService implements TransactionServiceInterface
{
    public function __construct(
        private readonly WalletActionInterface $walletAction,
        private readonly TransactionActionInterface $transactionAction,
        private readonly PaymentGatewayInterface $picpayGatewayAPI,
        private readonly NotificationServiceInterface $picpayNotificationAPI,
        private readonly LoggerInterface $logger,
        private readonly AccountServiceInterface $accountService
    ) {}

    /**
     * Handle the transaction creation and processing.
     *
     * @throws TransactionServiceException
     */
    public function handle(CreateTransactionDTO $transactionDTO): bool
    {
        try {
            $this->logger->info('Starting transaction process', ['transactionDTO' => $transactionDTO]);

            $payerWallet = $this->getWallet($transactionDTO->payerId, 'Payer wallet not found');
            $this->validatePaymentConditions($payerWallet, $transactionDTO);

            return DB::transaction(fn () => $this->executeTransactionFlow($payerWallet, $transactionDTO));
        } catch (TransactionServiceException $exception) {
            $this->logAndRethrow('Transaction failed', $exception, $transactionDTO);

            return false;
        } catch (\Exception $exception) {
            $this->logAndRethrow('An unexpected error occurred during the transaction', $exception, $transactionDTO);

            return false;
        }
    }

    /**
     * Retrieve the wallet by ID or throw an exception if not found.
     *
     * @throws TransactionServiceException
     */
    private function getWallet(string $walletId, string $errorMessage): Wallet
    {
        $wallet = $this->walletAction->findById($walletId);

        if (! $wallet) {
            throw new TransactionServiceException($errorMessage);
        }

        return $wallet;
    }

    /**
     * Execute the entire transaction flow.
     *
     * @throws TransactionServiceException
     */
    private function executeTransactionFlow(Wallet $payerWallet, CreateTransactionDTO $transactionDTO): bool
    {
        $payeeWallet = $this->getWallet($transactionDTO->payeeId, 'Payee wallet not found');

        $transaction = $this->createTransaction($transactionDTO);
        $this->processTransaction($payerWallet, $payeeWallet, $transactionDTO->amount);
        $this->completeTransaction($transaction);
        $this->authorizePayment();
        $this->sendPaymentNotification();

        return true;
    }

    /**
     * Validate payment conditions before proceeding with the transaction.
     *
     * @throws TransactionServiceException
     */
    private function validatePaymentConditions(Wallet $payerWallet, CreateTransactionDTO $transactionDTO): void
    {
        if ($this->accountService->isAccountRetailer($payerWallet->account_id)) {
            throw TransactionServiceException::retailerNotAllowedToPay();
        }

        if (! $payerWallet->hasBalance($transactionDTO->amount)) {
            throw TransactionServiceException::outOfPocket();
        }
    }

    /**
     * Create a new transaction record.
     */
    private function createTransaction(CreateTransactionDTO $transactionDTO): Transaction
    {
        $transaction = $this->transactionAction->startTransaction($transactionDTO);
        $this->logger->info('Transaction created', ['transactionId' => $transaction->getKey()]);

        return $transaction;
    }

    /**
     * Process the transaction by transferring funds between wallets.
     */
    private function processTransaction(Wallet $payerWallet, Wallet $payeeWallet, int $amount): void
    {
        $this->walletAction->deposit($payeeWallet->getKey(), $amount);
        $this->walletAction->withdraw($payerWallet->getKey(), $amount);

        $this->logger->info('Transaction processed', [
            'payerId' => $payerWallet->getKey(),
            'payeeId' => $payeeWallet->getKey(),
            'amount' => $amount,
        ]);
    }

    /**
     * Mark the transaction as completed.
     */
    private function completeTransaction(Transaction $transaction): void
    {
        $this->transactionAction->updateTransactionStatus($transaction->getKey(), TransactionStatusEnum::Completed);
        $this->logger->info('Transaction marked as completed', ['transactionId' => $transaction->getKey()]);
    }

    /**
     * Authorize the payment via the payment gateway.
     *
     * @throws TransactionServiceException
     */
    private function authorizePayment(): void
    {
        if (! $this->picpayGatewayAPI->authorizePayment()) {
            throw TransactionServiceException::notAuthorizedByGateway($this->picpayGatewayAPI);
        }
        $this->logger->info('Payment authorized');
    }

    /**
     * Send a notification about the payment.
     *
     * @throws TransactionServiceException
     */
    private function sendPaymentNotification(): void
    {
        if (! $this->picpayNotificationAPI->sendNotificationPayment()) {
            throw TransactionServiceException::paymentMessageNotSent($this->picpayNotificationAPI);
        }
        $this->logger->info('Notification sent');
    }

    /**
     * Log the exception and rethrow it.
     *
     * @throws \Exception
     */
    private function logAndRethrow(string $message, \Throwable $exception, CreateTransactionDTO $transactionDTO): void
    {
        $this->logger->error($message, [
            'exception' => $exception->getMessage(),
            'trace' => $exception->getTraceAsString(),
            'transactionDTO' => $transactionDTO,
        ]);

        throw $exception;
    }
}
