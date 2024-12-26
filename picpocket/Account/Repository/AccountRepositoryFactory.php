<?php

namespace Picpocket\Account\Repository;

/**
 * Class AccountRepositoryFactory
 *
 * Factory class responsible for creating an instance of AccountRepository.
 * This factory ensures that the AccountRepository is instantiated
 * and can be resolved by the Laravel service container.
 *
 * Author: Victor Silva
 * Email: dev.jvictor@gmail.com
 * GitHub: github.com/golden-sheep
 */
class AccountRepositoryFactory
{
    /**
     * Creates a new instance of AccountRepository.
     *
     * This method constructs an instance of AccountRepository
     * and returns it for use in the application.
     *
     * @return AccountRepository A fully constructed instance of AccountRepository.
     */
    public function __invoke(): AccountRepository
    {
        // Return a new instance of AccountRepository
        return new AccountRepository();
    }
}
