<?php

namespace PsychedelicMonkey\Framework\Routing;

use FastRoute\RouteCollector;
use PsychedelicMonkey\Framework\Http\HttpException;
use PsychedelicMonkey\Framework\Http\HttpRequestMethodException;
use PsychedelicMonkey\Framework\Http\Request;
use function FastRoute\cachedDispatcher;

class CacheRouter extends Router implements RouterInterface
{
    protected function createDispatcher(): void
    {
        $this->dispatcher = cachedDispatcher(function (RouteCollector $r) {
            $this->addRoutes($r);
        }, [
            'cacheFile' => BASE_DIR . '/cache/routes.php',
        ]);
    }

    /**
     * @throws HttpException
     * @throws HttpRequestMethodException
     */
    public function dispatch(Request $request): array
    {
        return $this->handleDispatch($request);
    }
}
