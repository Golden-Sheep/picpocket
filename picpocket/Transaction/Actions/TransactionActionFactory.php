<?php

namespace Picpocket\Transaction\Actions;

use Picpocket\Transaction\Repository\TransactionRepositoryInterface;

/**
 * Class TransactionActionFactory
 *
 * Factory for creating instances of the TransactionAction class.
 *
 * Author: Victor Silva
 * Email: dev.jvictor@gmail.com
 * GitHub: github.com/golden-sheep
 */
class TransactionActionFactory
{
    /**
     * Creates a new instance of TransactionAction.
     */
    public function __invoke(): TransactionAction
    {
        $transactionRepositoryInterface = app(TransactionRepositoryInterface::class);

        return new TransactionAction($transactionRepositoryInterface);
    }
}
