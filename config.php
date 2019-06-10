<?php

return [
    'app' => [
        'appName' => 'Adaptor'
    ],
    'database' => [
        'name' => 'Test',
        'username' => 'root',
        'password' => 'root',
        'connection' => 'mysql:host=127.0.0.1',
        'options' => [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING
        ]
    ],
    'data' => [
        [
            'first_name' => 'Kiestis',
            'age' => 29,
            'gender' => 'male'
        ],
        [
            'first_name' => 'Vytska',
            'age' => 32,
            'gender' => 'male'
        ],
        [
            'first_name' => 'Karina',
            'age' => 25,
            'gender' => 'female'
        ],
    ],
];