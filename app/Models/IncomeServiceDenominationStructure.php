<?php namespace ApiGfccm\Models;

use Illuminate\Database\Eloquent\Model;

class IncomeServiceDenominationStructure extends Model
{
    protected $table = 'income_service_denomination_structures';

    protected $fillable = [
        'income_service_id',
        'denomination_id',
        'amount'
    ];
}
