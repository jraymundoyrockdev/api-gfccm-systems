<?php

namespace ApiGfccm\Models;

use Illuminate\Database\Eloquent\Model;

class MinistryTransaction extends Model
{
    /**
     * @var string
     */
    protected $table = 'ministry_transactions';

    /**
     * @var array
     */
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
