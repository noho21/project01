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
        // バリデーション追加
        $request->validate([
            'id' => 'required|integer|exists:products,id',
        ]);

        $product = Product::find($request->id);

        if ($product->stock < 1) {
            return response()->json(['message' => '在庫不足です'], 400);
        }

        DB::beginTransaction();
        try {
            // 在庫を減らす
            $product->decrement('stock');

            // 購入履歴を登録
            Sale::create([
                'product_id' => $product->id,
                'quantity' => 1
            ]);

            DB::commit();
            return response()->json([
                'message' => '購入完了'
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => '購入処理中にエラーが発生しました'], 500);
        }
    }
}
