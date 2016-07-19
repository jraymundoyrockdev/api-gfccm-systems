<?php

namespace ApiGfccm\Http\Middleware;

use Closure;

class PassThrough
{
    /**
     * Passes a request through. This is used for testing to bypass specific
     * middleware
     *
     * @param \Illuminate\Http\Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        return $next($request);
    }
}
