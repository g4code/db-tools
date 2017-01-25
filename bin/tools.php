<?php
/**
 * Variables defined inside bootstrap.php
 *
 * @var $dbConfigData array
 */

include __DIR__ . '/../src/bootstrap.php';

$mysqlConnectCommand = "mysql -u {$dbConfigData['username']} -p{$dbConfigData['password']} -h {$dbConfigData['host']}";

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
    $sqlDumpFile = getSqlDumpPath($options);
    $command = $mysqlConnectCommand . " {$dbConfigData['dbname']} --execute=\"source $sqlDumpFile\" --force";
}

// GEONAME TABLE IMPORT
if (in_array('import:geoname', $argv)) {
    $sqlDumpFile = getSqlDumpPath($options);
    $command = $mysqlConnectCommand . " {$dbConfigData['dbname']} --execute=\"source $sqlDumpFile\" --force";
}

$output = shell_exec($command);
echo("\n" . $output . "\n");


function getSqlDumpPath($options)
{
    if (!array_key_exists('sql-dump', $options)) {
        die("\nError: sql-dump command line parameter with SQL dump file is not supplied.\n\n");
    }
    $filePath = realpath(PATH_ROOT . DIRECTORY_SEPARATOR . $options['sql-dump']);
    if (!$filePath) {
        die(sprintf("\nFile '%s' does not exist relative to path '%s'\n\n", $options['sql-dump'], PATH_ROOT));
    }
    return $filePath;
}