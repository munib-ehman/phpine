<?php

declare(strict_types=1);

namespace App\Middleware;

use Framework\Contracts\MiddlewareInterface;
use Framework\TemplateEngine;

class TemplateDataMiddleware implements MiddlewareInterface
{

    public function __construct(public TemplateEngine $view)
    {
    }

    public function process(callable $next)
    {
        $this->view->addGloablTemplateVariables('title', 'Expense Tracking Application');
        $next();
    }
}
