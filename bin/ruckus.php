#!/usr/bin/env php
<?php

require_once __DIR__ . '/../src/bootstrap.php';

$ruckusingConf = require __DIR__ . '/../src/ruckusing.conf.php';
checkRequiredFolders($ruckusingConf);

$argc++;

require_once __DIR__ . '/../../../g4/ruckusing-migrations/ruckus.php';