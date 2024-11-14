@extends('product.header')

@vite('resources/css/app.css')

@section('title', '編集')

@section('content')
    <div class="p-4 w-2/5 mx-auto">
        <h3 class="text-2xl">商品情報編集画面</h3>
        <form class="border-4 text-xl w-full mt-4" action="{{ route('product.update', ['id' => $product -> id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
                <div class="py-4 flex">
                    <div class="font-bold pl-24 py-2">ID</div>
                    <div class="ml-20 p-2">{{ $product -> id }}.</div>
                </div>

                <div class="py-4">
                    <label class="font-bold pl-24" for="product_name">商品名</label>
                    <input class="ml-10 p-2 border rounded-md" type="text" name="product_name" value="{{old('product_name', $product->product_name)}}"><br/>
                    @error ('product_name')
                        <div class="text-red-600 mt-1 pl-24">{{$message}}</div>
                    @enderror
                </div>
        
                    <div class="py-4">
                        <label class="font-bold pl-24" for="company-id">メーカー名</label>
                        <select class="ml-1 p-2 border rounded-md" name="company_id">
                            @foreach ($companies as $company)
                                <option value="{{$company->id}}" @selected($product->company_id == $company->id)>
                                    {{$company->company_name}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                
                <div class="py-4">
                    <label class="font-bold pl-24" for="price">価格</label>
                    <input class="ml-14 p-2 border rounded-md" type="text" name="price" value="{{old('price', $product->price)}}"><br/>
                    @error ('price')
                        <div class="text-red-600 mt-1 pl-24">{{$message}}</div>
                    @enderror
                </div>
                
                <div class="py-4">
                    <label class="font-bold pl-24" for="stock">在庫数</label>
                    <input class="ml-10 p-2 border rounded-md" type="text" name="stock" value="{{old('stock', $product->stock)}}"><br/>
                    @error ('stock')
                        <div class="text-red-600 mt-1 pl-24">{{$message}}</div>
                    @enderror
                </div>
                
                <div class="py-4">
                    <label class="font-bold pl-24" for="comment">コメント</label>
                    <textarea class="border rounded-md max-w-xs overflow-auto ml-4 pl-2 pt-2" name="comment">{{ old('comment', $product->comment) }}</textarea><br/>
                    @if ($errors->has('comment'))
                        <div class="text-red-600 mt-1 pl-24">{{$errors->first('comment')}}</div>
                    @endif
                </div>
                
                <div class="py-4">
                    <label class="font-bold pl-24" for="img_path">商品画像</label>
                    <input class="pl-4" type="file" name="img_path"><br/>
                    @error ('img_path')
                        <div class="text-red-600 mt-1 pl-24">{{$message}}</div>
                    @enderror
                </div>

                <div class="py-4 pl-24 space-x-1">
                    <button class="bg-blue-500 text-white py-2 px-4 rounded-md" type="submit">送信</button>
                    <a class="bg-gray-500 text-white py-2 px-4 rounded-md" href="{{route('product.show', ['id' => $product->id])}}">戻る</a>
                </div>
            </div>
        </form>
    </div>
@endsection
