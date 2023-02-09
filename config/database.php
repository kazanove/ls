<?php
return [
    'dsn' => [
        'driver' => 'mysql',
        'host' => '127.0.0.1',
        'name' => 'stranica_ls2',
        'user' => 'stranica',
        'password' => 'lee1Ooch',
        'options' => [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => true,
            MYSQLI_OPT_INT_AND_FLOAT_NATIVE => true,
        ],
    ],
];