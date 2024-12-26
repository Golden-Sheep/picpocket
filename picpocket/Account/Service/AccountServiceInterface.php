<?php

namespace Picpocket\Account\Service;

/**
 * Interface AccountServiceInterface
 *
 * Defines the contract for account-related operations, including
 * determining if an account is a retailer (legal entity) while leveraging caching.
 *
 * Author: Victor Silva
 * Email: dev.jvictor@gmail.com
 * GitHub: github.com/golden-sheep
 */
interface AccountServiceInterface
{
    /**
     * Determine if the account is a retailer (legal entity) using cache.
     *
     * This method checks if an account is classified as a retailer by using
     * the cached account type or fetching it from the data source if not cached.
     *
     * @param string $accountId The unique identifier of the account.
     * @return bool True if the account is a retailer, false otherwise.
     * @throws \Exception If the account is not found.
     */
    public function isAccountRetailer(string $accountId): bool;
}
