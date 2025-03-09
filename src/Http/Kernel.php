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
        } catch (HttpRequestMethodException $e) {
            $response = new Response($e->getMessage(), 405);
        } catch (HttpException $e) {
            $response = new Response($e->getMessage(), 404);
        } catch (Exception $e) {
            $response = new Response($e->getMessage(), 500);
        }

        return $response;
    }
}
