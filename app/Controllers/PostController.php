<?php

namespace App\Controllers;

use PsychedelicMonkey\Framework\Http\Response;

class PostController
{
    public function show(int $id): Response
    {
        return new Response("<h1>This is post {$id}</h1>");
    }
}
