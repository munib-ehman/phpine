<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Config\Paths;

class AboutController
{

    public function __construct(private TemplateEngine $view)
    {
    }

    public function index()
    {
        $this->view->addGloablTemplateVariables('title', 'About page');
        echo $this->view->render('about.php');
    }
}
