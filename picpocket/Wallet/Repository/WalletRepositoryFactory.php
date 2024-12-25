<?php

namespace Picpocket\Wallet\Repository;

/**
 * Class WalletRepositoryFactory
 *
 * Factory for creating instances of the WalletRepository class.
 *
 * Author: Victor Silva
 * Email: dev.jvictor@gmail.com
 * GitHub: github.com/golden-sheep
 */
class WalletRepositoryFactory
{
    /**
     * Creates a new instance of WalletRepository.
     *
     * @return WalletRepository
     */
    public function __invoke(): WalletRepository
    {
        return new WalletRepository();
    }
}
