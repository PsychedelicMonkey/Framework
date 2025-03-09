<?php

namespace PsychedelicMonkey\Framework\Http;

class Kernel
{
    public function handle(Request $request): Response
    {
        return new Response('<h1>Hello</h1>');
    }
}
