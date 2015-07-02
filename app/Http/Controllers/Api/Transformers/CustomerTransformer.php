<?php namespace KyokaiAccSys\Http\Controllers\Api\Transformers;

use League\Fractal\TransformerAbstract;
use KyokaiAccSys\Customer;

class CustomerTransformer extends TransformerAbstract
{
    public function transform(Customer $customer)
    {
        return [
            'id' => (int) $customer->id,
            'is_active' => (bool) $customer->is_active,
            'title' => $customer->title,
            'first_name' => $customer->first_name,
            'last_name' => $customer->last_name
        ];
    }
}