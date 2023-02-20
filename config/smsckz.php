<?php

return [
    'url' => env('SMSC_URL', 'https://smsc.kz/sys/send.php'),
    'login' => env('SMSC_LOGIN'),
    'password' => env('SMSC_PASSWORD'),
];