<?php

namespace App\Http\Actions\Cart;

use App\Models\Cart;
use Illuminate\Http\Request;

class GetCarts
{
    public function execute ()
    {
            $cart = Cart::all();
            return response()->json([$cart], 200);
    }
}
