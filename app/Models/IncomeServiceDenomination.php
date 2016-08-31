<?php namespace ApiGfccm\Models;

use Illuminate\Database\Eloquent\Model;

class IncomeServiceDenomination extends Model
{
    /**
     * @var string
     */
    protected $table = 'income_service_denominations';

    /**
     * @var array
     */
    protected $fillable = [
        'income_service_id',
        'denomination_id',
        'description',
        'amount',
        'piece',
        'total'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function income_service()
    {
        return $this->belongsTo(IncomeService::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function denomination()
    {
        return $this->belongsTo(Denomination::class);
    }
}
