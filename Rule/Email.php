<?php

namespace Rule;

final class Email extends Rule
{
    protected string $wantedType = 'email';

    protected function validate($value): bool
    {
        return is_string($value) && preg_match('/^[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+.[a-zA-Z]{2,4}$/', $value);
    }

}