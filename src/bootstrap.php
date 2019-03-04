<?php

/**
 * @var $options array
 */
require __DIR__ . '/../src/common.php';

chdir(dirname(__DIR__));

define('PATH_ROOT', realpath(getcwd() . '/../../../') . '/');

if (getenv('PLATFORM_ENV')){
    $options['ini'] = str_replace('application.ini', 'application-'.getenv('PLATFORM_ENV').'.ini', $options['ini']);
}

require_once realpath(getcwd() . '/../../autoload.php');

try {
    $applicationIniConf = new \G4\Config\Config();
    $applicationIniData = $applicationIniConf
        ->setPath(realpath(PATH_ROOT . $options['ini']))
        ->setSection($options['env'])
        ->setCachingEnabled(false)
        ->getData(true);
} catch (\Exception $exception) {
    die("\n application.ini: " . $exception->getMessage() . "\n\n");
}

if (!is_array($applicationIniData)) {
    die("\nDI didn't load config data from application.ini");
}
if(!isset($applicationIniData['resources']['db']['params']['host'])) {
    die("\nDB host param is not set\n\n");
}
if(!isset($applicationIniData['resources']['db']['params']['port'])) {
    die("\nDB port param is not set\n\n");
}
if(!isset($applicationIniData['resources']['db']['params']['dbname'])) {
    die("\nDB dbname param is not set\n\n");
}
if(!isset($applicationIniData['resources']['db']['params']['username'])) {
    die("\nDB username param is not set\n\n");
}
if(!isset($applicationIniData['resources']['db']['params']['password'])) {
    die("\nDB password param is not set\n\n");
}

$dbConfigData = $applicationIniData['resources']['db']['params'];

echo "params: {$dbConfigData['host']} | {$dbConfigData['dbname']} | {$dbConfigData['username']} | {$dbConfigData['password']}";

chdir(__DIR__);
