<?php
/**
 * Vaanakam - Language Configuration
 * Supported languages: English (en) and Tamil (ta)
 */

if (!defined('DEFAULT_LANGUAGE')) {
    define('DEFAULT_LANGUAGE', 'en');
}

if (!defined('SUPPORTED_LANGUAGES')) {
    define('SUPPORTED_LANGUAGES', [
        'en' => [
            'code'        => 'en',
            'name'        => 'English',
            'native_name' => 'English',
            'short'       => 'EN',
            'flag'        => '🇬🇧',
            'locale'      => 'en_US',
            'dir'         => 'ltr'
        ],
        'ta' => [
            'code'        => 'ta',
            'name'        => 'Tamil',
            'native_name' => 'தமிழ்',
            'short'       => 'தமிழ்',
            'flag'        => '🇱🇰',
            'locale'      => 'ta_LK',
            'dir'         => 'ltr'
        ]
    ]);
}
