<?php

namespace App\Http\Actions\CartItem;

use App\Models\CartItem;

class GetCardItem
{
    public function execute ($id)
    {
            if ($id && is_numeric($id)){
                $cartItem = CartItem::where('cart_id', $id)->get();
                return response()->json([$cartItem], 200);
            }
            return response()->json(['Id inválido.'], 404);
    }
}
