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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function member()
    {
        return $this->belongsTo(Member::class,'id','member_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function ministry()
    {
        return $this->hasOne(Ministry::class, 'id', 'ministry_id');
    }

}
