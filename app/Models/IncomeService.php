<?php namespace ApiGfccm\Models;

use Illuminate\Database\Eloquent\Model;

class IncomeService extends Model
{
    /**
     * @var string
     */
    protected $table = 'income_services';

    /**
     * @var array
     */
    protected $fillable = [
        'service_id',
        'tithes',
        'offering',
        'other_fund',
        'total',
        'service_date',
        'status',
        'created_by'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function fund_structures()
    {
        return $this->hasMany(IncomeServiceFundStructure::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function denomination_structures()
    {
        return $this->hasMany(IncomeServiceDenomination::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function member_fund_totals()
    {
        return $this->hasMany(IncomeServiceMemberFundTotal::class);
    }
}
