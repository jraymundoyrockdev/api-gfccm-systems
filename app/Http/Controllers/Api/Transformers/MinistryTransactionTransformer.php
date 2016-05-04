<?php namespace ApiGfccm\Http\Controllers\Api\Transformers;

use ApiGfccm\Models\MinistryTransaction;
use League\Fractal\TransformerAbstract;

class MinistryTransactionTransformer extends TransformerAbstract
{
    /**
     * @param MinistryTransaction $ministryTransaction
     * @return array
     */
    public function transform(MinistryTransaction $ministryTransaction)
    {
        return [
            'id' => (int)$ministryTransaction->id,
            'ministry_id' => $ministryTransaction->ministry_id,
            'type' => $ministryTransaction->type,
            'amount' => $ministryTransaction->amount,
            'transaction_date' => $ministryTransaction->transaction_date,
            'description' => $ministryTransaction->description,
            'running_balance' => $ministryTransaction->running_balance,
            'document_image' => $ministryTransaction->document_image
        ];
    }
}
