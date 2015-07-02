<?php

namespace ApiGfccm\Models;

use Illuminate\Database\Eloquent\Model;

class Ministry extends Model
{
    protected $table = 'ministry';

    protected $fillable = [
        'name',
        'description'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('ApiGfccm\Models\User');
    }
}
