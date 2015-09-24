<?php

namespace ApiGfccm\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $table = 'members';

    protected $fillable = [
        'ministry_id',
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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('ApiGfccm\Models\User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ministry()
    {
        return $this->hasOne('ApiGfccm\Models\Ministry','id','ministry_id');
    }

}
