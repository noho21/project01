<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Log;
use App\Models\Company;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ProductCreateRequest;
use Illuminate\Pagination\Paginator;


class ProductController extends Controller
{
    /* 一覧ページ */
    public function index(Request $request) {
        $companies = Company::all();
        $product_name = $request->input('product_name', '');
        $company_id = $request->input('company_id', '');
        $query = Product::with('company');

        if(!empty($product_name)) {
            $query->where('product_name', 'like', '%' . $product_name . '%');
        }

        if(!empty($company_id)) {
            $query->where('company_id', $company_id);
        }

        $products = $query->paginate(5);

        return view ('product.index', compact('products', 'companies'));
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
            Log::debug('[ProductController][create] Request data: ', $request->all());

            $validated = $request->validated();
            $company_id = $request->input("company_id");

            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $img_path = uniqid() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('public/images', $img_path); 
            } else {
                $validated['img_path'] = "";
            }
            
            $validated['company_id'] = $company_id;

            Log::debug('[ProductController][create] Input data for Product creation: ', $validated);

            Product::create($validated);

            DB::commit();

            return redirect()->route('product.index') -> with('success', '商品が正常に登録されました。');
        }catch(\Exception $e){
            DB::rollBack();
            Log::error('商品作成エラー:' . $e->getMessage());
            return redirect()->back()->with('error', '商品の生成中にエラーが起きました。');
        }
    }

    /* メーカー情報登録画面 */
    public function showCompanyForm() {
        return view('company.create');
    }

    /* メーカー情報登録処理 */
    public function storeCompany(Request $request) {
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'street_address' => 'required|string|max:255',
            'representative_name' => 'required|string|max:255',
        ]);

        Company::create($validated);

        return redirect()->route('company.create')->with('success', 'メーカー情報が登録されました。');
    }

    /* 詳細ページ */
    public function show(Request $request, $id) {
        Log::debug('[ProductController][show]');
        $product = Product::findOrFail($id);

        return view('product.show', [
            'product' => $product,
            'product_id' => $id,
        ]);
    }

    /* 編集ページ */
    public function edit(Request $request, $id) {
        Log::debug('[ProductController][update] Request received: ', $request->all());
        Log::debug('[ProductController][edit]');
        Log::debug("[ProductController][edit] path => {$id}");
        $product = Product::find($id);
        $companies = Company::all();
     
        return view('product.edit_product', compact('product', 'companies'));
    }

    /* 編集処理 */ 
    public function update(ProductCreateRequest $request,  $id) {
        DB::beginTransaction();
        try{
            Log::debug('[ProductController][update]');

            $validated = $request->validated();
            $company_id = $request->input("company_id");

            $product = Product::find($id);

            if (!$product) {
                throw new \Exception("商品が見つかりません: ID " . $id);
            }

            $product->fill($validated);
            $product->company_id = $company_id;

            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $img_path = uniqid() . '_' . $file->getClientOriginalName();
                $file->storeAs('public/images', $img_path);
                $product->img_path = $img_path;
            } else {
                $product->img_path = $product->getOriginal('img_path');
            }

            $product->save();

            DB::commit();
            return redirect()->route('product.index') -> with('success', '商品が更新されました。');
        } catch(\Exception $e){
            DB::rollback();
            return redirect()->back()->with('error', '商品の更新中にエラーが発生しました。');
        }
    }

    /* 削除処理 */
    public function delete(Request $request){
        $id = $request->input('id');
        Log::debug('[ProductController][delete]');
        Log::debug('[ProductController][delete]input => ', [$id]);
    
        $validated = $request->validate([
            'id' => 'required|integer|exists:products,id',
        ]);

        $product = Product::find($validated['id']);
        if (!$product) {
            Log::error('商品が見つかりませんでした: ID ' . $id);
            return redirect()->route('product.index')->with('error', '商品が見つかりませんでした');
        }
    
        $product->delete();
        Log::debug('商品が削除されました: ID ' . $id);
        return redirect()->route('product.index')->with('success', '商品が削除されました');
    }

    /* ファイル処理 */
    public function getfile(Request $request, $id) {
        $product = Product::find($id);
        
        if ($product && $product->img_path) {
            $storedImg_path = 'public/images/' . $product->img_path;

            if (Storage::exists($storedImg_path)) {
                $mimeType = Storage::mimeType($storedImg_path);

                return Storage::download($storedImg_path, $product->img_path, ['Content-Type' => $mimeType]);
            }
        }

        return abort(404, 'ファイルが見つかりません。');
    }
}
