<?php

use PsychedelicMonkey\Framework\Http\Kernel;
use PsychedelicMonkey\Framework\Http\Request;
use PsychedelicMonkey\Framework\Routing\SimpleRouter;

define('BASE_DIR', dirname(__DIR__));

require_once BASE_DIR . '/vendor/autoload.php';

$request = Request::createFromGlobals();

$router = new SimpleRouter();

$kernel = new Kernel($router);

$response = $kernel->handle($request);

$response->send();
