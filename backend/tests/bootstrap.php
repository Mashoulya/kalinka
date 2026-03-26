<?php

declare(strict_types=1);

$autoload = dirname(__DIR__) . '/vendor/autoload.php';

if (!file_exists($autoload)) {
    fwrite(STDERR, "Missing vendor/autoload.php. Run composer install in backend first.\n");
    exit(1);
}

require $autoload;
