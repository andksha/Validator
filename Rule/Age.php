<?php

namespace Rule;

final class Age extends Rule
{
    private int $from;
    private int $to;
    private Numeric $numeric;

    public function __construct(int $from, int $to)
    {
        $this->from = $from;
        $this->to = $to;
        $this->wantedType = 'age between ' . $from . ' and ' . $to;
        $this->numeric = new Numeric();
    }

    protected function validate($value): bool
    {
        return $this->numeric->check($value) && $this->from <= $value && $value <= $this->to;
    }
}