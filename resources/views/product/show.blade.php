<html>
    <body>
        <h1>商品情報詳細画面</h1>
        <ul>
            <li>
                <div>ID:{{$product -> id}}</div>
                <div>商品名:{{$product -> product_name}}</div>
                <div>価格:{{$product -> price}}</div>
                <div>在庫数:{{$product -> stock}}</div>
                <div>コメント:{{$product -> comment}}</div>
            </li>
        </ul>
    </body>
</html>