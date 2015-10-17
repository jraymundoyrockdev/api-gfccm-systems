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
     * All of the relationships to be touched.
     *
     * @var array
     */
    protected $touches = ['fund'];
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function fund()
    {
        return $this->belongsTo(Fund::class, 'fund_id', 'id');
    }
}
