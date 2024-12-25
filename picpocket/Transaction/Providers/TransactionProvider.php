<?php

namespace Picpocket\Transaction\Providers;

use Carbon\Laravel\ServiceProvider;
use Picpocket\Transaction\Actions\TransactionActionFactory;
use Picpocket\Transaction\Actions\TransactionActionInterface;
use Picpocket\Transaction\Repository\TransactionRepositoryFactory;
use Picpocket\Transaction\Repository\TransactionRepositoryInterface;
use Picpocket\Transaction\Services\TransactionServiceFactory;
use Picpocket\Transaction\Services\TransactionServiceInterface;

/**
 * Class TransactionProvider
 *
 * Service provider for binding transaction-related interfaces to their implementations.
 *
 * Author: Victor Silva
 * Email: dev.jvictor@gmail.com
 * GitHub: github.com/golden-sheep
 */
class TransactionProvider extends ServiceProvider
{
    /**
     * Register services in the application container.
     *
     * @return void
     */
    public function register()
    {
        $this->bindTransactionService();
        $this->bindActionService();
        $this->bindTransactionRepository();
    }

    /**
     * Bind the TransactionServiceInterface to its implementation.
     *
     * @return void
     */
    protected function bindTransactionService()
    {
        $this->app->bind(TransactionServiceInterface::class, function () {
            return (new TransactionServiceFactory())();
        });
    }

    /**
     * Bind the TransactionActionInterface to its implementation.
     *
     * @return void
     */
    protected function bindActionService()
    {
        $this->app->bind(TransactionActionInterface::class, function () {
            return (new TransactionActionFactory())();
        });
    }

    /**
     * Bind the TransactionRepositoryInterface to its implementation.
     *
     * @return void
     */
    protected function bindTransactionRepository()
    {
        $this->app->bind(TransactionRepositoryInterface::class, function () {
            return (new TransactionRepositoryFactory())();
        });
    }
}
