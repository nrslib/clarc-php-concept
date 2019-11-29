<?php

require __DIR__ . '/../vendor/autoload.php';

list($app, $serviceProvider) = require_once __DIR__ . '/../startup.php';


$kernel = new \Clarc\Basis\Http\Kernel($app, $serviceProvider);
$kernel->handle();