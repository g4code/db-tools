<?php

date_default_timezone_set('Europe/Belgrade');

chdir(dirname(__DIR__));

$options = getopt('', [ 'env:', 'sql-dump' ]); // todo getopt not in use

foreach ($argv as $argument) {
    preg_match('~^env=(.*)$~uxsi', $argument, $matches);
    if (!empty($matches)) {
        $options['env'] = $matches[1];
    }
    preg_match('~^sql-dump=(.*)$~uxsi', $argument, $matches);
    if (!empty($matches) && $matches[1] !== "") {
        $options['sql-dump'] = $matches[1];
    }
}

if (empty($options['env'])) {
    die("\nEnv param is empty\n\n");
}
define('APPLICATION_ENV', $options['env']);
define('PATH_ROOT', realpath(getcwd() . '/../../../') . '/');

require_once realpath(getcwd() . '/../../autoload.php');
require_once realpath(getcwd() . '/../../../application/setup/bootstrap.php');

if (!is_array(\App\DI::configData())) {
    die("\nDI didn't load config data from application.ini");
}
if(!isset(\App\DI::configData()['resources']['db']['params']['host'])) {
    die("\nDB host param is not set\n\n");
}
if(!isset(\App\DI::configData()['resources']['db']['params']['port'])) {
    die("\nDB port param is not set\n\n");
}
if(!isset(\App\DI::configData()['resources']['db']['params']['dbname'])) {
    die("\nDB dbname param is not set\n\n");
}
if(!isset(\App\DI::configData()['resources']['db']['params']['username'])) {
    die("\nDB username param is not set\n\n");
}
if(!isset(\App\DI::configData()['resources']['db']['params']['password'])) {
    die("\nDB password param is not set\n\n");
}

$dbConfigData = \App\DI::configData()['resources']['db']['params'];

echo "params: {$dbConfigData['host']} | {$dbConfigData['dbname']} | {$dbConfigData['username']} | {$dbConfigData['password']}";

chdir(__DIR__);