<?php

declare(strict_types=1);

namespace App\Config;

use App\Middleware\csrfGuardMiddleware;
use App\Middleware\csrfMiddleware;
use App\Middleware\FlashMiddleware;
use App\Middleware\SessionMiddleware;
use App\Middleware\TemplateDataMiddleware;
use App\Middleware\ValidationMiddleware;
use Framework\App;

function registerMiddleware(App $app)
{
    $app->addMiddleware(csrfGuardMiddleware::class);
    $app->addMiddleware(csrfMiddleware::class);
    $app->addMiddleware(TemplateDataMiddleware::class);
    $app->addMiddleware(ValidationMiddleware::class);
    $app->addMiddleware(FlashMiddleware::class);
    $app->addMiddleware(SessionMiddleware::class);
}
