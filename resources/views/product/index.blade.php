<html>
    <body>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <h1>商品一覧画面</h1>
        <div>
            <form method = "GET" action = "{{route('product/index')}}">
                @csrf
                <input type = "text" name = "product_name" placeholder = "表品名">
                <select name="company_id">
                    @foreach($companies as $company)
                        <option value="{{company -> id}}">{{$company -> company_name}}</option>
                    @endforeach
                </select>
                <input type="submit" value="検索">
            </form>
        </div>
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
        <div>
        {{ $products->links('vendor.pagination.bootstrap-4') }}
        </div>
        <hr>
        <a href="{{route('product.new')}}">新規登録</a>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    </body>
</html>