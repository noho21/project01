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

        <hr>
        <a href="{{route('product.new')}}">新規登録</a>
    </body>
</html>