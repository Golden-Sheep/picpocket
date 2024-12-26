<?php

namespace Picpocket\Wallet\Actions;

use Picpocket\Wallet\Model\Wallet;

/**
 * Interface WalletActionInterface
 *
 * Defines the contract for wallet-related actions.
 *
 * Author: Victor Silva
 * Email: dev.jvictor@gmail.com
 * GitHub: github.com/golden-sheep
 */
interface WalletActionInterface
{
    /**
     * Deposits an amount into the wallet.
     */
    public function deposit(string $walletId, int $amount): bool;

    /**
     * Withdraws an amount from the wallet.
     */
    public function withdraw(string $walletId, int $amount): bool;

    /**
     * Finds a wallet by its ID.
     */
    public function findById(string $walletId): ?Wallet;
}
