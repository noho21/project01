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
            'product_name' => 'required|max:10',
            'price' => 'required|integer',
            'stock' => 'required|integer',
            'comment' => 'required|max:30',
        ];
    }

    public function messages()
    {
        return [
            'product_name.required' => '商品名を入力して下さい',
            'product_name.max' => '商品名は10文字以内で入力して下さい',
            'price.required' => '価格を入力して下さい',
            'price.integer' => '数字で入力して下さい',
            'stock.required' => '在庫数を入力して下さい',
            'stock.integer' => '数字で入力して下さい',
            'comment.required' => 'コメントを入力して下さい',
            'comment.max' => 'コメントは30文字以内で入力して下さい',
        ];
    }
}
