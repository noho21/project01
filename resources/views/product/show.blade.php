<!doctype html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>詳細</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        @vite('resources/css/app.css')
     </head>
    <body>
        @extends('product.header')

        @section('content')
            <h3 class="title">商品情報詳細画面</h3>
            
            <table class="table table-borderless border w-50 m-auto ">
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
                        <td><img class="img-thumbnail rounded float-start img-fluid w-50" src="{{ route('product.getfile', ['id' => $product->id]) }}"></td>
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
                            <a class="btn btn-custom-orange ml-5" href="{{ route('product.edit', ['id' => $product -> id]) }}">編集</a>
                            <a class="btn btn-info ml-5" href="{{ route('product.index') }}">戻る</a>
                        </td>
                    </tr>
                </tbody>
        @endsection

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
     </body>
</html>
