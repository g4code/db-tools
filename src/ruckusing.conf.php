<?php

/**
 * Variables defined inside bootstrap.php
 * @var $options array
 * @var $dbConfigData array
 */

$localPath = __DIR__ . '/../../../../db/';

return [
    'db' => [
        $options['env'] => [
            'type'      => 'mysql',
            'host'      => $dbConfigData['host'],
            'port'      => $dbConfigData['port'],
            'database'  => $dbConfigData['dbname'],
            'user'      => $dbConfigData['username'],
            'password'  => $dbConfigData['password'],
            'charset'   => 'utf8',
            'directory' => 'nd_api_slim',
            //'socket' => '/var/run/mysqld/mysqld.sock'
        ]
    ],
    'migrations_dir' => ['default' => $localPath . '/migrations'],
    'db_dir'         => $localPath . '/dumps',
    'log_dir'        => $localPath . '/logs',
    'ruckusing_base' => $localPath . '/../vendor/ruckusing/ruckusing-migrations'
];