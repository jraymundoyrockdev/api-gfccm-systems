<?php

namespace ApiGfccm\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $table = 'members';

    protected $fillable = [
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
        return $this->belongsTo(User::class);
    }

}
