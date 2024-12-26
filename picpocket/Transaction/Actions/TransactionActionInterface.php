<?php

namespace Picpocket\Transaction\Actions;

use Picpocket\Transaction\DTO\CreateTransactionDTO;
use Picpocket\Transaction\Enums\TransactionStatusEnum;
use Picpocket\Transaction\Model\Transaction;

interface TransactionActionInterface
{
    /**
     * Starts a new transaction based on the provided payload.
     */
    public function startTransaction(CreateTransactionDTO $payload): Transaction;

    /**
     * Updates the status of a transaction.
     */
    public function updateTransactionStatus(string $transactionId, TransactionStatusEnum $status): bool;
}
