@extends('product.header')

@vite('resources/css/app.css')

@section('title', '詳細')

@section('content')
    <div class="w-full max-w-2xl mx-auto mt-4 px-4">
        <h3 class="text-2xl text-center">商品情報詳細画面</h3>
        
        <div class="overflow-x-auto">
            <table class="text-lg border-4 w-full text-left mt-4">
                <tbody>
                    <tr>
                        <th class="py-3 px-4 bg-gray-200 w-1/3">ID</th>
                        <td class="py-3 px-4">{{ $product->id }}</td>
                    </tr>
                    <tr>
                        <th class="py-3 px-4 bg-gray-200">商品名</th>
                        <td class="py-3 px-4">{{ $product->product_name }}</td>
                    </tr>
                    <tr>
                        <th class="py-3 px-4 bg-gray-200">商品画像</th>
                        <td class="py-3 px-4">
                        <img class="border-4 rounded w-40 h-40 md:w-60 md:h-60 object-cover" 
                            src="{{ asset($product->img_path) }}" 
                            alt="商品画像">

                        </td>
                    </tr>
                    <tr>
                        <th class="py-3 px-4 bg-gray-200">メーカー名</th>
                        <td class="py-3 px-4">{{ $product->company->company_name }}</td>
                    </tr>
                    <tr>
                        <th class="py-3 px-4 bg-gray-200">価格</th>
                        <td class="py-3 px-4">{{ $product->price }}</td>
                    </tr>
                    <tr>
                        <th class="py-3 px-4 bg-gray-200">在庫数</th>
                        <td class="py-3 px-4">{{ $product->stock }}</td>
                    </tr>
                    <tr>
                        <th class="py-3 px-4 bg-gray-200">コメント</th>
                        <td class="py-3 px-4 rounded-md max-w-xs break-words border border-gray-300">
                            {{ $product->comment }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="flex flex-wrap justify-center gap-4 mt-6">
            <a class="bg-orange-400 text-white py-3 px-5 rounded-md text-center w-full sm:w-auto" 
               href="{{ route('product.edit', ['id'=>$product->id]) }}">
                編集
            </a>
            <a class="bg-blue-500 text-white py-3 px-5 rounded-md text-center w-full sm:w-auto" 
               href="{{ route('product.index') }}">
                戻る
            </a>
        </div>
    </div>
@endsection
