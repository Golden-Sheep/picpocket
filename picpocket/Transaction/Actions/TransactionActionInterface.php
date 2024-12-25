<?php

namespace Picpocket\Transaction\Actions;

use Picpocket\Transaction\DTO\CreateTransactionDTO;
use Picpocket\Transaction\Enums\TransactionStatusEnum;
use Picpocket\Transaction\Model\Transaction;

interface TransactionActionInterface
{
    /**
     * Starts a new transaction based on the provided payload.
     *
     * @param CreateTransactionDTO $payload
     * @return Transaction
     */
    public function startTransaction(CreateTransactionDTO $payload): Transaction;

    /**
     * Updates the status of a transaction.
     *
     * @param string $transactionId
     * @param TransactionStatusEnum $status
     * @return bool
     */
    public function updateTransactionStatus(string $transactionId, TransactionStatusEnum $status): bool;
}
