<?php

namespace Picpocket\Notifications\Api\External;

/**
 * Class PicpayNotificationServiceFactory
 *
 * Factory for creating instances of the PicpayNotificationService class.
 *
 * Author: Victor Silva
 * Email: dev.jvictor@gmail.com
 * GitHub: github.com/golden-sheep
 */
class PicpayNotificationServiceFactory
{
    /**
     * Creates a new instance of the PicpayNotificationService.
     *
     * @return PicpayNotificationService
     */
    public function __invoke(): PicpayNotificationService
    {
        return new PicpayNotificationService();
    }
}
