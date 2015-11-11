<?php namespace ApiGfccm\Models;

use Illuminate\Database\Eloquent\Model;

class IncomeService extends Model
{
    protected $table = 'income_services';

    protected $fillable = [
        'service_id',
        'tithes',
        'offering',
        'other_fund',
        'total',
        'service_date',
        'status',
        'created_by',
        'role_access'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
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
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function fund_structure()
    {
        return $this->hasMany(IncomeServiceFundStructure::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function denomination_structure()
    {
        return $this->hasMany(IncomeServiceDenominationStructure::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function member_fund_total()
    {
        return $this->hasMany(IncomeServiceMemberFundTotal::class);
    }
}
