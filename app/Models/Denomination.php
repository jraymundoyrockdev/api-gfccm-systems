<?php

namespace ApiGfccm\Models;

use Illuminate\Database\Eloquent\Model;

class Denomination extends Model
{
    /**
     * @var string
     */
    protected $table = 'denominations';

    /**
     * @var array
     */
    protected $fillable = [
        'amount',
        'description',
        'status'
    ];

}
