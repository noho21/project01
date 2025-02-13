@extends('product.header')

@vite('resources/css/app.css')

@section('title', '一覧')

@section('content')

<div class="overflow-x-auto mx-auto mt-2">

    @if (session('success'))
        <div class="bg-green-500 text-white font-bold py-2 px-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="bg-red-500 text-white font-bold py-2 px-4 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <h3 class="text-left text-2xl w-50 py-5 m-auto">商品一覧画面</h3>

    <form id="searchForm" class="space-x-4 flex justify-center">
        <input id="searchKeyword" class="w-2/6 h-10 rounded border-2" type="text" name="product_name" placeholder="検索キーワード" value="{{ request('product_name') }}">
        <select id="searchCompany" class="w-2/6 h-10 rounded border-2 text-center" name="company_id">
                <option value="">メーカーを選択</option>
                @foreach ($companies as $company)
                    <option value="{{ $company->id }}" @selected((string)request('company_id') === (string)$company->id)>
                        {{$company->company_name}}
                    </option>
                @endforeach
        </select>
        
        <input type="submit" id="searchButton" class="w-1/6 h-10 bg-gray-300 outline-offset-2 focus:ring-2 shadow-xl rounded-md" value="検索">
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
