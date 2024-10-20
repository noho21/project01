<html>
    <body>
        @extends('product.header')

        @section('content')
            <h3>商品一覧画面</h3>

            <div class="container">
                <form class="row justify-content-md-center" method="GET" action="{{ route('product.index') }}">
                    @csrf
                    
                    <input type="text" name="product_name" placeholder="検索キーワード">
                    <select name="company_id">
                        @foreach ($companies as $company)
                            <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                        @endforeach
                    </select>
                    <input type="submit" value="検索">
                </form>
            </div>
            <table class="products_table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>商品画像</th>
                        <th>商品名</th>
                        <th>価格</th>
                        <th>在庫数</th>
                        <th>メーカー名</th>
                        <th><a href="{{ route('product.new') }}">新規登録</a></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $product -> id }}</td>
                            <td><img style="height: 100px; width: 100px; max-width: 100%; height: auto; object-fit: cover;" src="{{ route('product.getfile', ['id' => $product -> id]) }}" alt="商品画像"></td>
                            <td>{{ $product -> product_name }}</td>
                            <td>{{ $product -> price }}</td>
                            <td>{{ $product -> stock }}</td>
                            <td>
                                @if ($product -> company)
                                    {{ $product -> company -> company_name }}
                                @else
                                    デフォルトの会社名
                                @endif
                            </td>

                            <td>
                                <a href="{{ route('product.show', ['id' => $product -> id]) }}">詳細</a>
                                <form action="{{ route('product.delete', ['id' => $product -> id]) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $product -> id }}">
                                    <button type="submit">削除</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div>
                {{ $products -> links('vendor.pagination.bootstrap-4') }}
            </div>
            <hr>
        @endsection
    </body>
</html>
