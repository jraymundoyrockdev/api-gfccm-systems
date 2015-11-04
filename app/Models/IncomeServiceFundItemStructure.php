<?php namespace ApiGfccm\Models;

use Illuminate\Database\Eloquent\Model;

class IncomeServiceFundItemStructure extends Model
{
    protected $table = 'income_service_fund_item_structures';

    protected $fillable = [
        'fund_structure_id',
        'fund_item_id',
        'name'
    ];
}
