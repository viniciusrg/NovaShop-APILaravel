<?php

namespace App\Http\Actions\CartItem;

use App\Models\CartItem;

class RemoveCardItem
{
    public function execute ($cartId, $sku)
    {
            if (isset($cartId) && isset($sku) && is_numeric($cartId)){
                $itemCart = CartItem::where('cart_id', $cartId)->where('sku', $sku)->first();
                if ($itemCart) {
                    $itemCart->delete();
                    return response()->json(['Item removido do carrinho.'], 200);
                } else {
                    return response()->json(['Item ou ID inválidos.'], 404);
                }
            } else {
                return response()->json(['Carrinho ou sku não encontrado.'], 404);
            }
        }
}
