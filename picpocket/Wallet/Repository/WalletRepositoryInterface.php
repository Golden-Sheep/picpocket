<?php

namespace Picpocket\Wallet\Repository;

use Picpocket\Wallet\Model\Wallet;

interface WalletRepositoryInterface
{
    /**
     * Finds a wallet by its ID.
     *
     * @param string $walletId
     * @return Wallet
     */
    public function findById(string $walletId): Wallet;

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
}
