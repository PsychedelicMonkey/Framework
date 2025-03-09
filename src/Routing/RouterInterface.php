<?php

namespace PsychedelicMonkey\Framework\Routing;

use PsychedelicMonkey\Framework\Http\Request;

interface RouterInterface
{
    public function dispatch(Request $request): array;
}
