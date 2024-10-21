<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>メーカー</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
     </head>
    <body>
        @extends('product.header')
            
        @section('content')
            <h1>メーカー情報登録画面</h1>
            <form action="{{  route('company.store')  }}" method="post">
                @csrf

                会社名:<input type="text" name="company_name" required><br/>
                住所:<input type="text" name="street_address" required><br/>
                代表の名前:<input type="text" name="representative_name" required><br/>
                <input type="submit" value="登録">
            </form>

            <ul>
                @if ($errors -> any())
                    @foreach ($errors -> all() as $error)
                        <li>{{  $error  }}</li>
                    @endforeach
                @endif
            </ul>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <a href="{{  route('product.index')  }}">戻る</a>
        @endsection
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    </body>
</html>