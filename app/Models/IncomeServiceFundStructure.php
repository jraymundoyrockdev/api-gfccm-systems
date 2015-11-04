<?php namespace ApiGfccm\Models;

use Illuminate\Database\Eloquent\Model;

class IncomeServiceFundStructure extends Model
{
    protected $table = 'income_service_fund_structures';

    protected $fillable = [
        'income_service_id',
        'fund_id',
        'name'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function item()
    {
        return $this->hasMany(FundItem::class, 'fund_id', 'fund_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function item_structure()
    {
        return $this->hasMany(IncomeServiceFundItemStructure::class, 'fund_structure_id', 'id');
    }
}
