<?php

namespace Rule;

final class Phone extends Rule
{
    protected string $wantedType = 'phone';

    protected function validate($value): bool
    {
        return is_string($value) && preg_match('/^[+][1-9][\d]{9,13}$/', $value);
    }
}