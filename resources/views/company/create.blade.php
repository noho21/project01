<html>
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
    </body>
</html>