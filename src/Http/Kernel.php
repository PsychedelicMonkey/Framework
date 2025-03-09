<?php

namespace PsychedelicMonkey\Framework\Http;

use FastRoute\RouteCollector;
use function FastRoute\simpleDispatcher;

class Kernel
{
    public function handle(Request $request): Response
    {
        $dispatcher = simpleDispatcher(function (RouteCollector $r) {
            $r->addRoute('GET', '/', function () {
                return new Response('<h1>Home Page</h1>');
            });

            $r->addRoute('GET', '/posts/{id:\d+}', function ($routeParams) {
                return new Response("<h1>This is post {$routeParams['id']}</h1>");
            });
        });

        $routeInfo = $dispatcher->dispatch(
            $request->getMethod(),
            $request->getPath()
        );

        [$status, $handler, $vars] = $routeInfo;

        return $handler($vars);
    }
}
