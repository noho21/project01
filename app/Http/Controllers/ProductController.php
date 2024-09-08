<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Log;


class ProductController extends Controller
{
    /* 一覧ページ */
    public function index(Request $request){
        $products = Product::all();
        return view ('product.index',['products' => $products]);
    }

    /* 新規作成ページ */
    public function new(Request $request){
        return view('product.new',[
        ]);
    }

    /* 新規追加処理 */
    public function create(Request $request){
        Log::debug('[ProductController][create]');
        $product_name = $request -> input("product_name");
        $price = $request -> input("price");
        $stock = $request -> input("stock");
        $comment = $request -> input("comment");

        Log::debug('[ProductController][create]input => ',[$product_name,$price,$stock,$comment]);
        Product::create([
            "product_name" => $product_name,
            "price" => $price,
            "stock" => $stock,
            "comment" => $comment,
        ]);
        return redirect()->Route('product.new');
    }

    /* 詳細ページ */
    public function show(Request $request, $id){
        Log::debug('[ProductController][show]');
        Log::debug('[ProductController][show] path => {$id}');
        $product = Product::find($id);
        return view('product.show',['product' => $product]);
    }
}
