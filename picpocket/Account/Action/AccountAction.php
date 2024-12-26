<?php

namespace Picpocket\Account\Action;

use Picpocket\Account\Model\Account;
use Picpocket\Account\Repository\AccountRepositoryInterface;

/**
 * Class AccountAction
 *
 * Provides a layer of abstraction for account-related operations,
 * delegating database interactions to the repository layer.
 *
 * This class ensures clean separation of concerns by encapsulating
 * account-specific actions and leveraging the repository for data access.
 *
 * Author: Victor Silva
 * Email: dev.jvictor@gmail.com
 * GitHub: github.com/golden-sheep
 *
 * @template TModel of \Illuminate\Database\Eloquent\Model
 *
 * @implements AccountActionInterface<\Picpocket\Account\Model\Account>
 */
class AccountAction implements AccountActionInterface
{
    /**
     * AccountAction constructor.
     *
     * @param  AccountRepositoryInterface  $accountRepository  Repository for interacting with account data.
     */
    public function __construct(
        private readonly AccountRepositoryInterface $accountRepository
    ) {}

    /**
     * {@inheritdoc}
     */
    public function findById(string $accountId): ?Account
    {
        return $this->accountRepository->findById($accountId);
    }
}
