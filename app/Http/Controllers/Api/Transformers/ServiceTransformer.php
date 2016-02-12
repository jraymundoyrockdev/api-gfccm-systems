<?php namespace ApiGfccm\Http\Controllers\Api\Transformers;

use ApiGfccm\Models\Service;
use League\Fractal\TransformerAbstract;

class ServiceTransformer extends TransformerAbstract
{
    public function transform(Service $service)
    {
        return [
            'id' => (int) $service->id,
            'name' => $service->name,
            'start_time' => $this->reformatTime($service->start_time),
            'end_time' => $this->reformatTime($service->end_time),
            'description' => $service->description
        ];
    }

    /**
     * Reformat Time
     *
     * @param $time
     * @param string $format
     * @return bool|string
     */
    private function reformatTime($time, $format = 'H:i')
    {
        return date($format, strtotime($time));
    }

}