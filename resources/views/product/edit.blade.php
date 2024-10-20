<html>
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
    </body>
</html>
