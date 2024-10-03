<html>
    <body>
        <h1>商品情報編集画面</h1>
        <form action="{{ route('product.update') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{ $product -> id }}">
            id: {{ $product -> id }}
            商品名:<input type="text" name="product_name" value="{{ $product -> product_name }}"><br/>
            メーカー名:<select name="company_id">
                @foreach($companies as $company)
                    <option value="{{ $company -> id }}" {{ $company -> id == $product -> company_id ? 'selected' : '' }}>
                        {{ $company -> company_name }}
                    </option>
                @endforeach
            </select><br/>
            価格:<input type="text" name="price" value="{{ $product -> price }}"><br/>
            在庫数:<input type="text" name="stock" value="{{ $product -> stock }}"><br/>
            コメント:<textarea name="comment">{{ $product -> comment }}</textarea><br/>
            商品画像:<input type="file" name="file"><br/>
            <input type="submit" value="送信">
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
    </body>
</html>
