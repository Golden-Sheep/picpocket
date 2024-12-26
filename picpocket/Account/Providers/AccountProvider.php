<?php

namespace Picpocket\Account\Providers;

use Carbon\Laravel\ServiceProvider;
use Picpocket\Account\Action\AccountActionFactory;
use Picpocket\Account\Action\AccountActionInterface;
use Picpocket\Account\Repository\AccountRepositoryFactory;
use Picpocket\Account\Repository\AccountRepositoryInterface;
use Picpocket\Account\Service\AccountServiceFactory;
use Picpocket\Account\Service\AccountServiceInterface;

/**
 * Class AccountProvider
 *
 * Service provider for binding account-related services, actions, and repositories
 * to their respective implementations in the Laravel application container.
 *
 * This provider ensures that all dependencies are resolved properly and efficiently.
 *
 * Author: Victor Silva
 * Email: dev.jvictor@gmail.com
 * GitHub: github.com/golden-sheep
 */
class AccountProvider extends ServiceProvider
{
    /**
     * Register services in the application container.
     *
     * This method binds all account-related interfaces to their
     * respective implementations via factories.
     *
     * @return void
     */
    public function register()
    {
        $this->bindAccountService();
        $this->bindAccountAction();
        $this->bindAccountRepository();
    }

    /**
     * Bind the AccountServiceInterface to its implementation.
     *
     * This method uses the AccountServiceFactory to resolve
     * the AccountService dependency and bind it to the container.
     *
     * @return void
     */
    protected function bindAccountService()
    {
        $this->app->bind(AccountServiceInterface::class, function () {
            return (new AccountServiceFactory)();
        });
    }

    /**
     * Bind the AccountActionInterface to its implementation.
     *
     * This method uses the AccountActionFactory to resolve
     * the AccountAction dependency and bind it to the container.
     *
     * @return void
     */
    protected function bindAccountAction()
    {
        $this->app->bind(AccountActionInterface::class, function () {
            return (new AccountActionFactory)();
        });
    }

    /**
     * Bind the AccountRepositoryInterface to its implementation.
     *
     * This method uses the AccountRepositoryFactory to resolve
     * the AccountRepository dependency and bind it to the container.
     *
     * @return void
     */
    protected function bindAccountRepository()
    {
        $this->app->bind(AccountRepositoryInterface::class, function () {
            return (new AccountRepositoryFactory)();
        });
    }
}
