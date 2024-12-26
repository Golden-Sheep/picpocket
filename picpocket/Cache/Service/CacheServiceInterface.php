<?php

namespace Picpocket\Cache\Service;

/**
 * Interface CacheServiceInterface
 *
 * Defines the contract for cache operations, ensuring consistency and
 * reusability across the application.
 *
 * Author: Victor Silva
 * Email: dev.jvictor@gmail.com
 * GitHub: github.com/golden-sheep
 */
interface CacheServiceInterface
{
    /**
     * Retrieve a value from the cache or execute the callback and cache the result.
     *
     * If the key does not exist in the cache, the callback will be executed,
     * its result cached, and then returned.
     *
     * @param  string  $key  The cache key.
     * @param  int  $ttl  Time-to-live in seconds.
     * @param  callable  $callback  The callback to execute if the key doesn't exist.
     * @return mixed The cached value or the result of the callback.
     */
    public function remember(string $key, int $ttl, callable $callback): mixed;

    /**
     * Retrieve a value from the cache.
     *
     * Fetches a cached value by its key. Returns null if the key does not exist.
     *
     * @param  string  $key  The cache key.
     * @return mixed|null The cached value or null if not found.
     */
    public function get(string $key): mixed;

    /**
     * Store a value in the cache.
     *
     * Saves a value in the cache with a specified TTL (time-to-live).
     *
     * @param  string  $key  The cache key.
     * @param  mixed  $value  The value to cache.
     * @param  int  $ttl  Time-to-live in seconds.
     */
    public function put(string $key, mixed $value, int $ttl): void;

    /**
     * Remove an item from the cache.
     *
     * Deletes a cached value by its key.
     *
     * @param  string  $key  The cache key.
     */
    public function forget(string $key): void;
}
