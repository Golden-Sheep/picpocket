<?php

namespace Picpocket\Transaction\Services;

use Picpocket\Transaction\DTO\CreateTransactionDTO;
use Picpocket\Transaction\Services\Exceptions\TransactionServiceException;

interface TransactionServiceInterface
{
    /**
     * Handles a transaction process based on the given DTO.
     *
     * @throws TransactionServiceException
     */
    public function handle(CreateTransactionDTO $transactionDTO): bool;
}
