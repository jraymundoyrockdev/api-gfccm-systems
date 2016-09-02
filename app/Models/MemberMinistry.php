<?php

namespace ApiGfccm\Models;

use Illuminate\Database\Eloquent\Model;

class MemberMinistry extends Model
{
    /**
     * @var string
     */
    protected $table = 'member_ministries';

    /**
     * @var array
     */
    protected $fillable = [
        'member_id',
        'ministry_id'
    ];
}
