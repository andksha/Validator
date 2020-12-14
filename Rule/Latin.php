<?php

namespace Rule;

final class Latin extends Rule
{
    protected string $wantedType = 'latin characters';

    protected function validate($value): bool
    {
        return is_string($value) && preg_match('/^[a-zA-Z]+$/', $value);
    }
}