<html>
    <body>
        <h1>商品情報編集画面</h1>
        <form action="">
            @csrf
            <input type = "hidden" name = "id" value = "{{$product -> id}}">
            id:{{$produt -> id}}
            商品名:<input type = "text" name = "product_name" value = "{{$product -> product_name}}"><br/>
            価格:<input type = "text" name = "price" value = "{{$product -> price}}"><br/>
            在庫数:<input type = "text" name = "stock" value = "{{$product -> stock}}"><br/>
            コメント:<textarea>"{{$product -> comment}}"</textarea><br/>
            <input type = "submit" value = "送信">
            <a href = "{{route('product.show', ['id' => $product_id])}}">戻る</a>
        </form>
    </body>
</html>