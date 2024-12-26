<?php

namespace Picpocket\Log;

/**
 * Class PicpayNotificationServiceFactory
 *
 * Factory for creating instances of the PicpayNotificationService class.
 *
 * Author: Victor Silva
 * Email: dev.jvictor@gmail.com
 * GitHub: github.com/golden-sheep
 */
class LoggerServiceFactory
{
    /**
     * Creates a new instance of the PicpayNotificationService.
     *
     * @return LoggerService
     */
    public function __invoke(): LoggerService
    {
        return new LoggerService();
    }
}
