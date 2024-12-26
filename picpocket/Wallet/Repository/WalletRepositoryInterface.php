<?php

namespace Picpocket\Wallet\Repository;

use Picpocket\Wallet\Model\Wallet;

interface WalletRepositoryInterface
{
    /**
     * Finds a wallet by its ID.
     */
    public function findById(string $walletId): Wallet;

    /**
     * Deposits an amount into the wallet.
     */
    public function deposit(string $walletId, int $amount): bool;

    /**
     * Withdraws an amount from the wallet.
     */
    public function withdraw(string $walletId, int $amount): bool;
}
