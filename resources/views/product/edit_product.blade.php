<!doctype html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>編集</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
     </head>
    <body>
        @extends('product.header')

        @section('content')
            <h1>商品情報編集画面</h1>
            <form action="{{ route('product.update', ['id' => $product -> id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" value="{{ $product -> id }}">
                id: {{ $product -> id }}
                商品名:<input type="text" name="product_name" value="{{ old('product_name', $product->product_name) }}"><br/>
                メーカー名:<select name="company_id">
                    @foreach($companies as $company)
                        <option value="{{ old('company_id', $company -> id) }}" {{ $company -> id == $product -> company_id ? 'selected' : '' }}>
                            {{ $company -> company_name }}
                        </option>
                    @endforeach
                </select><br/>
                価格:<input type="text" name="price" value="{{ old('price', $product -> price) }}"><br/>
                在庫数:<input type="text" name="stock" value="{{ old('stock', $product -> stock) }}"><br/>
                コメント:<textarea name="comment">{{ old('comment', $product->comment) }}</textarea><br/>
                商品画像:<input type="file" name="file"><br/>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <button type="submit">送信</button>
                <a href="{{ route('product.show', ['id' => $product -> id]) }}">戻る</a>
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
            </ul>
        @endsection
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
     </body>
</html>
