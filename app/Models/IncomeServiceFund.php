<?php namespace ApiGfccm\Models;

use Illuminate\Database\Eloquent\Model;

class IncomeServiceFund extends Model
{
    protected $table = 'income_service_fund';

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
        return $this->hasOne(IncomeService::class, 'id', 'service_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function member()
    {
        return $this->hasOne(Member::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function fund()
    {
        return $this->hasOne(Fund::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function fund_item()
    {
        return $this->hasOne(FundItem::class);
    }

}
