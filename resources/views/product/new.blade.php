<html>
    <body>
        <h1>商品新規登録画面</h1>
        <form action="{{route('product.create')}}" method = "post">
            @csrf

            商品名:<input type = "text" name = "product_name"><br/>
            価格:<input type = "text" name = "price"><br/>
            在庫:<input type = "text" name = "stock"><br/>
            コメント:<input type = "text" name = "comment"><br/>
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