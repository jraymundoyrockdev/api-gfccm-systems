<?php namespace ApiGfccm\Models;

use Illuminate\Database\Eloquent\Model;

class IncomeServiceMemberFund extends Model
{
    protected $table = 'income_service_member_funds';

    protected $fillable = [
        'income_service_id',
        'member_id',
        'fund_id',
        'fund_item_id',
        'amount'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function income_service()
    {
        return $this->belongsTo(IncomeService::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
