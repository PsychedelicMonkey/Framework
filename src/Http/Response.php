<?php

namespace PsychedelicMonkey\Framework\Http;

readonly class Response
{
    function __construct(
        public ?string $content = '',
        private int $status = 200,
        private array $headers = []
    ) {
        http_response_code($this->status);
    }

    public function send(): void
    {
        echo $this->content;
    }
}
