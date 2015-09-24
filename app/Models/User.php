<?php

namespace ApiGfccm\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'password',
        'ministry_id',
        'member_id',
        'role_id',
        'status'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password'];


    /**
     * A User has one main ministry
     */
    public function ministry()
    {
        return $this->hasOne('ApiGfccm\Models\Ministry', 'id', 'ministry_id');
    }

    /**
     * A User is always a member
     */
    public function member()
    {
        return $this->hasOne('ApiGfccm\Models\Member', 'id', 'member_id');
    }

    /**
     * A User has one role
     */
    public function role()
    {
        return $this->hasOne('ApiGfccm\Models\UserRole', 'id', 'role_id');
    }
}
