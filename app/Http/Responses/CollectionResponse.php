<?php namespace ApiGfccm\Http\Responses;

use Illuminate\Support\Str;
use League\Fractal\Resource\Collection;
use League\Fractal\TransformerAbstract;

class CollectionResponse extends AbstractApiResponse
{
    /**
     * {@inheritdoc}
     */
    protected function getTypeName()
    {
        return $this->type ?: str_replace('ApiGfccm\\', '', get_class($this->original->first()));
    }

    /**
     * {@inheritdoc}
     */
    protected function getResourceInstance(TransformerAbstract $transformer)
    {
        return new Collection(
            $this->original,
            $transformer,
            Str::plural($this->getTypeName())
        );
    }
}
