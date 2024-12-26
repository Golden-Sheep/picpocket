<?php

namespace Picpocket\Notifications\Api\External;

use Carbon\Laravel\ServiceProvider;

/**
 * Class NotificationServiceProvider
 *
 * Service provider to bind the notification interface to its implementation.
 *
 * Author: Victor Silva
 * Email: dev.jvictor@gmail.com
 * GitHub: github.com/golden-sheep
 */
class NotificationServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->bindNotification();
    }

    /**
     * Bind the NotificationServiceInterface to its implementation.
     *
     * @return void
     */
    protected function bindNotification()
    {
        $this->app->bind(NotificationServiceInterface::class, function () {
            return (new PicpayNotificationServiceFactory)();
        });
    }
}
