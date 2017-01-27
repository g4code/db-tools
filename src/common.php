<?php

date_default_timezone_set('Europe/Belgrade');

foreach ($argv as $argument) {
    preg_match('~^env=(.*)$~uxsi', $argument, $matches);
    if (!empty($matches)) {
        $options['env'] = $matches[1];
    }
    preg_match('~^sql-dump=(.*)$~uxsi', $argument, $matches);
    if (!empty($matches) && $matches[1] !== "") {
        $options['sql-dump'] = $matches[1];
    }
    preg_match('~^ini=(.*)$~uxsi', $argument, $matches);
    if (!empty($matches) && $matches[1] !== "") {
        $options['ini'] = $matches[1];
    }
    preg_match('~^ruckusing_dir=(.*)$~uxsi', $argument, $matches);
    if (!empty($matches) && $matches[1] !== "") {
        $options['ruckusing_dir'] = $matches[1];
    }
}

if (empty($options['env'])) {
    die("\nenv param is empty\n\n");
}

if (empty($options['ini'])) {
    die("\nini param is empty\n\n");
}

if (empty($options['ruckusing_dir'])) {
    die("\nruckusing_dir param is empty.\n\n");
}

define('APPLICATION_ENV', $options['env']);

function checkRequiredFolders()
{
    global $options, $dbConfigData;
    $ruckusingConf = require __DIR__ . '/../src/ruckusing.conf.php';
    
    if (!$ruckusingConf['migrations_dir']['default']) {
        die("\nMissing folder 'migrations'.\n\n");
    }
    if (!$ruckusingConf['db_dir']) {
        die("\nMissing folder 'dumps'.\n\n");
    }
    if (!$ruckusingConf['log_dir']) {
        die("\nMissing folder 'logs'.\n\n");
    }
    if (!$ruckusingConf['ruckusing_base']) {
        die("\nMissing ruckusing/ruckusing-migration spackage.\n\n");
    }
    
}

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