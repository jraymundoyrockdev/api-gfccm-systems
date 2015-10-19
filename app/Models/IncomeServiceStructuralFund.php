<?php

namespace ApiGfccm\Models;

use Illuminate\Database\Eloquent\Model;

class IncomeServiceStructuralFund extends Model
{
    protected $table = 'income_service_structural_funds';

    protected $fillable = [
        'service_id',
        'fund_id',
        'fund_item_id'
    ];

}
