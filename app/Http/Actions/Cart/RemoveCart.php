<?php

namespace App\Http\Actions\Cart;

use App\Models\Cart;
use App\Models\CartItem;

class RemoveCart
{
    public function execute ($cartId)
    {
            if (isset($cartId) && is_numeric($cartId)) {
                $cart = Cart::where('id', $cartId)->first();
                if ($cart){
//                    dd($cart);
                    CartItem::where('cart_id', $cartId)->delete();
                    $cart->delete();
                    return response()->json(['Carrinho removido com sucesso.'], 200);
                } else {
                    return response()->json(['Carrinho inválido.'], 404);
                }

            } else {
                return response()->json(['Carrinho inválido.'], 404);
            }
        }
}
