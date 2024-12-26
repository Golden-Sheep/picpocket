<?php

namespace PicPocket\Log\Service;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

/**
 * Class LoggerService
 *
 * Implements the LoggerServiceInterface to provide structured logging
 * functionality using Laravel's logging facade.
 *
 * This service handles various log levels (info, error, debug) and allows
 * adding additional context to each log entry.
 *
 * Each instance of LoggerService generates a unique token to track all logs
 * related to a specific workflow or request.
 *
 * Author: Victor Silva
 * Email: dev.jvictor@gmail.com
 * GitHub: github.com/golden-sheep
 */
class LoggerService implements LoggerServiceInterface
{
    /**
     * A unique token to track logs in the same workflow.
     *
     * @var string
     */
    private string $logToken;

    /**
     * Initialize the logger service and generate a unique token.
     */
    public function __construct()
    {
        $this->logToken = Str::uuid()->toString();
    }

    /**
     * Log a message at the INFO level.
     *
     * @inheritdoc
     */
    public function info(string $message, array $context = []): void
    {
        Log::info($message, $this->addLogTokenToContext($context));
    }

    /**
     * Log a message at the ERROR level.
     *
     * @inheritdoc
     */
    public function error(string $message, array $context = []): void
    {
        Log::error($message, $this->addLogTokenToContext($context));
    }

    /**
     * Log a message at the DEBUG level.
     *
     * @inheritdoc
     */
    public function debug(string $message, array $context = []): void
    {
        Log::debug($message, $this->addLogTokenToContext($context));
    }

    /**
     * Adds the log token to the context.
     *
     * @param array $context The original context.
     * @return array The updated context with the log token.
     */
    private function addLogTokenToContext(array $context): array
    {
        $context['log_token'] = $this->logToken;
        return $context;
    }

    /**
     * Get the unique log token.
     *
     * @return string
     */
    public function getLogToken(): string
    {
        return $this->logToken;
    }
}
