# AP\Cache\Persistent

[![MIT License](https://img.shields.io/badge/license-MIT-blue.svg)](LICENSE)

Caching of an unchanging array is typically prepared on one computer and used on another.

## Installation

```bash
composer require ap-lib/persistent-cache
```

## Features
- Interface for saving and loading arrays
- Implementation for saving and loading arrays to a PHP file

## Requirements
- PHP 8.3 or higher

## Getting Started

```php
$original_array = [
    "hello" => "world",
    "foo"   => "boo",
];

// Set up the cache object (in this case, it's just a filename)
$cache = new PhpFilePersistentCache("data.php");

// Store the array in the cache
$cache->set($original_array);

// Retrieve the array from the cache
$array = $cache->get();
```
