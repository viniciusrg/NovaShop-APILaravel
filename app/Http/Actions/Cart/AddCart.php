<?php

namespace App\Http\Actions\Cart;

use App\Models\Cart;

class AddCart
{
    public function execute()
    {
            $cart = new Cart();
            $cart->create();
//            $cart->save();
            return $cart;
    }
}
