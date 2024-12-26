<?php

namespace Picpocket\Log\Provider;

use Carbon\Laravel\ServiceProvider;
use PicPocket\Log\Service\LoggerService;
use PicPocket\Log\Service\LoggerServiceFactory;

/**
 * Class LoggerProvider
 *
 * Service provider to bind the LoggerService to its factory implementation.
 *
 * Author: Victor Silva
 * Email: dev.jvictor@gmail.com
 * GitHub: github.com/golden-sheep
 */
class LoggerProvider extends ServiceProvider
{
    /**
     * Register the logger service provider.
     *
     * This method ensures that the LoggerService is bound to the Laravel container
     * using the LoggerServiceFactory for instantiation.
     *
     * @return void
     */
    public function register()
    {
        $this->bindLoggerService();
    }

    /**
     * Bind the LoggerService to its factory implementation.
     *
     * This method uses the LoggerServiceFactory to create and bind an instance
     * of LoggerService into the Laravel service container.
     *
     * @return void
     */
    protected function bindLoggerService()
    {
        $this->app->bind(LoggerService::class, function () {
            return (new LoggerServiceFactory)();
        });
    }
}
