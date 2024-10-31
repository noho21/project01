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


                <div class="w-1/2 mx-auto mt-4">
                <h3 class="text-left text-2xl w-50 py-5 m-auto">商品一覧画面</h3>
                    <form class="space-x-4 flex justify-center" method="GET" action="{{ route('product.index') }}">
                        <input class="w-2/6 h-10 rounded border-2" type="text" name="product_name" placeholder="検索キーワード">
                        <select class="w-2/6 h-10 rounded border-2 text-center" name="company_id">
                                <option value="">全てのメーカー</option>
                                @foreach ($companies as $company)
                                    <option value="{{ $company -> id }}" {{ request('company_id') == $company -> id ? 'selected' : '' }}>
                                        {{ $company -> company_name }}
                                    </option>
                                @endforeach
                        </select>
                        
                        <input class="w-1/6 h-10 bg-gray-300 outline-offset-2 focus:ring-2 shadow-xl rounded-md" type="submit" value="検索">
                    </form>
                </div>

                <table class="table-fixed border-4 w-1/2 mx-auto mt-2">
                    <thead class="border-2 h-14 text-center bg-cyan-500">
                        <tr>
                            <th>ID</th>
                            <th>商品画像</th>
                            <th>商品名</th>
                            <th>価格</th>
                            <th>在庫数</th>
                            <th>メーカー名</th>
                            <th>
                                <a class="p-2 no-underline bg-orange-500 rounded-md text-black" href="{{ route('product.new') }}">新規登録</a>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                        <tr class="border-2 h-40 text-center">
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
                                <div class="button-group flex flex-row space-x-2">
                                    <a class="no-underline py-2 px-3 bg-blue-500 rounded-md text-white" href="{{ route('product.show', ['id' => $product -> id]) }}">詳細</a>
                        
                                    <form action="{{ route('product.delete', ['id' => $product -> id]) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $product -> id }}">
                                        <button class="py-2 px-3 bg-red-500 rounded-md text-white" type="submit">削除</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                            @endforeach
                    </tbody>
                </table>
                
                <div class="flex justify-center my-4">
                    {{ $products -> links('vendor.pagination.tailwind') }}
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
