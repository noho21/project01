<!doctype html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>新規登録</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        @vite('resources/css/app.css')
     </head>
    <body>
        @extends('product.header')

        @section('content')
            <h3>商品新規登録画面</h3>
            <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <table class="table table-borderless border w-50 m-auto">
                    <tr>
                        <th>商品名<span class="required">*</span></th>
                        <td><input type="text" name="product_name"></td>
                    </tr>
                    <tr>
                        <th>メーカー名<span class="required">*</span></th>
                        <td>
                            <select name="company_id">
                            @foreach($companies as $company)
                                <option value="{{ $company -> id }}">{{ $company -> company_name }}</option>
                            @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>価格<span class="required">*</span></th>
                        <td><input type="text" name="price"></td>
                    </tr>
                    <tr>
                        <th>在庫数<span class="required">*</span></th>
                        <td><input type="text" name="stock"></td>
                    </tr>
                    <tr>
                        <th>コメント</th>
                        <td><textarea name="comment"></textarea></td>
                    </tr>
                    <tr>
                        <th>商品画像</th>
                        <td><input type="file" name="file"></td>
                    </tr>
                    <tr>
                        <th>
                            <input class="btn btn-custom-orange ml-5" type="submit" value="新規登録">
                            <a class="btn btn-info ml-5" href="{{ route('product.index') }}">戻る</a>
                        </th>
                    </tr>
                </table>
         </form>

            <ul>
                @if ($errors -> has('product_name'))
                    <li>{{ $errors -> first('product_name') }}</li>
                @endif

                @if ($errors -> has('price'))
                    <li>{{ $errors -> first('price') }}</li>
                @endif

                @if ($errors -> has('stock'))
                    <li>{{ $errors -> first('stock') }}</li>
                @endif

                @if ($errors -> has('comment'))
                    <li>{{ $errors -> first('comment') }}</li>
                @endif

                @if(empty($companies))
                    <li>会社情報が取得できません</li>
                @endif

            </ul>
        @endsection
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
     </body>
</html>
