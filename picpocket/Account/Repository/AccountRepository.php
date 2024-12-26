<?php

namespace Picpocket\Account\Repository;

use Picpocket\Account\Model\Account;

/**
 * Class AccountRepository
 *
 * Implements the AccountRepositoryInterface to provide methods
 * for interacting with the Account model's data layer.
 *
 * This repository centralizes the logic for fetching account data,
 * ensuring consistency and reusability.
 *
 * Author: Victor Silva
 * Email: dev.jvictor@gmail.com
 * GitHub: github.com/golden-sheep
 */
class AccountRepository implements AccountRepositoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function findById(string $accountId): Account
    {
        return Account::find($accountId);
    }
}
