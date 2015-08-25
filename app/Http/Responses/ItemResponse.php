<?php namespace ApiGfccm\Http\Responses;

use League\Fractal\Resource\Item;
use League\Fractal\TransformerAbstract;

class ItemResponse extends AbstractApiResponse
{
    /**
     * {@inheritdoc}
     */
    protected function getTypeName()
    {
        return $this->type ?: str_replace('ApiGfccm\\', '', get_class($this->original));
    }

    /**
     * {@inheritdoc}
     */
    protected function getResourceInstance(TransformerAbstract $transformer)
    {
        return new Item(
            $this->original,
            $transformer,
            $this->getTypeName()
        );
    }
}
