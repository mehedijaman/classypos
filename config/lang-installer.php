<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Location of the translations resources files
    |--------------------------------------------------------------------------
    |
    */
    'location'       => 'https://raw.githubusercontent.com/caouecs/Laravel-lang',

    /*
    |--------------------------------------------------------------------------
    | Latest laravel translations available version
    |--------------------------------------------------------------------------
    |
    */
    'latest_version' => '5',

    /*
    |--------------------------------------------------------------------------
    | Laravel versions => repository branch equivalence
    |--------------------------------------------------------------------------
    |
    */
    'versions'       => [
        '4' => 'laravel4',
        '5' => 'master'
    ],

    /*
    |--------------------------------------------------------------------------
    | Languages to install
    |--------------------------------------------------------------------------
    |
    */
    'languages'     => [
        'bn',

    ],

    /*
    |--------------------------------------------------------------------------
    | Translation files to install
    |--------------------------------------------------------------------------
    |
    */
    'files'         => [
        'auth',
        'pagination',
        'passwords',
        'validation'
    ]
];
