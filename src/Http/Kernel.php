<?php

namespace PsychedelicMonkey\Framework\Http;

use Exception;
use PsychedelicMonkey\Framework\Routing\RouterInterface;

readonly class Kernel
{
    public function __construct(
        private RouterInterface $router
    ) {
        //
    }

    public function handle(Request $request): Response
    {
        try {
            [$routeHandler, $vars] = $this->router->dispatch($request);

            return call_user_func_array($routeHandler, $vars);
        } catch (Exception $e) {
            $response = new Response($e->getMessage(), 400);
        }

        return $response;
    }
}
