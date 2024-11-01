<!doctype html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>編集</title>
        @vite('resources/css/app.css')
    </head>
    <body>
        @extends('product.header')

        @section('content')
            <div class="p-4 w-2/5 mx-auto">
                <h3 class="text-2xl">商品情報編集画面</h3>
                <form class="border-4 text-xl w-full mt-4" action="{{ route('product.update', ['id' => $product -> id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                        <div class="py-4">
                            <label class="font-bold pl-24" for="product_id">ID</label>
                            <input class="pl-20" type="text" name="id" value="{{ $product -> id }}">
                        </div>

                        <div class="py-4">
                            <label class="font-bold pl-24" for="product_name">商品名</label>
                            <input class="pl-9" type="text" name="product_name" value="{{ old('product_name', $product->product_name) }}"><br/>
                            @if ($errors -> has('product_name'))
                                <div>{{ $errors -> first('product_name') }}</div>
                            @endif
                        </div>
                
                        <div class="py-4">
                            <label class="font-bold pl-24" for="company-id">メーカー名</label>
                            <select class="border rounded-md p-2" name="company_id">
                                @foreach($companies as $company)
                                    <option value="{{ old('company_id', $company -> id) }}" {{ $company -> id == $product -> company_id ? 'selected' : '' }}>
                                        {{ $company -> company_name }}
                                    </option>
                                @endforeach
                            </select><br/>
                        </div>
                        
                        <div class="py-4">
                            <label class="font-bold pl-24" for="price">価格</label>
                            <input class="pl-14" type="text" name="price" value="{{ old('price', $product -> price) }}"><br/>
                            @if ($errors -> has('price'))
                                <div>{{ $errors -> first('price') }}</div>
                            @endif
                        </div>
                        
                        <div class="py-4">
                            <label class="font-bold pl-24" for="stock">在庫数</label>
                            <input class="pl-9" type="text" name="stock" value="{{ old('stock', $product -> stock) }}"><br/>
                            @if ($errors -> has('stock'))
                                <div>{{ $errors -> first('stock') }}</div>
                            @endif
                        </div>
                        
                        <div class="py-4">
                            <label class="font-bold pl-24" for="comment">コメント</label>
                            <textarea class="border rounded-md max-w-xs overflow-auto ml-4 pl-2 pt-2" name="comment">{{ old('comment', $product->comment) }}</textarea><br/>
                            @if ($errors -> has('comment'))
                                <div>{{ $errors -> first('comment') }}</div>
                            @endif
                        </div>
                        
                        <div class="py-4">
                            <label class="font-bold pl-24" for="file">商品画像</label>
                            <input class="pl-4" type="file" name="file"><br/>
                        
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>

                        <div class="py-4 pl-24 space-x-1">
                            <button class="bg-blue-500 text-white py-2 px-4 rounded-md" type="submit">送信</button>
                            <a class="bg-gray-500 text-white py-2 px-4 rounded-md" href="{{ route('product.show', ['id' => $product -> id]) }}">戻る</a>
                        </div>
                    </div>
                </form>
            </div>
        @endsection
     </body>
</html>
