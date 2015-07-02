<?php

namespace ApiGfccm\Models;

use Illuminate\Database\Eloquent\Model;

class Denomination extends Model
{
    protected $table = 'denominations';

    protected $fillable = [
        'amount',
        'description'
    ];

}
