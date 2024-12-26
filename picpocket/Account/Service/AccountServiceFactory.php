<?php

namespace Picpocket\Account\Service;

use Picpocket\Account\Action\AccountActionInterface;
use Picpocket\Cache\Service\CacheServiceInterface;

/**
 * Class AccountServiceFactory
 *
 * Factory class responsible for creating an instance of AccountService.
 * This factory ensures that all required dependencies are properly resolved
 * from the Laravel service container.
 *
 * Author: Victor Silva
 * Email: dev.jvictor@gmail.com
 * GitHub: github.com/golden-sheep
 */
class AccountServiceFactory
{
    /**
     * Creates a new instance of AccountService.
     *
     * This method resolves the required dependencies (CacheServiceInterface
     * and AccountActionInterface) from the Laravel service container and
     * passes them to the AccountService constructor.
     *
     * @return AccountService A fully constructed instance of AccountService.
     */
    public function __invoke(): AccountService
    {
        // Resolve CacheServiceInterface from the service container
        $cacheService = app(CacheServiceInterface::class);

        // Resolve AccountActionInterface from the service container
        $accountAction = app(AccountActionInterface::class);

        // Return a new instance of AccountService with the resolved dependencies
        return new AccountService($cacheService, $accountAction);
    }
}
