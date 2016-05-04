<?php

namespace ApiGfccm\Models;

use Illuminate\Database\Eloquent\Model;

class MinistryTransaction extends Model
{
    protected $table = 'ministry_transactions';

    protected $fillable = [
        'ministry_id',
        'type',
        'amount',
        'transaction_date',
        'description',
        'running_balance',
        'document_image'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ministry()
    {
        return $this->belongsTo(Ministry::class);
    }
}
