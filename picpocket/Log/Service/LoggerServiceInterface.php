<?php

namespace PicPocket\Log\Service;

/**
 * Interface LoggerServiceInterface
 *
 * Defines the contract for logging services, ensuring that any implementation
 * provides methods to log messages at various levels (info, error, debug).
 *
 * Author: Victor Silva
 * Email: dev.jvictor@gmail.com
 * GitHub: github.com/golden-sheep
 */
interface LoggerServiceInterface
{
    /**
     * Log a message at the INFO level.
     *
     * @param  string  $message  The message to log.
     * @param  array  $context  Additional context to include with the log entry.
     */
    public function info(string $message, array $context = []): void;

    /**
     * Log a message at the ERROR level.
     *
     * @param  string  $message  The message to log.
     * @param  array  $context  Additional context to include with the log entry.
     */
    public function error(string $message, array $context = []): void;

    /**
     * Log a message at the DEBUG level.
     *
     * @param  string  $message  The message to log.
     * @param  array  $context  Additional context to include with the log entry.
     */
    public function debug(string $message, array $context = []): void;
}
