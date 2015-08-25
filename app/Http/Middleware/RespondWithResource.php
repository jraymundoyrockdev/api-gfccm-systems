<?php namespace ApiGfccm\Http\Middleware;

use Closure;
use League\Fractal\Manager;
use League\Fractal\Serializer\JsonApiSerializer;

class RespondWithResource
{
    /**
     * @var Manager
     */
    protected $fractal;

    public function __construct(Manager $fractal)
    {
        $this->fractal = $fractal;
        $this->fractal->setSerializer(new JsonApiSerializer);
    }

    public function handle($request, Closure $next)
    {
        $response = $next($request);

        if (!isset($response->original)) {
            return $response;
        }
        if (!is_callable($response)) {
            return $response;
        }
        $response->setContent($this->fractal->createData($response())->toJson());

        return $response;
    }
}
