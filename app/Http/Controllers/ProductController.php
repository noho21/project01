<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Log;
use App\Models\Company;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ProductCreateRequest;


class ProductController extends Controller
{
    /* 一覧ページ */
    public function index(Request $request) {
        $companies = Company::all();
        $product_name = $request -> input('product_name', '');
        $company_id = $request -> input('company_id', '');

        $products = Product::with('company')
        -> where('product_name', 'like', '%' . $product_name . '%')
        -> where('company_id', '=', $company_id)
        -> paginate(2);

        return view ('product.index', [
            'products' => $products,
            'companies' => $companies,
        ]);
    }

    /* 新規作成ページ */
    public function new(Request $request) {
        $companies = Company::all();
        return view('product.new', compact('companies'));
    }

    /* 新規追加処理 */
    public function create(ProductCreateRequest $request) {
        DB::beginTransaction();
        try{
            Log::debug('[ProductController][create]');

            $validated = $request->validated();
            $product_name = $validated['product_name'];
            $price = $validated['price'];
            $stock = $validated['stock'];
            $comment = $validated['comment'];
            $company_id = $request -> input("company_id");

            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $filename = $file->getClientOriginalName();
                $path = $file->storeAs('public/images', $filename); 
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

            DB::commit();
        }catch(\Exception $e){
            DB::rollBack();
            return redirect() -> back() -> with('error', '商品の生成中にエラーが起きました。');
        }
        return redirect() -> route('product.new');
    }

    /* メーカー情報画面表示 */
    public function showCreateForm() {
        $companies = Company::all();
        return view('product.create', compact('companies'));
    }

    /* メーカー情報登録画面 */
    public function showCompanyForm() {
        return view('companies.create');
    }

    /* メーカー情報登録処理 */
    public function storeCompany(Request $request) {
        $validated = $request -> validate([
            'company_name' => 'required|string|max:255',
            'street_address' => 'required|string|max:255',
            'representative_name' => 'required|string|max:255',
        ]);

        Company::create($validated);

        return redirect() -> route('company.create') -> with('success', 'メーカー情報が登録されました。');
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
    public function update(ProductCreateRequest $request) {
        DB::beginTransaction();
        try{
            Log::debug('[ProductController][update]');
            $id = $request -> input("id");
            $product_name = $request ->input("product_name");
            $price = $request -> input("price");
            $stock = $request -> input("stock");
            $comment = $request -> input("comment");
            $company_id = $request -> input("company_id");
            $uploadedfile = $request -> file('file');
            $filename = $uploadedfile ? $uploadedfile->getClientOriginalName() : null;

            $validated = $request->validated();
            $product_name = $validated['product_name'];
            $price = $validated['price'];
            $stock = $validated['stock'];
            $comment = $validated['comment'];
           
            Log::debug('[ProductController][update] input => [$id, $product_name, $price, $stock, $comment]');
            Product::updateProduct($id, $product_name, $price, $stock, $comment, $company_id, $filename);

            if ($uploadedfile) {
                $uploadedfile -> storeAs('', $id);
            }

            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
            return redirect()->back()->with('error','商品の更新中にエラーが発生しました。');
        }
        return redirect() -> route('product.edit', ['id' => $id]);
    }

    /* 削除処理 */
    public function delete(Request $request) {
        DB::beginTransaction();
        try{
            Log::debug('[ProductController][delete]');
            $id = $request -> input('id');
            Log::debug('[ProductController][delete]input => ', [$id]);
            Product::deleteProduct($id);
            $product = Product::find($id);
            $product -> delete();
            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
            return redirect()->back()->with('error','商品の更新中にエラーが発生しました。');
        }
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
