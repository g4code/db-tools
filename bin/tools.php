<?php
/**
 * Variables defined inside bootstrap.php
 *
 * @var $dbConfigData array
 */

include __DIR__ . DIRECTORY_SEPARATOR . 'bootstrap.php';

$mysqlConnectCommand = "mysql -u {$dbConfigData['username']} -p{$dbConfigData['password']} -h {$dbConfigData['host']}";
$dbSourceFilePath = realpath(implode(DIRECTORY_SEPARATOR, [__DIR__, 'db', 'nd_api_v1.0.0.sql']));
$dbGeonameFilePath = realpath(implode(DIRECTORY_SEPARATOR, [__DIR__, 'db', 'geoname.compact.sql']));

$command = '/bin/echo nothing to execute';

// CREATE DATABASE
if (in_array('create:database', $argv)) {
    $command = $mysqlConnectCommand . " --execute=\"CREATE DATABASE IF NOT EXISTS {$dbConfigData['dbname']} DEFAULT CHARSET UTF8;\"";
}

// DROP DATABASE
if (in_array('drop:database', $argv)) {
    $command = $mysqlConnectCommand . " --execute=\"DROP DATABASE IF EXISTS {$dbConfigData['dbname']};\" --force";
}

// IMPORT DATA
if (in_array('import:data', $argv)) {
    $command = $mysqlConnectCommand . " {$dbConfigData['dbname']} --execute=\"source {$dbSourceFilePath}\" --force";
}

// GEONAME TABLE IMPORT
if (in_array('import:geoname', $argv)) {
    $command = $mysqlConnectCommand . " {$dbConfigData['dbname']} --execute=\"source {$dbGeonameFilePath}\" --force";
}

$output = shell_exec($command);
echo("\n" . $output . "\n");