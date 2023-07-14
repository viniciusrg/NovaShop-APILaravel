<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        try {
            $product = Product::all();
            return response([$product], 200);
        }
        catch(\Exception $exception){
//            dd($exception);
            return response()->json(['Erro ao remover o carrinho.'], 500);
        }
    }
}
