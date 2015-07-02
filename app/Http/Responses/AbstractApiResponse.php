<?php namespace ApiGfccm\Http\Responses;

use Illuminate\Http\Response;
use League\Fractal\TransformerAbstract;

abstract class AbstractApiResponse extends Response
{
    /**
     * Metadata for the response
     *
     * @var array
     */
    public $meta = [];

    /**
     * Optional type key for the response
     *
     * @var string
     */
    protected $type = null;

    /**
     * Get the type name for the response
     *
     * @return string
     */
    abstract protected function getTypeName();

    /**
     * Get an instance of a Fractal resource
     *
     * @param TransformerAbstract $transformer
     * @return \League\Fractal\Resource\ResourceAbstract
     */
    abstract protected function getResourceInstance(TransformerAbstract $transformer);

    /**
     * Set any extra metadata for the response
     *
     * @param array $meta
     * @return $this
     */
    final public function withMeta($meta = [])
    {
        $this->meta = $meta;
        return $this;
    }

    /**
     * Optionally set the type key for the response
     *
     * @param string $type
     * @return $this
     */
    final public function asType($type = null)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Process the response through Fractal
     *
     * @return \League\Fractal\Resource\Collection|\League\Fractal\Resource\Item
     */
    public function __invoke()
    {
       // echo $this->getTypeName(); die;
        $transformer = 'ApiGfccm\Http\Controllers\Api\Transformers\\' . $this->getTypeName() . 'Transformer';
        $resource = $this->getResourceInstance(new $transformer);
        foreach ($this->meta as $key => $value) {
            $resource->setMetaValue($key, $value);
        }

        return $resource;
    }
}
