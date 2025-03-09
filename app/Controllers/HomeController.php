<?php

namespace App\Controllers;

use PsychedelicMonkey\Framework\Http\Response;

class HomeController
{
    public function index(): Response
    {
        return new Response('<h1>Home Page</h1>');
    }
}
