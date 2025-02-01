<?php declare(strict_types=1);

namespace AP\Cache\Persistent;

use Throwable;
use UnexpectedValueException;

interface PersistentCacheInterface
{
    public function get(): array;

    /**
     * @param array $data
     * @return void
     * @throws UnexpectedValueException if not found
     * @throws Throwable all other errors
     */
    public function set(array $data): void;
}