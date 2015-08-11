<?php

return [
    'app'   =>  [
        'url'   =>  'http://localhost',
        'hash'  =>  [
            'algo'  =>  PASSWORD_BCRYPT,
            'cost'  =>  10
        ],
    ],
    'db'    =>  [
        'driver'    =>  'mysql',
        'host'      =>  'localhost',
        'name'      =>  'elephpantcmf',
        'user'      =>  'root',
        'pass'      =>  '',
        'charset'   =>  'utf8',
        'collation' =>  'utf8_unicode_ci',
        'prefix'    =>  ''
    ],
    'auth'  =>  [
        'session'   =>  'user_id',
        'remember'  =>  'user_r'
    ],
    'mail'  =>  [
        'auth'      =>  true,
        'secure'    =>  'tls',
        'host'      =>  'localhost',
        'username'  =>  'user',
        'password'  =>  'password',
        'port'      =>  '587',
        'html'      =>  'true'
    ],
    'twig'  =>  [
        'debug'     =>  true
    ],
    'csrf'  =>  [
        'key'   =>  'csrf_token'
    ]
];