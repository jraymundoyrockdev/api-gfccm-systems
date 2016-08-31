<?php

namespace ApiGfccm\Models;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    /**
     * @var string
     */
    protected $table = 'user_roles';

    /**
     * @var array
     */
    protected $fillable = [
        'user_id',
        'role_id'
    ];
}
