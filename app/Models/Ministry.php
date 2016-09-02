<?php

namespace ApiGfccm\Models;

use Illuminate\Database\Eloquent\Model;

class Ministry extends Model
{
    /**
     * @var string
     */
    protected $table = 'ministries';

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'description'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function members()
    {
        return $this->belongsToMany(Member::class);
    }
}
