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
}
