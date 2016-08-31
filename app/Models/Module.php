<?php

namespace ApiGfccm\Models;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    /**
     * @var string
     */
    protected $table = 'modules';

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'description'
    ];
}
