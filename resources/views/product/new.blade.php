<html>
    <body>
        @extends('product.header')

        @section('content')
            <h1>商品新規登録画面</h1>
            <form action="{{ route('product.create') }}" method="post" enctype="multipart/form-data">
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
    </body>
</html>
