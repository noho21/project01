<html>
    <body>
        @extends('product.header')

        @section('content')
            <h3>商品一覧画面</h3>

            <div class="container">
                <form class="row justify-content-md-center" method="GET" action="{{ route('product.index') }}">
                    @csrf
                    
                    <input class="col col-lg-2 ms-3" type="text" name="product_name" placeholder="検索キーワード">
                    <select class="col col-lg-2 ms-3" name="company_id">
                        @foreach ($companies as $company)
                            <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                        @endforeach
                    </select>
                    <input class="col col-lg-2 ms-3"type="submit" value="検索">
                </form>
            </div>

            <table class="products_table m-auto mt-5 w-50">
                <thead class="container text-center m-0 border-top border-end border-start border-dark">
                    <tr class="border-bottom border-dark row  justify-content-md-center">
                        <th class="col col-lg-1">ID</th>
                        <th class="col col-lg-1">商品画像</th>
                        <th class="col col-lg-2">商品名</th>
                        <th class="col col-lg-2">価格</th>
                        <th class="col col-lg-1">在庫数</th>
                        <th class="col col-lg-2">メーカー名</th>
                        <th class="col col-lg-2">
                            <div class="d-flex justify-content-start">
                                <a class="btn btn-primary" href="{{ route('product.new') }}">新規登録</a>
                            </div>
                        </th>
                    </div>
                </tr>
            </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr class="row justify-content-md-center border-bottom border-dark">
                            <td class="col col-lg-1 mb-2 mt-2">{{ $product -> id }}</td>
                            <td class="col col-lg-1 mb-2 mt-2">
                                <img class="rounded-3" style="height: 100px; width: 100px; object-fit: cover;" src="{{ asset('storage/images/' . $product->filename) }}" alt="商品画像">
                            </td>
                            <td class="col col-lg-2 mb-2 mt-2">{{ $product -> product_name }}</td>
                            <td class="col col-lg-2 mb-2 mt-2">{{ $product -> price }}</td>
                            <td class="col col-lg-1 mb-2 mt-2">{{ $product -> stock }}</td>
                            <td class="col col-lg-2 mb-2 mt-2">
                                @if ($product -> company)
                                    {{ $product -> company -> company_name }}
                                @else
                                    デフォルトの会社名
                                @endif
                            </td>

                            <td class="col col-lg-2 d-flex gap-2 d-md-block">
                                <a class="btn btn-warning mt-3 ps-4 pe-4" href="{{ route('product.show', ['id' => $product -> id]) }}">詳細</a>
                                <form action="{{ route('product.delete', ['id' => $product -> id]) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $product -> id }}">
                                    <button class=" btn btn-danger mt-3 ps-4 pe-4" type="submit">削除</button>
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
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

        @endsection
    </body>
</html>
