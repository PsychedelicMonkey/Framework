<?php

use PsychedelicMonkey\Framework\Http\Kernel;
use PsychedelicMonkey\Framework\Http\Request;

define('BASE_DIR', dirname(__DIR__));

require_once BASE_DIR . '/vendor/autoload.php';

$request = Request::createFromGlobals();

$kernel = new Kernel();

$response = $kernel->handle($request);

$response->send();
