<?php

namespace App\Support;

use Mews\Purifier\Facades\Purifier;

class Html
{
    /**
     * Sanitize HTML for safe storage and display (TinyMCE / rich text).
     */
    public static function clean(?string $html): string
    {
        if ($html === null || $html === '') {
            return '';
        }

        return Purifier::clean($html);
    }
}
