<html>
    <body>
        <form action="{{ route('product.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="company">メーカー</label>
                <select name="company_id" id="company" class="form-control">
                    @foreach($companies as $company)
                        <option value="{{  $company_id  }}">
                            {{  $company -> name  }} ({{  $company -> representative_name  }}), {{  $company -> street_address  }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">追加</button>
        </form>
    </body>
</html>