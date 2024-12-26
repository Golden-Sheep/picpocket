<?php

namespace Picpocket\Account\Action;

use Picpocket\Account\Repository\AccountRepositoryInterface;

/**
 * Class AccountActionFactory
 *
 * Factory class responsible for creating an instance of AccountAction.
 * This factory ensures that all required dependencies are properly resolved
 * from the Laravel service container.
 *
 * Author: Victor Silva
 * Email: dev.jvictor@gmail.com
 * GitHub: github.com/golden-sheep
 */
class AccountActionFactory
{
    /**
     * Creates a new instance of AccountAction.
     *
     * This method resolves the required dependency (AccountRepositoryInterface)
     * from the Laravel service container and passes it to the AccountAction constructor.
     *
     * @return AccountAction A fully constructed instance of AccountAction.
     */
    public function __invoke(): AccountAction
    {
        // Resolve AccountRepositoryInterface from the service container
        $accountRepository = app(AccountRepositoryInterface::class);

        // Return a new instance of AccountAction with the resolved dependency
        return new AccountAction($accountRepository);
    }
}
