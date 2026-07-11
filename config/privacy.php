<?php

return [

    'organization' => env(
        'PRIVACY_ORG_NAME',
        'Technological University of the Philippines Visayas'
    ),

    'dpo_name' => env('PRIVACY_DPO_NAME', 'Data Protection Officer'),

    'dpo_email' => env('PRIVACY_DPO_EMAIL', 'dpo@tupv.edu.ph'),

    'dpo_phone' => env('PRIVACY_DPO_PHONE', '(034) 495-3480'),

    'dpo_office' => env(
        'PRIVACY_DPO_OFFICE',
        'Office of the Director / UITC, TUP Visayas, Capt. Sabi St., Talisay City, Negros Occidental'
    ),

    'effective_date' => env('PRIVACY_EFFECTIVE_DATE', '2026-07-11'),

];
