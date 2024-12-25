<?php

namespace Picpocket\Transaction\Actions;

use Picpocket\Transaction\DTO\CreateTransactionDTO;
use Picpocket\Transaction\Enums\TransactionStatusEnum;
use Picpocket\Transaction\Model\Transaction;
use Picpocket\Transaction\Repository\TransactionRepositoryInterface;

/**
 * Class TransactionAction
 *
 * Handles the business logic for transactions by utilizing the TransactionRepository.
 *
 * Author: Victor Silva
 * Email: dev.jvictor@gmail.com
 * GitHub: github.com/golden-sheep
 */
class TransactionAction implements TransactionActionInterface
{
    /**
     * TransactionAction constructor.
     *
     * @param TransactionRepositoryInterface $transactionRepository
     */
    public function __construct(
        private readonly TransactionRepositoryInterface $transactionRepository
    ) {
    }

    /**
     * @inheritdoc
     */
    public function startTransaction(CreateTransactionDTO $payload): Transaction
    {
        return $this->transactionRepository->startTransaction($payload);
    }

    /**
     * @inheritdoc
     */
    public function updateTransactionStatus(string $transactionId, TransactionStatusEnum $status): bool
    {
        return $this->transactionRepository->updateTransactionStatus($transactionId, $status);
    }
}
