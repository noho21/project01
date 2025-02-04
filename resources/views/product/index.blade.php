@extends('product.header')

@vite('resources/css/app.css')

@section('title', '一覧')

@section('content')
    <div class="w-1/2 mx-auto mt-4">
    <h3 class="text-left text-2xl w-50 py-5 m-auto">商品一覧画面</h3>
        <form id="searchForm" class="space-x-4 flex justify-center" method="GET" action="{{ route('product.index') }}">
            <input id="searchKeyword" class="w-2/6 h-10 rounded border-2" type="text" name="product_name" placeholder="検索キーワード">
            <select id="searchCompany" class="w-2/6 h-10 rounded border-2 text-center" name="company_id">
                    <option value="">全てのメーカー</option>
                    @foreach ($companies as $company)
                        <option value="{{$company->id}}" @selected(request('company_id') == $company->id)>
                            {{$company->company_name}}
                        </option>
                    @endforeach
            </select>
            
            <button id="searchButton" class="w-1/6 h-10 bg-gray-300 outline-offset-2 focus:ring-2 shadow-xl rounded-md">検索</button>
        </form>
    </div>

    <table id="productTable" class="text-base table-fixed border-4 w-1/2 mx-auto mt-2">
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
        <tbody id="tableBody">
            @foreach ($products as $product)
            <tr class="border-2 h-40 text-center">
                <td>{{$product->id}}</td>
                <td>
                    <img src="{{'storage/images/' . $product->img_path ?? ''}}" alt="商品画像">
                </td>
                <td>{{$product->product_name}}</td>
                <td>{{$product->price}}</td>
                <td>{{$product->stock}}</td>
                <td>
                    @if ($product->company)
                        {{$product->company->company_name}}
                    @else
                        {{$product->company?->company_name ?? 'デフォルトの会社名'}}
                    @endif
                </td>
                <td>
                    <div class="button-group flex flex-row space-x-2 h-10">
                        <a class="no-underline py-2 px-3 bg-blue-500 rounded-md text-white" href="{{ route('product.show', ['id' => $product -> id]) }}">詳細</a>
            
                        <form action="{{route('product.delete', ['id' => $product->id])}}" method="POST" data-id="{{ $product->id }}">
                            @csrf
                            <input type="hidden" name="id" value="{{$product->id}}">
                            <button id="deleteButton" class="py-2 px-3 bg-red-500 rounded-md text-white" type="button" onclick="deleteProduct(this)">削除</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    <div class="flex justify-center my-4">
        {{ $products->links('vendor.pagination.tailwind') }}
    </div>
    <hr>
    @if (session('success'))
        <div class="bg-green-500 text-white font-bold py-2 px-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="bg-red-500 text-white font-bold py-2 px-4 rounded mb-4">
            {{ session('error')}}
        </div>
    @endif
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
    function deleteProduct(button) {
        const productId = button.closest('form').dataset.id;
        const form = button.closest('form');
        Swal.fire({
            title: '本当に削除しますか？',
            text: 'この商品は削除されます。',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: '削除',
            cancelButtonText: 'キャンセル'
        }).then((result) => {
            if (result.isConfirmed) {
                // フォームを送信
                form.submit();
            }
        });
    }
    </script>
    <script>
    $(document).ready(function() {
        $('#searchForm').submit(function(event) {
            event.preventDefault(); //フォーム送信を防ぐ
            fetchProducts(); // 検索実行
        });

        var keyword = $('#searchKeyword').val();
        var company_id = $('##searchCompany').val();
        $(document).on('click', '.pagination a', function(event) {
            event.preventDefault();
            var url = $(this).attr('href');
            fetchProducts(url);
        });

        function fetchProducts(url = "{{ route('product.idex' }}") {
            var keyword = $('#searchKeyword').val();
            var company_id = $('#searchCompany').val();

            $.ajax({
                url: url,
                type: "GET",
                data: { prduct_name: keyword, company_id: company_id },
                dataType: "json",
                success: function(response) {
                    var tableBody = $('#productTable tbody');
                    tableBody.empty(); //一度テーブルをからにする

                    if (response.html) {
                        tableBody.append(response.html);
                    } else {
                        tableBody.append('<tr><td colspan="7" class="text-center py-4">該当する商品が見つかりません。</td></tr>');
                    }

                    //ページネーション部分を更新
                    $('.pagination-wrapper').html(response.pagination);
                },
                error: function() {
                    alert("検索に失敗しました")
                }
            });
        }
    });

    </script>
@endsection