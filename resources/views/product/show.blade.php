<!doctype html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>詳細</title>
        @vite('resources/css/app.css')
     </head>
    <body>
        @extends('product.header')

        @section('content')
            <h3>商品情報詳細画面</h3>
            
            <table>
                <tbody>
                    <tr>
                        <th><h5>ID</h5></th>
                        <td>{{ $product -> id }}.</td>
                    </tr>
                    <tr>
                        <th><h5>商品名</h5></th>
                        <td>{{ $product -> product_name }}</td>
                    </tr>
                    <tr>
                        <th><h5>商品画像</h5></th>
                        <td><img src="{{ route('product.getfile', ['id' => $product->id]) }}"></td>
                    </tr>
                    <tr>
                        <th><h5>メーカー名</h5></th>
                        <td>{{ $product -> company->company_name }}</td>
                    </tr>
                    <tr>
                        <th><h5>価格</h5></th>
                        <td>{{ $product -> price }}</td>
                    </tr>
                    <tr>
                        <th><h5>在庫数</h5></th>
                        <td>{{ $product -> stock }}</td>
                    </tr>
                    <tr>
                        <th><h5>コメント</h5></th>
                        <td>{{ $product -> comment }}</td>
                    </tr>
                    <tr>
                        <td>
                            <a href="{{ route('product.edit', ['id' => $product -> id]) }}">編集</a>
                            <a href="{{ route('product.index') }}">戻る</a>
                        </td>
                    </tr>
                </tbody>
        @endsection
     </body>
</html>
