<?php namespace ApiGfccm\Http\Middleware;

use Closure;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use League\Fractal\Manager;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
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

        if($response->original instanceof \Illuminate\Database\Eloquent\Collection){
            return $this->collectionResponse($response);
        }

        return $this->itemResponse($response);
    }

    private function collectionResponse(Response $response)
    {
        $type = str_replace('ApiGfccm\\', '', get_class($response->original->first()));
        $transformer = 'ApiGfccm\Http\Controllers\Api\Transformers\\' . $type . 'Transformer';
        $resource = new Collection(
            $response->original,
            new $transformer,
            Str::plural($type)
        );

        if ($response->original instanceof Paginator) {
            $resource->setPaginator(new IlluminatePaginatorAdapter($response->original));
        }

        $response->setContent($this->fractal->createData($resource)->toJson());

        return $response;
    }

    private function itemResponse(Response $response)
    {
        $type = str_replace('ApiGfccm\\', '', get_class($response->original));
        $transformer = '\ApiGfccm\Http\Controllers\Api\Transformers\\' . $type . 'Transformer';
        $resource = new Item(
            $response->original,
            new $transformer,
            $type
        );
        $response->setContent($this->fractal->createData($resource)->toJson());

        return $response;
    }
}