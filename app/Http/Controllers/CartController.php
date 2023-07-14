<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        try {
            $cart = Cart::all();
            return response()->json([$cart], 200);
        }
        catch(\Exception $exception){
            return response()->json(['Erro ao receber os dados.'], 500);
        }
    }

    public function addCart()
    {
        try {
            $cart = new Cart();
            $cart->create();
            $cart->save();
            return response()->json([$cart], 201);
        }
        catch(\Exception $exception){
            return response()->json(['Erro ao criar o carrinho.'], 500);
        }
    }

    public function removeCart($cartId)
    {
        try {
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
        catch(\Exception $exception){
//            dd($exception);
            return response()->json(['Erro ao remover o carrinho.'], 500);
        }
    }

    public function checkout($id)
    {
        try {
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
        catch(\Exception $exception){
//            dd($exception);
            return response()->json(['Erro ao finalizar o carrinho.'], 500);
        }
    }
}
