<!doctype html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>新規登録</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
     </head>
    <body>
        @extends('product.header')

        @section('content')
            <h1>商品新規登録画面</h1>
            <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                商品名: <input type="text" name="product_name"><br/>
                価格: <input type="text" name="price"><br/>
                在庫: <input type="text" name="stock"><br/>
                コメント: <textarea name="comment"></textarea><br/>
                商品画像: <input type="file" name="file"><br/>
                会社名: <select name="company_id">
                    @foreach($companies as $company)
                        <option value="{{ $company -> id }}">{{ $company -> company_name }}</option>
                    @endforeach
                </select><br/>
                <input type="submit" value="送信">
            </form>

            <ul>
                @if ($errors -> has('product_name'))
                    <li>{{ $errors -> first('product_name') }}</li>
                @endif

                @if ($errors -> has('price'))
                    <li>{{ $errors -> first('price') }}</li>
                @endif

                @if ($errors -> has('stock'))
                    <li>{{ $errors -> first('stock') }}</li>
                @endif

                @if ($errors -> has('comment'))
                    <li>{{ $errors -> first('comment') }}</li>
                @endif

                @if(empty($companies))
                    <li>会社情報が取得できません</li>
                @endif

            </ul>

            <a href="{{ route('product.index') }}">戻る</a>
        @endsection
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
     </body>
</html>
