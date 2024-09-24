<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Log;
use App\Models\Company;
use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{
    /* 一覧ページ */
    public function index(Request $request) {
        $companies = Company::all();
        $products = Product::all();
        return view ('product.index', [
            'products' => $products,
            'companies' => $companies,
        ]);
    }

    /* 新規作成ページ */
    public function new(Request $request) {
        $companies = Company::all();
        return view('product.new',[
            'companies' => $companies,
        ]);
    }

    /* 新規追加処理 */
    public function create(Request $request) {
        Log::debug('[ProductController][create]');
        $product_name = $request -> input("product_name");
        $price = $request -> input("price");
        $stock = $request -> input("stock");
        $comment = $request -> input("comment");
        $company_id = $request -> input("company_id");
        $uploadedfile = $request -> file('file');
        $filename = $uploadedfile -> getClientOriginalName();
        
        if($uploadedfile) {
            $filename = $uploadedfile -> getClientOriginalName();
        } else {
            $filename = "";
        }

        Log::debug('[ProductController][create]input => ', [$product_name, $price, $stock, $comment, $filename]);
        $product = Product::create([ 
            "product_name" => $product_name,
            "price" => $price,
            "stock" => $stock,
            "comment" => $comment,
            "company_id" => $company_id,
            "filename" => $filename,
        ]);

        if($uploadedfile){
            $uploadedfile -> storeAs('', $product -> id);
        }
        return redirect() -> Route('product.new');
    }

    /* 詳細ページ */
    public function show(Request $request, $id) {
        Log::debug('[ProductController][show]');
        Log::debug('[ProductController][show] path => {$id}');
        $product = Product::find($id);
        return view('product.show', ['product' => $product]);
    }

    /* 編集ページ */
    public function edit(Request $request, $id) {
        $companies = Company::all();
        Log::debug('[ProductController][edit]');
        Log::debug('[ProductController][edit] path => {$id}');
        $product = Product::find($id);
        return view('product.edit', [
            'product' => $product,
            'companies' => $companies,
        ]);
    }

    /* 編集処理 */ 
    public function update(Request $request) {
        Log::debug('[ProductController][update]');
        $id = $request -> input("id");
        $product_name = $request ->input("product_name");
        $price = $request -> input("price");
        $stock = $request -> input("stock");
        $comment = $request -> input("commnet");
        $company_id = $request -> input("company_id");
        $uploadedfile = $request -> file('file');
        $filename = $uploadedfile -> getClientOriginalName();

        Log::debug('[ProductController][update] input => [$id, $product_name, $price, $stock, $commnet]');
        $product = Product::find($id);
        $product -> product_name = $product_name;
        $product -> price = $price;
        $product -> stock = $stock;
        $product -> comment = $comment;
        $product -> company_id = $company_id;
        $product -> filename = $filename;
        if($uploadedfile){
            $uploadedfile -> storeAs('', $product -> id);
        }
        $product -> save();
        return redirect() -> route('product.edit', ['id' => $id]);
    }

    /* 削除処理 */
    public function delete(Request $request) {
        Log::debug('[ProductController][delete]');
        $id = $request -> input('id');
        Log::debug('[ProductController][delete]input => ', [$id]);
        $product = Product::find($id);
        $product -> delete();
        return redirect() -> route("product.index");
    }

    /* ファイル処理 */
    public function getfile(Request $request, $id) {
        $product = Product::find($id);
        $storedfilename = Storage::path('product/', $product -> id);
        $filename = $product -> name;
        $mimeType = Storage::mimeType($storedfilename);
        $headers = ['Content-Type' => $mimeType];
        return Storage::response($storedfilename, $filename, $headers);
    }
}
