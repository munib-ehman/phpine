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
            $oldFormData = $_POST;
            $excludedFields = ['password', 'confirmPassword'];
            $formattedFormData = array_diff_key($oldFormData, array_flip($excludedFields));

            $_SESSION['errors'] = $th->errors;
            $_SESSION['old'] = $formattedFormData;
            $refer = $_SERVER['HTTP_REFERER'];
            redirectTo($refer);
        }
    }
}
