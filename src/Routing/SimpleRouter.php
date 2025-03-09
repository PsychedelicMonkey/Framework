<?php

namespace PsychedelicMonkey\Framework\Routing;

use FastRoute\RouteCollector;
use PsychedelicMonkey\Framework\Http\HttpException;
use PsychedelicMonkey\Framework\Http\HttpRequestMethodException;
use PsychedelicMonkey\Framework\Http\Request;
use function FastRoute\simpleDispatcher;

class SimpleRouter extends Router implements RouterInterface
{
    protected function createDispatcher(): void
    {
        $this->dispatcher = simpleDispatcher(function (RouteCollector $r) {
            $this->addRoutes($r);
        });
    }

    /**
     * @throws HttpRequestMethodException
     * @throws HttpException
     */
    public function dispatch(Request $request): array
    {
        return $this->handleDispatch($request);
    }
}
