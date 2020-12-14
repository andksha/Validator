<?php

namespace Rule;

use DateTime;

final class Date extends Rule
{
    protected string $wantedType = 'date';

    protected function validate($value): bool
    {
        $date = DateTime::createFromFormat('Y-m-d', $value);

        return $date && $date->format('Y-m-d') === $value;
    }
}