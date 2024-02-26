<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Services\{ValidatorService, UserService};
use Framework\TemplateEngine;

class AuthController
{
    public function __construct(
        private TemplateEngine $view,
        private ValidatorService $validatorService,
        private UserService $userservices
    ) {
    }

    public function index()
    {
        echo $this->view->render('register.php');
    }

    public function register()
    {
        $this->validatorService->validateRegister($_POST);
        $this->userservices->isEmailTaken($_POST['email']);
        $this->userservices->register($_POST);
        redirectTo('/');
    }

    public function loginView()
    {
        echo $this->view->render('login.php');
    }

    public function login()
    {
        $this->validatorService->validateLogin($_POST);
        $this->userservices->login($_POST);

        redirectTo('/');
    }

    public function logout()
    {
        $this->userservices->logout();
        redirectTo('/login');
    }
}
