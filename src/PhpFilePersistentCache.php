<?php declare(strict_types=1);

namespace AP\Cache\Persistent;

use RuntimeException;
use Throwable;
use UnexpectedValueException;

/**
 * Persistent caching to a PHP file can be one of the most effective methods because OPcache optimizes performance
 */
class PhpFilePersistentCache implements PersistentCacheInterface
{
    /**
     * @param string $filename
     */
    public function __construct(protected string $filename)
    {
    }

    protected function getFilename(): string
    {
        return $this->filename;
    }

    /**
     * @return array
     * @throws UnexpectedValueException if not found
     * @throws Throwable all other errors
     */
    public function get(): array
    {
        $hashmap  = null;
        $filename = $this->getFilename();
        if (file_exists($filename)) {
            $routes = include($filename);
            if (is_array($routes)) {
                return $routes;
            }
            throw new RuntimeException("invalid data on the file: $filename");
        }
        throw new UnexpectedValueException("File not found: $filename");
    }

    /**
     * @param array $data
     * @return void
     * @throws RuntimeException
     */
    public function set(array $data): void
    {
        $res = file_put_contents(
            $this->getFilename(),
            "<?php return " . var_export($data, true) . ";"
        );
        if ($res === false) {
            throw new RuntimeException("Failed to write to file: {$this->getFilename()}");
        }
    }
}