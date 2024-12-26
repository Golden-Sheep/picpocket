<?php

namespace Picpocket\Transaction\Repository;

use Picpocket\Transaction\DTO\CreateTransactionDTO;
use Picpocket\Transaction\Enums\TransactionStatusEnum;
use Picpocket\Transaction\Model\Transaction;

/**
 * Interface TransactionRepositoryInterface
 *
 * Defines the contract for transaction repository operations.
 *
 * Author: Victor Silva
 * Email: dev.jvictor@gmail.com
 * GitHub: github.com/golden-sheep
 */
interface TransactionRepositoryInterface
{
    /**
     * Initiates a new transaction.
     */
    public function startTransaction(CreateTransactionDTO $payload): Transaction;

    /**
     * Updates the status of an existing transaction.
     *
     * @return bool Indicates whether the update was successful.
     */
    public function updateTransactionStatus(string $transactionId, TransactionStatusEnum $status): bool;
}
