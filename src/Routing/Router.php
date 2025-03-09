<?php

namespace PsychedelicMonkey\Framework\Routing;

use FastRoute\RouteCollector;
use PsychedelicMonkey\Framework\Http\Request;
use function FastRoute\simpleDispatcher;

class Router implements RouterInterface
{
    public function dispatch(Request $request): array
    {
        $dispatcher = simpleDispatcher(function (RouteCollector $r) {
            $routes = include_once BASE_DIR . '/routes/web.php';

            foreach ($routes as $route) {
                $r->addRoute(...$route);
            }
        });

        $routeInfo = $dispatcher->dispatch(
            $request->getMethod(),
            $request->getPath()
        );

        [$status, [$controller, $method], $vars] = $routeInfo;

        return [[new $controller, $method], $vars];
    }
}
