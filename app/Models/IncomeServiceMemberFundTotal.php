<?php namespace ApiGfccm\Models;

use Illuminate\Database\Eloquent\Model;

class IncomeServiceMemberFundTotal extends Model
{
    protected $table = 'income_service_member_fund_totals';

    protected $fillable = [
        'income_service_id',
        'member_id',
        'tithes',
        'offering',
        'others',
        'total'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function income_service()
    {
        return $this->hasOne(IncomeService::class, 'id', 'service_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
