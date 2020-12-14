<?php

namespace Form;

use Rule\Age;
use Rule\Date;
use Rule\Latin;

final class PersonalInfoForm extends Form
{
    protected function keys(): array
    {
        return [
            'first_name'    => Latin::class,
            'last_name'     => Latin::class,
            'date_of_birth' => Date::class,
            'age'           => new Age(18, 35),
        ];
    }
}