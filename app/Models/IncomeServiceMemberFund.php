<?php namespace ApiGfccm\Models;

use Illuminate\Database\Eloquent\Model;

class IncomeServiceMemberFund extends Model
{
    /**
     * @var string
     */
    protected $table = 'income_service_member_funds';

    /**
     * @var array
     */
    protected $fillable = [
        'income_service_id',
        'member_id',
        'fund_id',
        'fund_item_id',
        'amount'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function income_service()
    {
        return $this->belongsTo(IncomeService::class);
    }

}
