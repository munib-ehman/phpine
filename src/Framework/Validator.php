<?php

declare(strict_types=1);


namespace Framework;

use Framework\Contracts\RuleInterface;
use Framework\Exceptions\ValidationException;

class Validator
{
    private array $rule = [];

    public function add(string $alias, RuleInterface $rule)
    {
        $this->rule[$alias] = $rule;
    }

    public function validate(array $formData, array $fields)
    {
        $errors = [];

        foreach ($fields as $fieldName => $rules) {
            foreach ($rules as  $rule) {
                $ruleParameters = [];

                if (str_contains($rule, ':')) {
                    [$rule, $ruleParameters] = explode(':', $rule);
                    $ruleParameters = explode(',', $ruleParameters);
                    // dd($ruleParameters);
                }
                $ruleValidator = $this->rule[$rule];

                if ($ruleValidator->validate($formData, $fieldName, $ruleParameters)) {
                    continue;
                }

                $errors[$fieldName][] = $ruleValidator->getMessage($formData, $fieldName, $ruleParameters);
            }
        }

        if (count($errors)) {
            throw new ValidationException($errors);
        }
    }
}
