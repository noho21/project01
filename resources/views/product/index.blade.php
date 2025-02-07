@extends('product.header')

@vite('resources/css/app.css')

@section('title', '一覧')

@section('content')

@extends('product.product_list')
   
@endsection

@section('scripts')
    @vite('resources/js/product.js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
@endsection