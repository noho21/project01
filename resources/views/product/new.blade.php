<html>
    <body>
        <h1>商品新規登録画面</h1>
        <form action="{{route('product.create}}" method = "post">
            @csrf

            商品名：<input type = "text" name = "product_name"><br/>
            価格：<input type = "text" name = "price"><br/>
            在庫：<input type = "text" name = "stock"><br/>
            コメント：<input type = "text" name = "comment"><br/>
            <input type = "submit" value = "送信">
        </form>

        <a href="{{route('product.index')}}">戻る</a>
    </body>
</html>