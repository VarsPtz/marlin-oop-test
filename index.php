<?php
require_once 'Database.php';
require_once 'Config.php';

$GLOBALS['config'] = [
    'mysql' => [
        'host' => 'localhost',
        'username' => 'root',
        'password' => '',
        'database' => 'test',
        'something' => [
            'no' => 'yes'
        ]
    ]
];

echo Config::get('mysql.host');