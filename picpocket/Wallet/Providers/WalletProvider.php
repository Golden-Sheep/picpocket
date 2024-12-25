<?php

namespace Picpocket\Wallet\Providers;

use Carbon\Laravel\ServiceProvider;
use Picpocket\Wallet\Actions\WalletActionFactory;
use Picpocket\Wallet\Actions\WalletActionInterface;
use Picpocket\Wallet\Repository\WalletRepositoryFactory;
use Picpocket\Wallet\Repository\WalletRepositoryInterface;

/**
 * Class WalletProvider
 *
 * Service provider for binding wallet-related interfaces to their implementations.
 *
 * Author: Victor Silva
 * Email: dev.jvictor@gmail.com
 * GitHub: github.com/golden-sheep
 */
class WalletProvider extends ServiceProvider
{
    /**
     * Register services in the application container.
     *
     * @return void
     */
    public function register()
    {
        $this->bindWalletRepository();
        $this->bindWalletAction();
    }

    /**
     * Bind the WalletActionInterface to its implementation.
     *
     * @return void
     */
    protected function bindWalletAction()
    {
        $this->app->bind(WalletActionInterface::class, function () {
            return (new WalletActionFactory)();
        });
    }

    /**
     * Bind the WalletRepositoryInterface to its implementation.
     *
     * @return void
     */
    protected function bindWalletRepository()
    {
        $this->app->bind(WalletRepositoryInterface::class, function () {
            return (new WalletRepositoryFactory)();
        });
    }
}
