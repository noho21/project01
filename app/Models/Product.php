<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Company;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        "product_name",
        "company_id",
        "price",
        "stock",
        "comment",
        "filename",
    ];

    public function company() {
        return $this -> belongsTo(Company::class);
    }

    /* 新規追加処理 */
    public static function createProduct($product_name, $price, $stock, $comment, $company_id, $filename){
        return self::create([
            "product_name" => $product_name,
            "price" => $price,
            "stock" => $stock,
            "comment" => $comment,
            "company_id" => $company_id,
            "filename" => $filename,
        ]);
    }

    /* 編集処理 */
    public static function updatedProduct($id, $product_name, $price, $stock, $comment, $company_id, $filename){
        $product = self::find($id);
        if ($product) {
            $product -> update([
                "id" => $id,
                "product_name" => $product_name,
                "price" => $price,
                "stock" => $stock,
                "comment" => $comment,
                "company_id" => $company_id,
                "filename" => $filename,
            ]);
        }
        return $product;   
    }

    /* 削除処理 */
    public static function deleteProduct($id){
        return self::where('id', $id) -> delete();
    }
}

