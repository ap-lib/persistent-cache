<?php declare(strict_types=1);

namespace AP\Cache\Persistent\Tests;

use AP\Cache\Persistent\PhpFilePersistentCache;
use Exception;
use PHPUnit\Framework\TestCase;

final class PhpFilePersistentCacheTest extends TestCase
{
    public function testBasic(): void
    {
        $filename = "data.php";

        $original_array = [
            "hello" => "world",
            "foo"   => "boo",
        ];

        // Set up the cache object (in this case, it's just a filename)
        $cache = new PhpFilePersistentCache($filename);

        // Store the array in the cache
        $cache->set($original_array);

        // Retrieve the array from the cache
        $retrieved_array = $cache->get();

        $this->assertEquals(
            $original_array,
            $retrieved_array
        );

        unlink($filename);
    }

    public function testNoAllowedNoBasicValues(): void
    {
        $filename = "data.php";

        $original_array = [
            "hello"  => "world",
            "foo"    => "boo",
            "object" => new Exception("hello world"),
        ];

        $expected_array = [
            "hello"  => "world",
            "foo"    => "boo",
            "object" => null,
        ];

        // Set up the cache object (in this case, it's just a filename)
        $cache = new PhpFilePersistentCache($filename);

        // Store the array in the cache
        $cache->set($original_array);

        // Retrieve the array from the cache
        $retrieved_array = $cache->get();

        $this->assertEquals(
            $expected_array,
            $retrieved_array
        );

        unlink($filename);
    }
}
