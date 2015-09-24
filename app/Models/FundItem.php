<?php

namespace ApiGfccm\Models;

use Illuminate\Database\Eloquent\Model;

class FundItem extends Model
{
    protected $table = 'fund_items';

    protected $fillable = [
        'fund_id',
        'name',
        'status'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function fund()
    {
        return $this->belongsTo(Fund::class, 'id', 'fund_id');
    }
}
