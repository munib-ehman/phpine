<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Rules\EmailRule;
use Framework\Rules\RequiredRule;
use Framework\Validator;

class ValidatorService
{
    private Validator $validator;

    public function __construct()
    {
        $this->validator = new Validator();
        $this->validator->add('required', new RequiredRule());
        $this->validator->add('email', new EmailRule());
    }

    public function validateRegister(array $formData)
    {

        $this->validator->validate($formData, [
            'email' => ['required', 'email'],
            'age' => ['required'],
            'country' => ['required'],
            'socialMediaUrl' => ['required'],
            'password' => ['required'],
            'confirmPassword' => ['required'],
            'tos' => ['required'],
        ]);
    }
}
