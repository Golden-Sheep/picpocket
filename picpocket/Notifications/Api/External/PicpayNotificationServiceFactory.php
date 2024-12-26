<?php

namespace Picpocket\Notifications\Api\External;

/**
 * Class PicpayNotificationServiceFactory
 *
 * Factory for creating instances of the PicpayNotificationServiceService class.
 *
 * Author: Victor Silva
 * Email: dev.jvictor@gmail.com
 * GitHub: github.com/golden-sheep
 */
class PicpayNotificationServiceFactory
{
    /**
     * Creates a new instance of the PicpayNotificationServiceService.
     */
    public function __invoke(): PicpayNotificationServiceService
    {
        return new PicpayNotificationServiceService;
    }
}
