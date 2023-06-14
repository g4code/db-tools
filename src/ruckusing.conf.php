<?php

/**
 * Variables defined inside bootstrap.php
 * @var $options array
 * @var $dbConfigData array
 */

$localPath = __DIR__ . '/../../../../' . $options['ruckusing_dir'];

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
            'directory' => 'default',
            //'socket' => '/var/run/mysqld/mysqld.sock'
        ]
    ],
    'migrations_dir' => ['default' => realpath($localPath . '/migrations')],
    'db_dir'         => realpath($localPath . '/dumps'),
    'log_dir'        => realpath($localPath . '/logs'),
    'ruckusing_base' => realpath($localPath . '/../vendor/g4/ruckusing-migrations'),
    'tasks_dir'      => realpath(__DIR__ . '/Task'),
    'platforms'       => ['ALL', 'EUD'],
];