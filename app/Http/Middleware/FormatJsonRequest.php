<?php namespace ApiGfccm\Http\Middleware;

use Closure;

class FormatJsonRequest
{
    /**
     * Takes an incoming JSON API request and converts it back into
     * a format that Laravel can understand by stripping off the
     * type key and handing the formatted array down the line
     *
     * @param $request
     * @param Closure $next
     */
    public function handle($request, Closure $next)
    {
        $input = !empty($request->all()) ? array_values($request->all())[0] : null;
        if (is_array($input)) {
            $request->replace($input);
        }
        return $next($request);
    }
}
