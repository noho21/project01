@extends('product.header')

@vite('resources/css/app.css')

@section('title', '編集')

@section('content')
    <div class="p-4 w-full max-w-2xl mx-auto">
        <h3 class="text-2xl font-bold text-center mb-6">商品情報編集画面</h3>
        
        <form class="border-4 p-6 w-full" action="{{ route('product.update', ['id' => $product->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <!-- ID -->
            <div class="flex flex-col md:flex-row items-center mb-4">
                <label class="font-bold w-28 md:w-40 text-right pr-4">ID</label>
                <div class="flex-1">{{ $product->id }}</div>
            </div>

            <!-- 商品名 -->
            <div class="flex flex-col md:flex-row items-center mb-4">
                <label class="font-bold w-28 md:w-40 text-right pr-4" for="product_name">商品名</label>
                <input class="border rounded-md p-2 flex-1" type="text" name="product_name" value="{{ old('product_name', $product->product_name) }}">
            </div>
            @error ('product_name')
                <div class="text-red-600 text-sm text-center md:text-left">{{ $message }}</div>
            @enderror
            
            <!-- メーカー名 -->
            <div class="flex flex-col md:flex-row items-center mb-4">
                <label class="font-bold w-28 md:w-40 text-right pr-4" for="company-id">メーカー名</label>
                <select class="border rounded-md p-2 flex-1" name="company_id">
                    @foreach ($companies as $company)
                        <option value="{{$company->id}}" @selected($product->company_id == $company->id)>
                            {{ $company->company_name }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <!-- 価格 -->
            <div class="flex flex-col md:flex-row items-center mb-4">
                <label class="font-bold w-28 md:w-40 text-right pr-4" for="price">価格</label>
                <input class="border rounded-md p-2 flex-1" type="text" name="price" value="{{ old('price', $product->price) }}">
            </div>
            @error ('price')
                <div class="text-red-600 text-sm text-center md:text-left">{{ $message }}</div>
            @enderror
            
            <!-- 在庫数 -->
            <div class="flex flex-col md:flex-row items-center mb-4">
                <label class="font-bold w-28 md:w-40 text-right pr-4" for="stock">在庫数</label>
                <input class="border rounded-md p-2 flex-1" type="text" name="stock" value="{{ old('stock', $product->stock) }}">
            </div>
            @error ('stock')
                <div class="text-red-600 text-sm text-center md:text-left">{{ $message }}</div>
            @enderror
            
            <!-- コメント -->
            <div class="flex flex-col md:flex-row items-center mb-4">
                <label class="font-bold w-28 md:w-40 text-right pr-4" for="comment">コメント</label>
                <textarea class="border rounded-md p-2 flex-1 min-h-[80px]" name="comment">{{ old('comment', $product->comment) }}</textarea>
            </div>
            @error ('comment')
                <div class="text-red-600 text-sm text-center md:text-left">{{ $message }}</div>
            @enderror
            
            <!-- 商品画像 -->
            <div class="flex flex-col md:flex-row items-center mb-4">
                <label class="font-bold w-28 md:w-40 text-right pr-4" for="img_path">商品画像</label>
                <input class="border rounded-md p-2" type="file" name="img_path">
            </div>
            @error ('img_path')
                <div class="text-red-600 text-sm text-center md:text-left">{{ $message }}</div>
            @enderror
            
            <!-- ボタン -->
            <div class="flex flex-wrap justify-center gap-4 mt-6">
                <button class="bg-blue-500 text-white py-2 px-6 rounded-md w-full sm:w-auto" type="submit">送信</button>
                <a class="bg-gray-500 text-white py-2 px-6 rounded-md text-center w-full sm:w-auto" href="{{ route('product.show', ['id' => $product->id]) }}">戻る</a>
            </div>
        </form>
    </div>
@endsection
