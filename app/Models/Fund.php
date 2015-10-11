<?php

namespace ApiGfccm\Models;

use Illuminate\Database\Eloquent\Model;

class Fund extends Model
{
    protected $table = 'funds';

    protected $fillable = [
        'name',
        'description',
        'category'
    ];

}
