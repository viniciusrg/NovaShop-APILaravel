<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cart extends Model
{
    use HasFactory;
    use HasTimestamps;

    /**
     * @var array
     */

    protected $fillable = [
        'total_price',
    ];

    /**
     * @return HasMany
     */
    public function items()
    {
        return $this->hasMany(CartItem::class);
    }
}
