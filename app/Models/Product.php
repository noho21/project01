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
        "img_path",
    ];

    public function company() {
        return $this -> belongsTo(Company::class, 'company_id', 'id');
    }

    /* 新規追加処理 */
    public static function createProduct($product_name, $price, $stock, $comment, $company_id, $img_path){
        return self::create([
            "product_name" => $product_name,
            "price" => $price,
            "stock" => $stock,
            "comment" => $comment,
            "company_id" => $company_id,
            "img_path" => $img_path,
        ]);
    }

    /* 編集処理 */
    public static function updatedProduct($id, $product_name, $price, $stock, $comment, $company_id, $img_path){
        $product = self::find($id);
        if ($product) {
            $product -> update([
                "id" => $id,
                "product_name" => $product_name,
                "price" => $price,
                "stock" => $stock,
                "comment" => $comment,
                "company_id" => $company_id,
                "img_path" => $img_path,
            ]);
        }
        return $product;   
    }

    /* 削除処理 */
    public static function deleteProduct($id){
        return self::where('id', $id) -> delete();
    }
}

