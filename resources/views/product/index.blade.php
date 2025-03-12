@extends('product.header')

@vite('resources/css/app.css')

@section('title', '一覧')

@section('content')

<div class="overflow-x-auto mx-auto mt-2">

    <h3 class="text-left text-2xl w-50 py-5 m-auto">商品一覧画面</h3>

    <form id="searchForm">
        <div class="flex justify-center space-x-3">
            <input id="searchKeyword" class="w-2/6 h-10 rounded border-4 border-green-600" type="text" name="product_name" placeholder="検索キーワード" value="{{ request('product_name') }}">
            <select id="searchCompany" class="w-2/6 h-10 rounded border-4 border-green-600 text-center" name="company_id">
                    <option value="">メーカーを選択</option>
                    @foreach ($companies as $company)
                        <option value="{{ $company->id }}" @selected((string)request('company_id') === (string)$company->id)>
                            {{$company->company_name}}
                        </option>
                    @endforeach
            </select>
        </div>
        <div class="flex justify-center space-x-3 py-3">
            <input type="number" id="minPrice" class="border-2 border-pink-300 rounded-md text-left" name="min_price" value="{{ request('min_price') }}" placeholder="最小価格">
            <input type="number" id="maxPrice" class="border-2 border-pink-400 rounded-md text-left" name="max_price" value="{{ request('max_price') }}" placeholder="最大価格">
            <input type="number" id="minStock" class="border-2 border-pink-300 rounded-md text-left" name="min_stock" value="{{ request('min_stock') }}" placeholder="最小在庫">
            <input type="number" id="maxStock" class="border-2 border-pink-400 rounded-md text-left" name="max_stock" value="{{ request('max_stock') }}" placeholder="最大在庫">
        </div>
        <div class="flex justify-center">
            <input type="submit" id="searchButton" class="w-1/6 h-10 bg-gray-300 outline-offset-2 focus:ring-2 shadow-xl rounded-md" value="検索">
        </div>
    </form>

    <div id="productList">
        @include('product.product_list', [ 'products' => $products ])
    </div>
</div>

@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="{{ asset('js/product.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection
