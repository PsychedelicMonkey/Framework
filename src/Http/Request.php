<?php

namespace PsychedelicMonkey\Framework\Http;

readonly class Request
{
    public function __construct(
        public array $getParams = [],
        public array $postParams = [],
        public array $files = [],
        public array $cookies = [],
        public array $server = []
    ) {
        //
    }

    public static function createFromGlobals(): static
    {
        return new static($_GET, $_POST, $_FILES, $_COOKIE, $_SERVER);
    }

    public function getMethod(): string
    {
        return $this->server['REQUEST_METHOD'];
    }

    public function getPath(): string
    {
        $uri = strtok($this->server['REQUEST_URI'], '?');

        return rawurldecode($uri);
    }
}
