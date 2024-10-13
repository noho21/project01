<html>
    <body>
        @extends('product.header')

        @section('content')
            <h1>商品情報詳細画面</h1>
            <ul>
                <li>
                    <div>ID: {{ $product -> id }}</div>
                    <div>商品名: {{ $product -> product_name }}</div>
                    <div>商品画像: <img style="height: 100px; width: 100px;" src="{{ route('product.getfile', ['id' => $product->id]) }}"></div>
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
