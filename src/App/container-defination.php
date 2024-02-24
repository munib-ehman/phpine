<?php

declare(strict_types=1);

use App\Config\Paths;
use App\Services\ValidatorService;
use Framework\Database;
use Framework\TemplateEngine;

return [
    TemplateEngine::class => fn () => new TemplateEngine(Paths::VIEW),
    ValidatorService::class => fn () => new ValidatorService(),
    Database::class => fn () => new Database($_ENV['DB_DRIVER'], [
        'host' => $_ENV['DB_HOST'],
        'port' => $_ENV['DB_PORT'],
        'dbname' => $_ENV['DB_NAME'],
    ], $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD'])
];
