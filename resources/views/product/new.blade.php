@extends('product.header')

@section('content')
<!doctype html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>新規登録</title>
        @vite('resources/css/app.css')
     </head>
    <body>
        <div class="p-4 w-2/5 mx-auto">
            <h3 class="text-2xl font-bold mb-4">商品新規登録画面</h3>
            <form class="border-4 text-xl w-full mt-4" action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="py-4">
                    <label class="font-bold ml-24" for="product_name">商品名<span class="required text-red-600">*</span></label>
                    <input class="ml-10 border rounded-md max-w-xs overflow-auto" type="text" name="product_name">
                    @error ('product_name')
                        <div class="text-red-600 mt-1">{{$message}}</div>
                    @enderror
                </div>
        
                <div class="py-4">
                    <label class="font-bold pl-24" for="company-id">メーカー名<span class="required text-red-600">*</span></label>
                    <select class="border rounded-md p-2" name="company_id">
                        @foreach ($companies as $company)
                            <option value="{{$company->id}}" @selected(request('company_id') == $company->id)>
                                {{$company->company_name}}
                            </option>
                        @endforeach
                    </select>
                    @error ('company_id')
                        <div class="text-red-600 mt-1">{{$message}}</div>
                    @enderror
                </div>
                
                <div class="py-4">
                    <label class="font-bold pl-24" for="price">価格<span class="required text-red-600">*</span></label>
                    <input class="ml-14 border rounded-md" type="text" name="price"><br/>
                    @error ('price')
                        <div class="text-red-600 mt-1">{{$message}}</div>
                    @enderror
                </div>
                
                <div class="py-4">
                    <label class="font-bold pl-24" for="stock">在庫数<span class="required text-red-600">*</span></label>
                    <input class="ml-9 border rounded-md" type="text" name="stock"><br/>
                    @error ('stock')
                        <div class="text-red-600 mt-1">{{$message}}</div>
                    @enderror
                </div>
                
                <div class="py-4">
                    <label class="font-bold pl-24" for="comment">コメント</label>
                    <textarea class="border rounded-md max-w-xs overflow-auto ml-6 pl-2 pt-2" name="comment"></textarea><br/>
                    @error ('comment')
                        <div class="text-red-600 mt-1">{{$message}}</div>
                    @enderror
                </div>
                
                <div class="py-4">
                    <label class="font-bold pl-24" for="file">商品画像</label>
                    <input class="ml-6" type="file" name="file"><br/>
                
                    @error ('file')
                        <div class="text-red-600 mt-1">{{$message}}</div>
                    @enderror
                </div>

                <div class="py-4 pl-24 space-x-1">
                    <button class="bg-orange-500 text-white py-2 px-4 rounded-md" type="submit">新規登録</button>
                    <a class="bg-gray-500 text-white py-2 px-4 rounded-md" href="{{ route('product.index') }}">戻る</a>
                </div>
            </form>
        </div>
     </body>
</html>
@endsection