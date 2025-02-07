@extends('product.header')

@vite('resources/css/app.css')

@section('title', '登録')

@section('content')
    <div class="p-4 w-full max-w-2xl mx-auto">
        <h3 class="text-2xl font-bold text-center mb-6">商品新規登録画面</h3>
        
        <form class="border-4 p-6 w-full" action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <!-- 商品名 -->
            <div class="flex flex-col md:flex-row items-center mb-4">
                <label class="font-bold w-28 md:w-40 text-right pr-4" for="product_name">商品名<span class="text-red-600">*</span></label>
                <input class="border rounded-md p-2 flex-1" type="text" name="product_name">
            </div>
            @error ('product_name')
                <div class="text-red-600 text-sm text-center md:text-left">{{ $message }}</div>
            @enderror

            <!-- メーカー名 -->
            <div class="flex flex-col md:flex-row items-center mb-4">
                <label class="font-bold w-28 md:w-40 text-right pr-4" for="company_id">メーカー名<span class="text-red-600">*</span></label>
                <select class="border rounded-md p-2 flex-1" name="company_id">
                    @foreach ($companies as $company)
                        <option value="{{ $company->id }}" @selected(request('company_id') == $company->id)>
                            {{ $company->company_name }}
                        </option>
                    @endforeach
                </select>
            </div>
            @error ('company_id')
                <div class="text-red-600 text-sm text-center md:text-left">{{ $message }}</div>
            @enderror

            <!-- 価格 -->
            <div class="flex flex-col md:flex-row items-center mb-4">
                <label class="font-bold w-28 md:w-40 text-right pr-4" for="price">価格<span class="text-red-600">*</span></label>
                <input class="border rounded-md p-2 flex-1" type="text" name="price">
            </div>
            @error ('price')
                <div class="text-red-600 text-sm text-center md:text-left">{{ $message }}</div>
            @enderror

            <!-- 在庫数 -->
            <div class="flex flex-col md:flex-row items-center mb-4">
                <label class="font-bold w-28 md:w-40 text-right pr-4" for="stock">在庫数<span class="text-red-600">*</span></label>
                <input class="border rounded-md p-2 flex-1" type="text" name="stock">
            </div>
            @error ('stock')
                <div class="text-red-600 text-sm text-center md:text-left">{{ $message }}</div>
            @enderror

            <!-- コメント -->
            <div class="flex flex-col md:flex-row items-center mb-4">
                <label class="font-bold w-28 md:w-40 text-right pr-4" for="comment">コメント</label>
                <textarea class="border rounded-md p-2 flex-1 min-h-[80px]" name="comment"></textarea>
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
                <button class="bg-orange-500 text-white py-2 px-6 rounded-md w-full sm:w-auto" type="submit">新規登録</button>
                <a class="bg-gray-500 text-white py-2 px-6 rounded-md text-center w-full sm:w-auto" href="{{ route('product.index') }}">戻る</a>
            </div>
        </form>
    </div>
@endsection
