<?php

namespace ApiGfccm\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Fund
 * @package ApiGfccm\Models
 */
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
        'category'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function item()
    {
        return $this->hasMany(FundItem::class);
    }
}
