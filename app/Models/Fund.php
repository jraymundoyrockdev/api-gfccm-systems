<?php

namespace ApiGfccm\Models;

use Illuminate\Database\Eloquent\Model;

class Fund extends Model
{
    /**
     * @var string
     */
    protected $table = 'funds';

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'category',
        'status'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items()
    {
        return $this->hasMany(FundItem::class);
    }
}
