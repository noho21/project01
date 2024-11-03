@extends('product.header')

@section('content')
<!doctype html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>詳細</title>
        @vite('resources/css/app.css')
     </head>
    <body>
        <div class="w-2/5 mx-auto mt-4">
            <h3 class="text-2xl">商品情報詳細画面</h3>
            
            <table class="text-xl border-4 w-full text-left mt-4">
                <tbody>
                    <tr>
                        <th class="py-4 pl-14">ID.</th>
                        <td>{{$product->id}}.</td>
                    </tr>
                    <tr>
                        <th class="py-4 pl-14">商品名</th>
                        <td>{{$product->product_name}}</td>
                    </tr>
                    <tr>
                        <th class="py-4 pl-14">商品画像</th>
                        <td><img class="border-4 rounded size-60" src="{{route('product.getfile', ['id'=>$product->id])}}"></td>
                    </tr>
                    <tr>
                        <th class="py-4 pl-14">メーカー名</th>
                        <td>{{$product->company->company_name}}</td>
                    </tr>
                    <tr>
                        <th class="py-4 pl-14">価格</th>
                        <td>{{$product->price}}</td>
                    </tr>
                    <tr>
                        <th class="py-4 pl-14">在庫数</th>
                        <td>{{$product->stock}}</td>
                    </tr>
                    <tr>
                        <th class="py-4 pl-14">コメント</th>
                        <td class="py-2 pr-5 pl-2 rounded-md max-w-xs overflow-auto border border-gray-300 inline-block comment-border">{{$product->comment}}</td>
                    </tr>
                    <tr>
                        <td class="py-4 pl-14 space-x-2">
                            <a class="bg-orange-400 text-white py-3 px-5 rounded-md" href="{{route('product.edit', ['id'=>$product->id])}}">編集</a>
                            <a class="bg-blue-500 text-white py-3 px-5 rounded-md" href="{{route('product.index')}}">戻る</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
     </body>
</html>
@endsection
