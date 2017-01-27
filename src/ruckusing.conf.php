<?php

/**
 * Variables defined inside bootstrap.php
 * @var $options array
 * @var $dbConfigData array
 */

if (!array_key_exists('ruckusing_dir', $options)) {
    die("\nMissing config for 'ruckusing_dir' which contains database related files.\n\n");
}

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
    'ruckusing_base' => realpath($localPath . '/../vendor/ruckusing/ruckusing-migrations')
];