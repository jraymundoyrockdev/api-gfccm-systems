<?php

namespace ApiGfccm\Models;

use Illuminate\Database\Eloquent\Model;

class RoleModule extends Model
{
    protected $table = 'role_modules';

    protected $fillable = [
        'role_id',
        'module_id'
    ];
}
