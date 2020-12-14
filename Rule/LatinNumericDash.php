<?php

namespace Rule;

final class LatinNumericDash extends Rule
{
    protected string $wantedType = 'numbers, latin and dash symbols';

    protected function validate($value): bool
    {
        return is_string($value) && preg_match('/^[-a-zA-Z0-9_\'\":]+$/', $value);
    }
}