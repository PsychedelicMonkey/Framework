<?php

use App\Controllers\HomeController;
use App\Controllers\PostController;
use PsychedelicMonkey\Framework\Http\Response;

return [
    ['GET', '/', [HomeController::class, 'index']],
    ['GET', '/posts/{id:\d+}', [PostController::class, 'show']],
    ['GET', '/hello/{name:.+}', function (string $name) {
        return new Response("<h1>Hello {$name}</h1>");
    }]
];
