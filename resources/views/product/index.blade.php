<html>
    <body>
        <h1>商品一覧画面</h1>
        <ul>
@foreach( $products as $product)
            <li>
                <div>{{$product -> id}}</div>
                <img style = "height: 100px; width: 100px;" src = "{{route('product.getfile', ['id' => $product -> $id]}}">
                <div>{{$product -> product_name}}</div>
                <div>{{$product -> price}}</div>
                <div>{{$product -> stock}}</div>
                <div>{{$product -> company -> company_name ?? 'デフォルトの会社名'}}</div>
                <a href="{route('product.show', ['id' => $product -> id])}">詳細</a>

                <form action = "{{route('product.delete')}}" method = "post">
                    @csrf
                    <input type = "hidden" name = "id" value = "{{$product -> id}}">
                    <input type= "submit" value = "削除">
                </form>
            </li>
@endforeach
        </ul>

        <hr>
        <a href="{{route('product.new')}}">新規登録</a>
    </body>
</html>