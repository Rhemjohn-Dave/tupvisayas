<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Accreditation Access Password
    |--------------------------------------------------------------------------
    |
    | Required before a visitor can view a program accreditation page.
    | Set ACCREDITATION_PASSWORD in your .env — there is no default secret.
    |
    */

    'password' => env('ACCREDITATION_PASSWORD'),
];
