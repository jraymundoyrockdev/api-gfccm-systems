<?php

namespace ApiGfccm\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    /**
     * @var string
     */
    protected $table = 'services';

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'start_time',
        'end_time',
        'description'
    ];
}
