<?php

namespace App\Http\Controllers;

use App\Http\Actions\CartItem\AddCartItem;
use App\Http\Actions\CartItem\GetCardItem;
use App\Http\Actions\CartItem\RemoveCardItem;
use Illuminate\Http\Request;

class CartItemController extends Controller
{
    public function index($id)
    {
        try {
            $getItem = new GetCardItem();
            return $getItem->execute($id);
        }
        catch(\Exception $exception){
//            dd($exception);
            return response()->json(['Erro ao receber os dados.'], 500);
        }
    }

    public function addCartItem(Request $request)
    {
        try {
            $addCartItem = new AddCartItem();
            return $addCartItem->execute($request);

        }
        catch(\Exception $exception){
            return response()->json(['Erro ao inserir item no carrinho.'], 500);
        }
    }

    public function removeItem($cartId, $sku)
    {
        try{
            $removeCardItem = new RemoveCardItem();
            return $removeCardItem->execute($cartId, $sku);
        }
        catch(\Exception $exception){
//            dd($exception);
            return response()->json(['Erro ao inserir item no carrinho.'], 500);
    }
    }
}
