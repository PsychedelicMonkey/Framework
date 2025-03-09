<?php

use PsychedelicMonkey\Framework\Http\Kernel;
use PsychedelicMonkey\Framework\Http\Request;
use PsychedelicMonkey\Framework\Routing\Router;

define('BASE_DIR', dirname(__DIR__));

require_once BASE_DIR . '/vendor/autoload.php';

$request = Request::createFromGlobals();

$router = new Router();

$kernel = new Kernel($router);

$response = $kernel->handle($request);

$response->send();
