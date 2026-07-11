<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Public registration
    |--------------------------------------------------------------------------
    |
    | When false (recommended for production), guest registration routes
    | return 404. Create users only via Admin → Users.
    |
    */

    'allow_public_registration' => (bool) env('ALLOW_PUBLIC_REGISTRATION', false),

];
