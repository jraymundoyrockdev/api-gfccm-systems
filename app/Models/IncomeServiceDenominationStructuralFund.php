<?php namespace ApiGfccm\Models;

use Illuminate\Database\Eloquent\Model;

class IncomeServiceDenominationStructuralFund extends Model
{
    protected $table = 'income_service_denomination_structural_funds';

    protected $fillable = [
        'income_service_id',
        'denomination_id'
    ];
}
