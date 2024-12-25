<?php

namespace Picpocket\Transaction\Services;

use Picpocket\Transaction\DTO\CreateTransactionDTO;

interface TransactionServiceInterface
{
    /**
     * Handles a transaction process based on the given DTO.
     *
     * @param CreateTransactionDTO $transactionDTO
     * @return bool
     * @throws TransactionServiceException
     */
    public function handle(CreateTransactionDTO $transactionDTO): bool;
}
