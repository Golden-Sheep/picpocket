<?php

namespace Picpocket\Wallet\Repository;

use Picpocket\Wallet\Model\Wallet;

/**
 * Class WalletRepository
 *
 * Implements the wallet repository interface for database operations.
 *
 * Author: Victor Silva
 * Email: dev.jvictor@gmail.com
 * GitHub: github.com/golden-sheep
 */
class WalletRepository implements WalletRepositoryInterface
{
    /**
     * WalletRepository constructor.
     */
    public function __construct() {}

    /**
     * {@inheritdoc}
     */
    public function findById(string $walletId): Wallet
    {
        return Wallet::find($walletId);
    }

    /**
     * {@inheritdoc}
     */
    public function deposit(string $walletId, int $amount): bool
    {
        $affectedRows = Wallet::query()
            ->where('id', $walletId)
            ->increment('balance', $amount);

        return $affectedRows > 0;
    }

    /**
     * {@inheritdoc}
     */
    public function withdraw(string $walletId, int $amount): bool
    {
        $affectedRows = Wallet::query()
            ->find($walletId)
            ->decrement('balance', $amount);

        return $affectedRows > 0;
    }
}
