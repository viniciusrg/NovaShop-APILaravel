<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CartItem extends Model
{
    use HasFactory;
    use HasTimestamps;

    /**
     * @var array
     */
    protected $fillable = [
        'cart_id',
        'sku',
        'quantity',
        'name',
        'price',
        ];

    /**
     * @return BelongsTo
     */

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }
}
