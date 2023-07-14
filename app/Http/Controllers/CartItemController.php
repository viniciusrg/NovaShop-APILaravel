<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use function PHPUnit\Framework\isEmpty;

class CartItemController extends Controller
{
    public function index($id)
    {
        try {
            if ($id && is_numeric($id)){
                $cartItem = CartItem::where('cart_id', $id)->get();
                return response()->json([$cartItem], 200);
            }
            return response()->json(['Id inválido.'], 404);
        }
        catch(\Exception $exception){
//            dd($exception);
            return response()->json(['Erro ao receber os dados.'], 500);
        }
    }

    public function addCartItem(Request $request)
    {
        try {
            $cartItem = new CartItem();
            $id = $request->query('id');
            $sku = $request->query('sku');
            $products = Product::where('sku', $sku)->get();
            if (!$products)
                return response()->json(['Erro produto inexistente.'], 404);
            $price = $products->value('price');
            $name = $products->value('name');

            $items = [
                'cart_id' => $id,
                'sku' => $sku,
                'quantity' => $request->query('qnt'),
                'name' => $name,
                'price' => $price,
            ];

            // Verificar se o carrinho é válido, se é number e se não for existente, criar novo cart
            if (isset($id) && is_numeric($id) && $sku){
                $cartItemId = Cart::find($id);
//                dd($cartItemId);
                if ($cartItemId){
                    // Verifica se o carrinho já foi finalizado.
                    if ($cartItemId->status === 'finished') {
                        return response()->json(['Carrinho já foi finalizado.'], 403);
                    }
                    $findItems =$cartItemId->items()->where('sku', $sku)->get();
                    if ($findItems && sizeof($findItems) > 0){
                        $findItems->first()->update(['quantity' => $items['quantity']]);
                        return response()->json(['Carrinho atualizado com sucesso.'], 200);
                    }
//                    dd();
                    $cartItem->create($items);
                    return response()->json(['Item adicionado com sucesso.'], 200);
                }
            }

            // Caso de não ter cart existente.
            $newCart = new Cart();
            $newCart->create();
            $items['cart_id'] = $newCart->latest()->value('id');
            $cartItem->create($items);
            return response()->json(['Carrinho criado.'], 201);

        }
        catch(\Exception $exception){
//            dd($exception);
            return response()->json(['Erro ao inserir item no carrinho.'], 500);
        }
    }

    public function removeItem($cartId, $sku)
    {
        try{
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
        catch(\Exception $exception){
//            dd($exception);
            return response()->json(['Erro ao inserir item no carrinho.'], 500);
    }
    }
}
