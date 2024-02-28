<?php

declare(strict_types=1);

namespace App\Config;

use App\Controllers\AboutController;
use App\Controllers\HomeController;
use App\Controllers\AuthController;
use App\Controllers\ReceiptController;
use App\Controllers\TransactionController;
use App\Middleware\AuthRequiredMiddleware;
use App\Middleware\GuestOnlyMiddleware;
use Framework\App;

function registerRoute(App $app)
{
    $app->get('/', [HomeController::class, 'home'])->add(AuthRequiredMiddleware::class);
    $app->get('about', [AboutController::class, 'index']);
    $app->get('/register', [AuthController::class, 'index'])->add(GuestOnlyMiddleware::class);
    $app->post('/register', [AuthController::class, 'register'])->add(GuestOnlyMiddleware::class);
    $app->get('/login', [AuthController::class, 'loginView'])->add(GuestOnlyMiddleware::class);
    $app->post('/login', [AuthController::class, 'login'])->add(GuestOnlyMiddleware::class);
    $app->get('/logout', [AuthController::class, 'logout'])->add(AuthRequiredMiddleware::class);
    $app->get('/transaction', [TransactionController::class, 'createView'])->add(AuthRequiredMiddleware::class);
    $app->post('/transaction', [TransactionController::class, 'create'])->add(AuthRequiredMiddleware::class);
    $app->get('/transaction/{transaction}', [TransactionController::class, 'editView']);
    $app->post('/transaction/{transaction}', [TransactionController::class, 'update']);
    $app->delete('/transaction/{transaction}', [TransactionController::class, 'delete']);
    $app->get('/transaction/{transaction}/receipt', [ReceiptController::class, 'uploadView']);
    $app->post('/transaction/{transaction}/receipt', [ReceiptController::class, 'upload']);
}
