<?php

namespace ApiGfccm\Models;

use Illuminate\Database\Eloquent\Model;

class FundItem extends Model
{
    /**
     * @var string
     */
    protected $table = 'fund_items';

    /**
     * @var array
     */
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
        return $this->belongsTo(Fund::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function fund_structure()
    {
        return $this->belongsTo(IncomeServiceFundStructure::class, 'fund_id', 'id');
    }
}
