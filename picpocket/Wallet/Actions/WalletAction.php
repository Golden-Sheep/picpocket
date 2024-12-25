<?php

namespace Picpocket\Wallet\Actions;

use Picpocket\Wallet\Model\Wallet;
use Picpocket\Wallet\Repository\WalletRepositoryInterface;

/**
 * Class WalletAction
 *
 * Implements wallet-related actions by interacting with the WalletRepository.
 *
 * Author: Victor Silva
 * Email: dev.jvictor@gmail.com
 * GitHub: github.com/golden-sheep
 */
class WalletAction implements WalletActionInterface
{
    /**
     * WalletAction constructor.
     *
     * @param WalletRepositoryInterface $walletRepository
     */
    public function __construct(
        private readonly WalletRepositoryInterface $walletRepository
    ) {
    }

    /**
     * @inheritdoc
     */
    public function deposit(string $walletId, int $amount): bool
    {
        return $this->walletRepository->deposit($walletId, $amount);
    }

    /**
     * @inheritdoc
     */
    public function withdraw(string $walletId, int $amount): bool
    {
        return $this->walletRepository->withdraw($walletId, $amount);
    }

    /**
     * @inheritdoc
     */
    public function findById(string $walletId): Wallet
    {
        return $this->walletRepository->findById($walletId);
    }
}
