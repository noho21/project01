<html>
    <body>
        <h1>商品新規登録画面</h1>
        <form action="{{route('product.create')}}" method = "post">
            @csrf

            商品名:<input type = "text" name = "product_name"><br/>
            @if($errors->has('product_name'))
            <li>{{$errors->first('product_name')}}</li>
            @endif
            価格:<input type = "text" name = "price"><br/>
            @if($errors->has('price'))
            <li>{{$errors->first('price)}}</li>
            @endif
            在庫:<input type = "text" name = "stock"><br/>
            @if($errors->has('stock'))
            <li>{{$errors->first('stock')}}</li>
            @endif
            コメント:<input type = "text" name = "comment"><br/>
            @if($errors->has('comment'))
            <li>{{$errors->first('comment')}}</li>
            @endif
            商品画像:<input type = "file" name = "file"><br/>
            会社名:<select name="company_id">
                @foreach($companies as $company)
                <option value="{{$company_id}}">{{$company -> company_name}}</option>
                @endforeach
            </select><br/>
            <input type = "submit" value = "送信">
        </form>

        <a href="{{route('product.index')}}">戻る</a>
    </body>
</html>