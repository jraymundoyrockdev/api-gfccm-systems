<?php

namespace ApiGfccm\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'services';

    protected $fillable = [
        'name',
        'start_time',
        'end_time',
        'description'
    ];
}
