<?php

declare(strict_types=1);

include __DIR__ . '/../../vendor/autoload.php';

use App\Controllers\HomeController;
use Framework\App;

$app = new App();

$app->get('/', [HomeController::class, 'home']);
$app->get('about/team', [HomeController::class, 'home']);


return $app;
