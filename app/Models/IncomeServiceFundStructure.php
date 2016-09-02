<?php namespace ApiGfccm\Models;

use Illuminate\Database\Eloquent\Model;

class IncomeServiceFundStructure extends Model
{
    /**
     * @var string
     */
    protected $table = 'income_service_fund_structures';

    /**
     * @var array
     */
    protected $fillable = [
        'income_service_id',
        'fund_id',
        'name'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function item_structures()
    {
        return $this->hasMany(IncomeServiceFundItemStructure::class, 'fund_structure_id', 'id');
    }
}
