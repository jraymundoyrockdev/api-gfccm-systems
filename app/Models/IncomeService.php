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
        return $this->hasOne(Service::class, 'id', 'service_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }

}
