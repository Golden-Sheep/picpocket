<?php

namespace Picpocket\Transaction\Repository;

use Picpocket\Transaction\DTO\CreateTransactionDTO;
use Picpocket\Transaction\Enums\TransactionStatusEnum;
use Picpocket\Transaction\Model\Transaction;

/**
 * Class TransactionRepository
 *
 * Implements the transaction repository interface for database operations.
 *
 * Author: Victor Silva
 * Email: dev.jvictor@gmail.com
 * GitHub: github.com/golden-sheep
 */
class TransactionRepository implements TransactionRepositoryInterface
{
    /**
     * TransactionRepository constructor.
     */
    public function __construct() {}

    /**
     * {@inheritdoc}
     */
    public function startTransaction(CreateTransactionDTO $payload): Transaction
    {
        return Transaction::query()->create([
            'wallet_from_id' => $payload->payerId,
            'wallet_to_id' => $payload->payeeId,
            'amount' => $payload->amount,
            'status' => TransactionStatusEnum::Created,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function updateTransactionStatus(string $transactionId, TransactionStatusEnum $status): bool
    {
        return Transaction::query()->find($transactionId)->update([
            'status' => $status,
        ]);
    }
}
