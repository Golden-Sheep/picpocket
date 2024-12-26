<?php

namespace Picpocket\Account\Action;

use Picpocket\Account\Model\Account;

/**
 * Interface AccountActionInterface
 *
 * Defines the contract for account-related actions, providing methods
 * to interact with accounts while abstracting the underlying repository.
 *
 * This interface ensures consistency and reusability when performing
 * operations related to accounts.
 *
 * Author: Victor Silva
 * Email: dev.jvictor@gmail.com
 * GitHub: github.com/golden-sheep
 *
 * @template TModel of \Illuminate\Database\Eloquent\Model
 */
interface AccountActionInterface
{
    /**
     * Find an account by its ID.
     *
     * Delegates the operation to the repository layer to fetch
     * the account by its unique identifier.
     *
     * @param  string  $accountId  The unique identifier of the account.
     * @return Account The account model instance.
     */
    public function findById(string $accountId): ?Account;
}
