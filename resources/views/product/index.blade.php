<!doctype html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>一覧</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
     </head>
    <body>
        @extends('product.header')

        @section('content')

            <h3 class="title">商品一覧画面</h3>

                <div class="container">
               
                
                    <form class="row justify-content-md-center" method="GET" action="{{ route('product.index') }}">
                        <input class="col-lg-3 me-3" type="text" name="product_name" placeholder="検索キーワード">
                        <select class="col-lg-3 me-3" name="company_id">
                                <option value="">全てのメーカー</option>
                                @foreach ($companies as $company)
                                    <option value="{{ $company -> id }}" {{ request('company_id') == $company -> id ? 'selected' : '' }}>
                                        {{ $company -> company_name }}
                                    </option>
                                @endforeach
                        </select>
                        
                        <input class="col-lg-1 btn btn-light" type="submit" value="検索">
                    </form>
                </div>

                <table class="table table-striped table-bordered w-50 mt-5 m-auto text-center align-middle">
                    <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>商品画像</th>
                                <th>商品名</th>
                                <th>価格</th>
                                <th>在庫数</th>
                                <th>メーカー名</th>
                                <th>
                                    <a class="btn btn-primary" href="{{ route('product.new') }}">新規登録</a>
                                </th>
                            </tr>
                    </thead>

                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $product -> id }}</td>
                                <td>
                                    <img class="rounded-3" style="height: 100px; width: 100px; object-fit: cover;" src="{{ asset('storage/images/' . $product->filename) }}" alt="商品画像">
                                </td>
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
                                    <a class="btn btn-info" href="{{ route('product.show', ['id' => $product -> id]) }}">詳細</a>
                                    <form action="{{ route('product.delete', ['id' => $product -> id]) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $product -> id }}">
                                        <button class="btn btn-danger" type="submit">削除</button>
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

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
     </body>
</html>
