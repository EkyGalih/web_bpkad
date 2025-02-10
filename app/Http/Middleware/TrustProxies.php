<?php

namespace App\Http\Middleware;

use Illuminate\Http\Middleware\TrustProxies as Middleware;
use Symfony\Component\HttpFoundation\Request;

class TrustProxies extends Middleware
{
    protected $proxies = '*';

    protected function headers(): int
    {
        return Request::HEADER_FORWARDED;
    }
}
