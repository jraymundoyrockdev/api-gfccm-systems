<?php namespace ApiGfccm\Models;

use Illuminate\Database\Eloquent\Model;

class IncomeServiceFundItemStructure extends Model
{
    /**
     * @var string
     */
    protected $table = 'income_service_fund_item_structures';

    /**
     * @var array
     */
    protected $fillable = [
        'fund_structure_id',
        'fund_item_id',
        'name'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function fund_structure()
    {
        return $this->belongsTo(IncomeServiceFundStructure::class);
    }
}
