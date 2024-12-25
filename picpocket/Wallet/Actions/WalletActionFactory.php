<?php

namespace Picpocket\Wallet\Actions;

use Picpocket\Wallet\Repository\WalletRepositoryInterface;

/**
 * Class WalletActionFactory
 *
 * Factory for creating instances of the WalletAction class.
 *
 * Author: Victor Silva
 * Email: dev.jvictor@gmail.com
 * GitHub: github.com/golden-sheep
 */
class WalletActionFactory
{
    /**
     * Creates a new instance of WalletAction.
     *
     * @return WalletAction
     */
    public function __invoke(): WalletAction
    {
        $walletRepository = app(WalletRepositoryInterface::class);

        return new WalletAction($walletRepository);
    }
}
