<?php

namespace ApiGfccm\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    /**
     * @var string
     */
    protected $table = 'members';

    /**
     * @var array
     */
    protected $fillable = [
        'apellation',
        'firstname',
        'lastname',
        'middlename',
        'gender',
        'birthdate',
        'address',
        'phone_mobile',
        'email'
    ];

    /**
     * @var array
     */
    protected $appends = ['full_name', 'full_name_with_apellation'];

    /**
     * @return string
     */
    public function getFullNameAttribute()
    {
        return ucwords($this->attributes['firstname']) . ' ' . ucwords($this->attributes['lastname']);
    }

    /**
     * @return string
     */
    public function getFullNameWithApellationAttribute()
    {
        $apellation = (!empty($this->attributes['apellation']) ? $this->attributes['apellation'] : '');

        return $this->getFullNameAttribute() . ' (' . ucwords($apellation) . ')';
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function ministries()
    {
        return $this->belongsToMany(Ministry::class, 'member_ministries')->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function income_service_member_fund_total()
    {
        return $this->hasMany(IncomeServiceMemberFundTotal::class);
    }
}
