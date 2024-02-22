<?php

declare(strict_types=1);

namespace App\Config;

use App\Controllers\AboutController;
use App\Controllers\HomeController;
use App\Controllers\AuthController;
use Framework\App;

function registerRoute(App $app)
{
    $app->get('/', [HomeController::class, 'home']);
    $app->get('about', [AboutController::class, 'index']);
    $app->get('/register', [AuthController::class, 'index']);
    $app->post('/register', [AuthController::class, 'register']);
}
