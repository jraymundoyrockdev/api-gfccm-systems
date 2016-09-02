<?php

namespace ApiGfccm\Models;

use Illuminate\Database\Eloquent\Model;

class RoleModule extends Model
{
    /**
     * @var string
     */
    protected $table = 'role_modules';

    /**
     * @var array
     */
    protected $fillable = [
        'role_id',
        'module_id'
    ];
}
