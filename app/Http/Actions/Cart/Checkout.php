<?php

namespace App\Http\Actions\Cart;

use App\Models\Cart;
use App\Models\CartItem;

class Checkout
{
    public function execute ($id)
    {
            if (isset($id) && is_numeric($id)){
                $cart = Cart::where('id', $id)->first();
                if (!$cart){
                    return response()->json(['Carinho não encontrado.'], 404);
                }
                $cartItems = CartItem::where('cart_id', $id)->get();

                // Fazer o calculo do total_price
                $priceCalc = 0;
                foreach ($cartItems as $cartItem){
                    $priceCalc += $cartItem['quantity'] * $cartItem['price'];
                }

                //Alterar o status do cart para finalizado.
                $cart->status = 'finished';
                $cart->total_price = $priceCalc;
                $cart->save();
                return response()->json(['Carinho finalizado.'], 200);
            } else {
                return response()->json(['Carinho não encontrado.'], 404);
            }
        }
}
