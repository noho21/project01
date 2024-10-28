<!doctype html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>一覧</title>
        @vite('resources/css/app.css')
    </head>
    <body>
        @extends('product.header')

        @section('content')

            
                <div>
                    <h3>商品一覧画面</h3>

                        <form method="GET" action="{{ route('product.index') }}">
                            <input type="text" name="product_name" placeholder="検索キーワード">
                            <select name="company_id">
                                    <option value="">全てのメーカー</option>
                                    @foreach ($companies as $company)
                                        <option value="{{ $company -> id }}" {{ request('company_id') == $company -> id ? 'selected' : '' }}>
                                            {{ $company -> company_name }}
                                        </option>
                                    @endforeach
                            </select>
                            
                            <input type="submit" value="検索">
                        </form>
                </div>

                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>商品画像</th>
                            <th>商品名</th>
                            <th>価格</th>
                            <th>在庫数</th>
                            <th>メーカー名</th>
                            <th>
                                <a href="{{ route('product.new') }}">新規登録</a>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                        <tr>
                            <td>{{ $product -> id }}</td>
                            <td>
                                <img src="{{ asset('storage/images/' . $product->filename) }}" alt="商品画像">
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
                                <div class="button-group">
                                    <a href="{{ route('product.show', ['id' => $product -> id]) }}">詳細</a>
                        
                                    <form action="{{ route('product.delete', ['id' => $product -> id]) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $product -> id }}">
                                        <button type="submit">削除</button>
                                    </form>
                                </div>
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
