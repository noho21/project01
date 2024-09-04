<html>
    <body>
        <h1>商品一覧画面</h1>
        <ul>
@foreach( $products as $product)
            <li>
                <div>{{$product->id}}</div>
                <div>{{$product->product_name}}</div>
                <div>{{$product->price}}</div>
                <div>{{$produvt->stock}}</div>
                <div>{{$product->comment}}</div>
            </li>
@endforeach
        </ul>
    </body>
</html>