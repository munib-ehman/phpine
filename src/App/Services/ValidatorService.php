<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Rules\DateFormateRule;
use Framework\Rules\EmailRule;
use Framework\Rules\InRule;
use Framework\Rules\LengthMaxRule;
use Framework\Rules\MatchRule;
use Framework\Rules\MinRule;
use Framework\Rules\NumericRule;
use Framework\Rules\RequiredRule;
use Framework\Rules\UrlRule;
use Framework\Validator;

class ValidatorService
{
    private Validator $validator;

    public function __construct()
    {
        $this->validator = new Validator();
        $this->validator->add('required', new RequiredRule());
        $this->validator->add('email', new EmailRule());
        $this->validator->add('min', new MinRule());
        $this->validator->add('In', new InRule());
        $this->validator->add('url', new UrlRule());
        $this->validator->add('match', new MatchRule());
        $this->validator->add('lengthMax', new LengthMaxRule);
        $this->validator->add('numeric', new NumericRule());
        $this->validator->add('date', new DateFormateRule());
    }

    public function validateRegister(array $formData)
    {

        $this->validator->validate($formData, [
            'email' => ['required', 'email'],
            'age' => ['required', 'min:18'],
            'country' => ['required', 'In:USA,Canada'],
            'socialMediaUrl' => ['required', 'url'],
            'password' => ['required'],
            'confirmPassword' => ['required', 'match:password'],
            'tos' => ['required'],
        ]);
    }

    public function validateLogin(array $formData)
    {
        $this->validator->validate($formData, [
            'email' => ['email', 'required'],
            'password' => ['required']
        ]);
    }

    public function validateTransaction(array $formData)
    {
        $this->validator->validate($formData, [
            'description' => ['required', 'lengthMax:50'],
            'amount' => ['required', 'numeric'],
            'date' => ['required', 'date:Y-m-d']
        ]);
    }
}
