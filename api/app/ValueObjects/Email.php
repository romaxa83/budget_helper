<?php

namespace App\ValueObjects;

use InvalidArgumentException;

class Email extends AbstractValueObject
{
    protected function validate(string $value): void
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException(
                __('validation.not valid email', ['email' => $value])
            );
        }
    }
}
