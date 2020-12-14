<?php

namespace Form;

use Rule\Email;
use Rule\LatinNumericDash;
use Rule\Phone;

final class ContactUsForm extends Form
{
    protected function keys(): array
    {
        return [
            'content' => LatinNumericDash::class,
            'email'   => Email::class,
            'phone'   => Phone::class
        ];
    }

}