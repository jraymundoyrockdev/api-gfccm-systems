<?php namespace ApiGfccm\Models;

use Illuminate\Database\Eloquent\Model;

class IncomeServiceDenomination extends Model
{
    protected $table = 'income_service_denominations';

    protected $fillable = [
        'income_service_id',
        'denomination_id',
        'description',
        'amount',
        'piece',
        'total'
    ];
}