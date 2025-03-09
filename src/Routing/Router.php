<?php

namespace PsychedelicMonkey\Framework\Routing;

use FastRoute\Dispatcher;
use FastRoute\RouteCollector;
use PsychedelicMonkey\Framework\Http\HttpException;
use PsychedelicMonkey\Framework\Http\HttpRequestMethodException;
use PsychedelicMonkey\Framework\Http\Request;

abstract class Router
{
    protected Dispatcher $dispatcher;

    public function __construct()
    {
        $this->createDispatcher();
    }

    protected abstract function createDispatcher(): void;

    /**
     * @throws HttpException
     * @throws HttpRequestMethodException
     */
    public function handleDispatch(Request $request): array
    {
        $routeInfo = $this->extractRouteInfo($request);

        [$handler, $vars] = $routeInfo;

        if (is_array($handler)) {
            [$controller, $method] = $handler;
            $handler = [new $controller, $method];
        }

        return [$handler, $vars];
    }

    /**
     * @throws HttpRequestMethodException
     * @throws HttpException
     */
    private function extractRouteInfo(Request $request): array
    {
        $routeInfo = $this->dispatcher->dispatch(
            $request->getMethod(),
            $request->getPath()
        );

        switch ($routeInfo[0]) {
            case Dispatcher::FOUND:
                return [$routeInfo[1], $routeInfo[2]];
            case Dispatcher::METHOD_NOT_ALLOWED:
                $allowedMethods = implode(', ', $routeInfo[1]);
                $e = new HttpRequestMethodException("The allowed methods are $allowedMethods");
                $e->setStatusCode(405);
                throw $e;
            default:
                $e = new HttpException('Not found');
                $e->setStatusCode(404);
                throw $e;
        }
    }

    protected function addRoutes(RouteCollector $r): void
    {
        $routes = include_once BASE_DIR . '/routes/web.php';

        foreach ($routes as $route) {
            $r->addRoute(...$route);
        }
    }
}
