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
    // 一覧ページ表示
    public function index()
    {
        $products = Product::paginate(5);
        $companies = Company::all();
        return view('product.index', compact('products', 'companies'));
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
            $validated = $request->validated();
            $company_id = $request->input("company_id");

            if ($request->hasFile('img_path')) {
                $file = $request->file('img_path');
                $img_path = uniqid() . '_' . $file->getClientOriginalName();
                $file->storeAs('public/images', $img_path); 
                $validated['img_path'] = 'storage/images/' . $img_path;
            } else {
                $validated['img_path'] = null;
            }
            
            $validated['company_id'] = $company_id;

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
        $product = Product::findOrFail($id);

        return view('product.show', [
            'product' => $product,
            'product_id' => $id,
        ]);
    }

    /* 編集ページ */
    public function edit(Request $request, $id) {
        $product = Product::find($id);
        $companies = Company::all();
     
        return view('product.edit_product', compact('product', 'companies'));
    }

    /* 編集処理 */ 
    public function update(ProductCreateRequest $request,  $id) {
        DB::beginTransaction();
        try{
            $validated = $request->validated();
            $company_id = $request->input("company_id");

            $product = Product::find($id);

            if (!$product) {
                throw new \Exception("商品が見つかりません: ID " . $id);
            }

            $product->fill($validated);
            $product->company_id = $company_id;

            if ($request->hasFile('img_path')) {
                $file = $request->file('img_path');
                $img_path = uniqid() . '_' . $file->getClientOriginalName();
                $file->storeAs('public/images', $img_path);
                $product->img_path = 'storage/images/' . $img_path;
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
        $validated = $request->validate([
            'id' => 'required|integer|exists:products,id',
        ]);

        $product = Product::find($validated['id']);
        if (!$product) {
            Log::warning('商品が見つかりませんでした: ID ' . $id);
            return redirect()->route('product.index')->with('error', '商品が見つかりませんでした');
        }
    
        $product->delete();
        return redirect()->route('product.index')->with('success', '商品が削除されました');
    }

    /* 商品画像処理 */
    public function getfile(Request $request, $id) {
        $product = Product::find($id);
        
        if ($product && $product->img_path) {
            $storedImg_path = 'public/images/' . $product->img_path;

            if (Storage::exists($storedImg_path)) {
                $mimeType = Storage::mimeType($storedImg_path);

                return Storage::download($storedImg_path, $product->img_path, ['Content-Type' => $mimeType]);
            }
        }

        if (!$product || !$product->img_path || !Storage::exists($storedImg_path)) {
            return redirect()->route('product.index')->with('error', '商品画像が見つかりません。');
        }
    }
}
