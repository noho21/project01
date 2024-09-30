<html>
    <body>
        <h1>商品情報編集画面</h1>
        <form action="">
            @csrf
            <input type = "hidden" name = "id" value = "{{$product -> id}}">
            id:{{$produt -> id}}
            商品名:<input type = "text" name = "product_name" value = "{{$product -> product_name}}"><br/>
            @if($errors->has('product_name'))
            <li>{{$errors->first('product_name')}}</li>
            @endif
            メーカー名:<select name = "comapny_id">
                @foreach($companies as $company)
                <option value = "{{$company_id}}">{{$company -> company_id}}</option>
                @endforeach
                </select><br/>
            価格:<input type = "text" name = "price" value = "{{$product -> price}}"><br/>
            @if($errors->has('price'))
            <li>{{$errors->first('price')}}</li>
            @endif
            在庫数:<input type = "text" name = "stock" value = "{{$product -> stock}}"><br/>
            @if($errors->has('stock'))
            <li>{{$errors->first('stock')}}</li>
            @endif
            コメント:<textarea>"{{$product -> comment}}"</textarea><br/>
            @if($errors->has('comment'))
            <li>{{$errors->first('comment')}}</li>
            @endif
            商品画像:<input type = "file" name = "file" value = "{{$produt -> file}}"><br/>
            <input type = "submit" value = "送信">
            <a href = "{{route('product.show', ['id' => $product_id])}}">戻る</a>
        </form>
    </body>
</html>