<?php

namespace Rule;

final class Numeric extends Rule
{
    protected string $wantedType = 'numbers';

    protected function validate($value): bool
    {
        return is_numeric($value);
    }
}