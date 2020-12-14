<?php

spl_autoload_register(
    function (string $className) {
        $path = __DIR__ . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $className);

        return include_once $path . '.php';
    }
);

try {
    $personalInfo = new \Form\PersonalInfoForm(
        [
            'first_name'    => 'test',
            'last_name'     => 'test',
            'age'           => 35,
            'date_of_birth' => '1997-05-05',
        ]
    );
    $contactUs = new \Form\ContactUsForm(
        [
            'content' => 'test_3',
            'email'   => 'test@test.test',
            'phone'   => '+123456789123'
        ]
    );
} catch (Throwable $e) {
    print_r($e->getMessage());
}

if ($personalInfo->validate()) {
    print_r($personalInfo->validated());
} else {
    print_r($personalInfo->errors());
}

if ($contactUs->validate()) {
    print_r($contactUs->validated());
} else {
    print_r($contactUs->errors());
}
