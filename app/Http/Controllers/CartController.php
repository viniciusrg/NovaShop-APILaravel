<?php

namespace App\Http\Controllers;

use App\Http\Actions\Cart\AddCart;
use App\Http\Actions\Cart\Checkout;
use App\Http\Actions\Cart\RemoveCart;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\Request;
use App\Http\Actions\Cart\GetCarts;

class CartController extends Controller
{
    public function index()
    {
        try {
            $getCarts = new GetCarts();
            return $getCarts->execute();
        }
        catch(\Exception $exception){
            return response()->json(['Erro ao receber os dados.'], 500);
        }
    }

    public function addCart()
    {
        try {
            $addCart = new AddCart();
            $addCart->execute();
            return response()->json(['Carrinho criado'], 201);
        }
        catch(\Exception $exception){
            return response()->json(['Erro ao criar o carrinho.'], 500);
        }
    }

    public function removeCart($cartId)
    {
        try {
            $removeCart = new RemoveCart();
            return $removeCart->execute($cartId);
        }
        catch(\Exception $exception){
//            dd($exception);
            return response()->json(['Erro ao remover o carrinho.'], 500);
        }
    }

    public function checkout($id)
    {
        try {
            $checkout = new Checkout();
            return $checkout->execute($id);
        }
        catch(\Exception $exception){
//            dd($exception);
            return response()->json(['Erro ao finalizar o carrinho.'], 500);
        }
    }
}
