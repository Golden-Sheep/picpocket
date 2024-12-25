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
     *
     * @param string $walletId
     * @param int $amount
     * @return bool
     */
    public function deposit(string $walletId, int $amount): bool;

    /**
     * Withdraws an amount from the wallet.
     *
     * @param string $walletId
     * @param int $amount
     * @return bool
     */
    public function withdraw(string $walletId, int $amount): bool;

    /**
     * Finds a wallet by its ID.
     *
     * @param string $walletId
     * @return Wallet
     */
    public function findById(string $walletId): Wallet;
}
