<?php

return [
    /*
     |--------------------------------------------------------------------------
     | Token generation salt
     |--------------------------------------------------------------------------
     |
     | The salt used to generate the token hash
     |
     */
    'key' => 'USE_YOUR_SALT',

    /*
     |--------------------------------------------------------------------------
     | Token Expirations
     |--------------------------------------------------------------------------
     |
     | The number of hours that tokens live before being refreshed / expired
     |
     */
    'refresh' => 48, // refresh tokens every 48 hours
    'expires' => 192, // expire tokens every 8 days
];