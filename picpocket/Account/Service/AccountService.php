<?php

namespace Picpocket\Account\Service;

use Exception;
use Picpocket\Account\Action\AccountActionInterface;
use PicPocket\Account\Enums\AccountTypeEnum;
use Picpocket\Cache\Service\CacheServiceInterface;

/**
 * Class AccountService
 *
 * Provides services related to account operations, including determining
 * if an account is a retailer (legal entity) while leveraging caching for efficiency.
 *
 * Author: Victor Silva
 * Email: dev.jvictor@gmail.com
 * GitHub: github.com/golden-sheep
 */
class AccountService implements AccountServiceInterface
{
    /**
     * AccountService constructor.
     *
     * @param  CacheServiceInterface  $cacheService  Service for managing cached data.
     * @param  AccountActionInterface  $actionInterface  Service for interacting with account actions.
     */
    public function __construct(
        private readonly CacheServiceInterface $cacheService,
        private readonly AccountActionInterface $actionInterface
    ) {}

    /**
     * {@inheritdoc}
     */
    public function isAccountRetailer(string $accountId): bool
    {
        // Retrieve account type from cache or fallback to database query
        $accountType = $this->cacheService->remember("account_{$accountId}_type", 3600, function () use ($accountId) {
            // Fetch the account from the action layer
            $account = $this->actionInterface->findById($accountId);

            // Throw an exception if the account does not exist
            if (! $account) {
                throw new Exception("Account not found for ID: {$accountId}");
            }

            // Return the account type for caching
            return $account->type;
        });

        // Check if the account type matches LEGAL (retailer)
        return $accountType === AccountTypeEnum::LEGAL;
    }
}
