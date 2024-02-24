<?php

declare(strict_types=1);

include __DIR__ . '/../../vendor/autoload.php';


use Framework\App;

use function App\Config\registerMiddleware;
use function App\Config\registerRoute;
use App\Config\Paths;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(Paths::ROOT);
$dotenv->load();

$app = new App(Paths::SOURCE . 'App/container-defination.php');

registerRoute($app);
registerMiddleware($app);

return $app;
