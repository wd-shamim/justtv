<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BlockMadurird
{
    public function handle($request, Closure $next)
    {
        if (strpos($request->header('referer'), 'madurird.com') !== false) {
            abort(403, 'Access denied');
        }

        return $next($request);
    }
}
