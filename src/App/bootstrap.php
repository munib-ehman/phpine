<?php

declare(strict_types=1);

include __DIR__ . '/../../vendor/autoload.php';


use Framework\App;
use function App\Config\registerRoute;

$app = new App();

registerRoute($app);

return $app;
