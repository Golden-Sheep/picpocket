<?php

namespace PicPocket\Log\Service;

/**
 * Class PicpayNotificationServiceFactory
 *
 * Factory for creating instances of the LoggerService class.
 *
 * Author: Victor Silva
 * Email: dev.jvictor@gmail.com
 * GitHub: github.com/golden-sheep
 */
class LoggerServiceFactory
{
    /**
     * Creates a new instance of the LoggerService.
     */
    public function __invoke(): LoggerService
    {
        return new LoggerService;
    }
}
