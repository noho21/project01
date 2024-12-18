<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'product_name' => 'required|string|max:10',
            'price' => 'required|integer|min:0',
            'stock' => 'required|integer|min:0',
            'comment' => 'required|string|max:30',
            'img_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'product_name.required' => '商品名を入力して下さい',
            'product_name.max' => '商品名は10文字以内で入力して下さい',
            'price.required' => '価格を入力して下さい',
            'price.integer' => '数字で入力して下さい',
            'price.min' => '価格は0以上で入力してください。',
            'stock.required' => '在庫数を入力して下さい',
            'stock.integer' => '数字で入力して下さい',
            'stock.min' => '在庫数は0以上で入力してください。',
            'comment.required' => 'コメントを入力して下さい',
            'comment.max' => 'コメントは30文字以内で入力して下さい',
            'img_path.image' => '画像ファイルをアップロードしてください。',
            'img_path.mimes' => 'アップロードできるファイル形式は jpeg, png, jpg, gif のみです。',
            'img_path.max' => '画像ファイルの最大サイズは2MBです。',
        ];
    }
}
