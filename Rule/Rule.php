<?php

namespace Rule;

use Throwable;

abstract class Rule
{
    protected $value = '';
    protected string $wantedType = '';

    public function check($value): bool
    {
        $this->value = $value;

        return $this->validate($value);
    }

    abstract protected function validate($value): bool;

    public function message(): string
    {
        $stringValue = '';

        try {
            $stringValue = strval($this->value);
        } catch (Throwable $e) {
            // value that can't be casted to string was passed, so it should be logged
        }

        return 'Value "' . $stringValue . '" must contain only ' . $this->wantedType;
    }
}