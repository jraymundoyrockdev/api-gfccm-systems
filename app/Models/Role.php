<?php

namespace ApiGfccm\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'user_roles';

    protected $fillable = [
        'name',
        'description'
    ];
}
