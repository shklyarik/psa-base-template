<?php

return [
    'db' => [
        'class'    => 'Psa\Qb\Db',
        'host'     => $_ENV['DB_HOST'],
        'user'     => $_ENV['DB_USERNAME'],
        'password' => $_ENV['DB_PASSWORD'],
        'database' => $_ENV['DB_DATABASE'],
    ],
];
