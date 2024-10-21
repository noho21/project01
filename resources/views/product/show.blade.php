<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>詳細</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
     </head>
    <body>
        @extends('product.header')

        @section('content')
            <h1>商品情報詳細画面</h1>
            <ul>
                <li>
                    <div>ID: {{ $product -> id }}</div>
                    <div>商品名: {{ $product -> product_name }}</div>
                    <div>商品画像: <img style="height: 100px; width: 100px; max-width: 100%; height: auto; object-fit: cover;" src="{{ route('product.getfile', ['id' => $product->id]) }}"></div>
                    <div>メーカー名: {{ $product -> company->company_name }}</div>
                    <div>価格: {{ $product -> price }}</div>
                    <div>在庫数: {{ $product -> stock }}</div>
                    <div>コメント: {{ $product -> comment }}</div>
                </li>
                <a href="{{ route('product.edit', ['id' => $product -> id]) }}">編集</a>
                <a href="{{ route('product.index') }}">戻る</a>
            </ul>
        @endsection
    </body>
</html>
