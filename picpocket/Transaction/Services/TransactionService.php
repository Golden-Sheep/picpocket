<?php

namespace Picpocket\Transaction\Services;

use Illuminate\Support\Facades\DB;

use Picpocket\Api\External\PaymentGateways\PaymentGatewayInterface;
use Picpocket\Notifications\Api\External\NotificationInterface;
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
        private readonly WalletActionInterface      $walletAction,
        private readonly TransactionActionInterface $transactionAction,
        private readonly PaymentGatewayInterface    $picpayGatewayAPI,
        private readonly NotificationInterface      $picpayNotificationAPI,
        private readonly LoggerInterface $logger
    )
    {
    }

    /**
     * @inheritdoc
     */
    public function handle(CreateTransactionDTO $transactionDTO): bool
    {
        try {
            $this->logger->info('Starting transaction process', ['transactionDTO' => $transactionDTO]);
            // Initial validations
            $payerWallet = $this->walletAction->findById($transactionDTO->payerId);
            $this->validatePaymentConditions($payerWallet, $transactionDTO);

            // Execute the database transaction
            return DB::transaction(function () use ($payerWallet, $transactionDTO) {
                $payeeWallet = $this->walletAction->findById($transactionDTO->payeeId);

                // Start the transaction
                $transaction = $this->createTransaction($transactionDTO);

                // Perform financial operations
                $this->processTransaction($payerWallet, $payeeWallet, $transactionDTO->amount);

                // Update transaction status
                $this->completeTransaction($transaction);

                // Authorize external payment
                $this->authorizePayment();

                // Send notification
                $this->sendPaymentNotification();

                return true;
            });
        } catch (TransactionServiceException $e) {
            // Log specific exceptions related to transactions
            $this->logger->error('Transaction failed', [
                'exception' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'transactionDTO' => $transactionDTO
            ]);

            throw $e;
        } catch (\Exception $e) {
            // Log unexpected exceptions
            $this->logger->error('An unexpected error occurred during the transaction', [
                'exception' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'transactionDTO' => $transactionDTO
            ]);

            // Rethrow the exception to escalate or handle gracefully
            throw $e;
        }
    }

    /**
     * Validates payment conditions.
     */
    private function validatePaymentConditions(Wallet $payerWallet, CreateTransactionDTO $transactionDTO): void
    {
        if ($payerWallet->isRetailerAccount()) {
            throw TransactionServiceException::retailerNotAllowedToPay();
        }

        if (!$payerWallet->hasBalance($transactionDTO->amount)) {
            throw TransactionServiceException::outOfPocket();
        }
    }

    /**
     * Creates a new transaction in the database.
     */
    private function createTransaction(CreateTransactionDTO $transactionDTO): Transaction
    {
        $transaction = $this->transactionAction->startTransaction($transactionDTO);
        $this->logger->info('Transaction created', ['transactionId' => $transaction->getKey()]);
        return $transaction;
    }

    /**
     * Processes debit and credit operations between wallets.
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
     * Marks the transaction as completed.
     */
    private function completeTransaction(Transaction $transaction): void
    {
        $this->transactionAction->updateTransactionStatus($transaction->getKey(), TransactionStatusEnum::Completed);
        $this->logger->info('Transaction marked as completed', ['transactionId' => $transaction->getKey()]);
    }

    /**
     * Authorizes the payment via a third-party gateway.
     */
    private function authorizePayment(): void
    {
        if (!$this->picpayGatewayAPI->authorizePayment()) {
            throw TransactionServiceException::notAuthorizedByGateway($this->picpayGatewayAPI);
        }
        $this->logger->info('Payment authorized');
    }

    /**
     * Sends a payment notification.
     */
    private function sendPaymentNotification(): void
    {
        if (!$this->picpayNotificationAPI->sendNotificationPayment()) {
            throw TransactionServiceException::paymentMessageNotSent($this->picpayNotificationAPI);
        }
        $this->logger->info('Notification sent');
    }
}
