<?php

declare(strict_types=1);

namespace App\Middleware;

use Framework\Contracts\MiddlewareInterface;
use Framework\Exceptions\ValidationException;
use PDO;

class ValidationMiddleware implements MiddlewareInterface
{

    public function process(callable $next)
    {
        try {
            $next();
        } catch (ValidationException $th) {
            $_SESSION['errors'] = $th->errors;
            $refer = $_SERVER['HTTP_REFERER'];
            redirectTo($refer);
        }
    }
}
