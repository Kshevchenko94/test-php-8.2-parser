<?php

return [
    'databases' => [
        'mysql' => [
            'host' => $_ENV['MYSQL_DB_HOST']?? 'db',
            'port' => $_ENV['MYSQL_DB_PORT']?? '3306',
            'database' => $_ENV['MYSQL_DB_DATABASE']?? 'test_db',
            'username' => $_ENV['MYSQL_DB_USERNAME']?? 'root',
            'password' => $_ENV['MYSQL_DB_PASSWORD']?? '',
        ],
        'clickhouse' => [
            'host' => $_ENV['CLICKHOUSE_DB_HOST']?? 'db',
            'port' => $_ENV['CLICKHOUSE_DB_PORT']?? '9003',
            'database' => $_ENV['CLICKHOUSE_DB_DATABASE']?? 'test_db',
            'username' => $_ENV['CLICKHOUSE_DB_USERNAME']?? 'root',
            'password' => $_ENV['CLICKHOUSE_DB_PASSWORD']?? '',
        ]
    ],
    'rabbitmq' => [
        'host' => $_ENV['RABBITMQ_DEFAULT_HOST'],
        'port' => $_ENV['RABBITMQ_DEFAULT_PORT'],
        'channel' => $_ENV['RABBITMQ_DEFAULT_CHANNEL'],
        'user' => $_ENV['RABBITMQ_DEFAULT_USER'],
        'password' => $_ENV['RABBITMQ_DEFAULT_PASS'],
    ],
];
