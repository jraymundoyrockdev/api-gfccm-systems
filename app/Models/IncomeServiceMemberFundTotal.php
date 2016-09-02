<?php namespace ApiGfccm\Models;

use Illuminate\Database\Eloquent\Model;

class IncomeServiceMemberFundTotal extends Model
{
    /**
     * @var string
     */
    protected $table = 'income_service_member_fund_totals';

    /**
     * @var array
     */
    protected $fillable = [
        'income_service_id',
        'member_id',
        'tithes',
        'offering',
        'others',
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
    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
