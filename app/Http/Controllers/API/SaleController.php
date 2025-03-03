<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    public function store(Request $request)
    {
        $product = Product::find($request->id);

        if (!$product) {
            return response()->json(['message' => '商品が見つかりません'], 404);
        }

        if ($product->stock < 1) {
            return response()->json(['message' => '在庫不足です'], 400);
        }

        DB::beginTransaction();
        try {
            // 在庫を減らす
            $product->stock -= 1;
            $product->save();

            // 購入履歴を登録
            Sale::create([
                'product_id' => $product->id,
                'quantity' => 1,
                'sale_at' => now()
            ]);

            DB::commit();
            return response()->json([
                'message' => '購入完了',
                'product' => $product
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => '購入処理中にエラーが発生しました'], 500);
        }
    }
}
