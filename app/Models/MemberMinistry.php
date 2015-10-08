<?php

namespace ApiGfccm\Models;

use Illuminate\Database\Eloquent\Model;

class MemberMinistry extends Model
{
    protected $table = 'member_ministries';

    protected $fillable = [
        'member_id',
        'ministry_id'
    ];
}
