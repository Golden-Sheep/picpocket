<?php

namespace Picpocket\Account\Repository;

use Picpocket\Account\Model\Account;

/**
 * Interface AccountRepositoryInterface
 *
 * Provides a contract for interacting with the Account model's data layer.
 * Ensures consistency and reusability when fetching account data.
 *
 * Author: Victor Silva
 * Email: dev.jvictor@gmail.com
 * GitHub: github.com/golden-sheep
 */
interface AccountRepositoryInterface
{
    /**
     * Find an account by its ID.
     *
     *
     * @param  string  $accountId  The unique identifier of the account.
     * @return Account The account model instance.
     */
    public function findById(string $accountId): Account;
}
