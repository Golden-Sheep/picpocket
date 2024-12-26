<?php

namespace Picpocket\Transaction\Repository;

/**
 * Class TransactionRepositoryFactory
 *
 * Factory for creating instances of the TransactionRepository class.
 *
 * Author: Victor Silva
 * Email: dev.jvictor@gmail.com
 * GitHub: github.com/golden-sheep
 */
class TransactionRepositoryFactory
{
    /**
     * Creates a new instance of TransactionRepository.
     */
    public function __invoke(): TransactionRepository
    {
        return new TransactionRepository;
    }
}
