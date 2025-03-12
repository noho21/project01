<table class="text-base table-auto border-4 w-full max-w-4xl mx-auto">
    <thead class="border-2 h-14 text-center bg-cyan-500">
        <tr>
            <!-- <th data-sort="id" class="sortable">ID</th> -->
            <th>
                <a href="{{ route('product.index', array_merge(request()->query(), ['sort_column' => 'id', 'sort_direction' => 'asc'])) }}">
                    ID⏫
                </a>
                <br>
                <a href="{{ route('product.index', array_merge(request()->query(), ['sort_column' => 'id', 'sort_direction' => 'desc'])) }}">
                    ID⏬
                </a>
            </th>
            <th>商品画像</th>
            <th>商品名</th>
            <!-- <th data-sort="price" class="sortable">価格</th> --> 
            <th>
                <a href="{{ route('product.index', array_merge(request()->query(), ['sort_column' => 'price', 'sort_direction' => 'asc'])) }}">
                    価格⏫
                </a>
                <br>
                <a href="{{ route('product.index', array_merge(request()->query(), ['sort_column' => 'price', 'sort_direction' => 'desc'])) }}">
                    価格⏬
                </a>
            </th>
            <th>
                <a href="{{ route('product.index', array_merge(request()->query(), ['sort_column' => 'stock', 'sort_direction' => 'asc'])) }}">
                    在庫数⏫
                </a> 
                <br>
                <a href="{{ route('product.index', array_merge(request()->query(), ['sort_column' => 'stock', 'sort_direction' => 'desc'])) }}">
                    在庫数⏬
                </a>
            </th>
            <th>メーカー名</th>
            <th>
                <a class="p-2 no-underline bg-orange-500 rounded-md text-black block md:inline-block" href="{{ route('product.new') }}">
                    新規登録
                </a>
            </th>
            <th>
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $product)
            <tr class="border-2 h-40 text-center">
                <td>{{ $product->id }}</td>
                <td>
                <img src="{{ $product->img_path ? asset($product->img_path) : asset('storage/no-image.png') }}" alt="商品画像" class="w-20 h-20 md:w-40 md:h-40 object-cover">
                </td>
                <td class="break-words px-2">{{ $product->product_name }}</td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->stock }}</td>
                <td class="break-words px-2">
                    {{ $product->company?->company_name ?? 'デフォルトの会社名' }}
                </td>
                <td>
                    <div class="button-group flex flex-wrap justify-center space-x-2 h-10">
                        <a class="no-underline py-2 px-3 mb-4 bg-blue-500 rounded-md text-white block md:inline-block" href="{{ route('product.show', ['id' => $product -> id]) }}">
                            詳細
                        </a>

                        <form id="deleteForm" action="{{ route('product.delete', ['id' => $product->id]) }}" method="POST" data-id="{{ $product->id }}">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="id" value="{{ $product->id }}">
                            <button type="submit" class="deleteButton py-2 px-3 bg-red-500 rounded-md text-white block md:inline-block">削除</button>
                        </form>
                    </div>
                </td>
                <td>
                    @if($product->stock > 0)
                        <button class="purchase-button bg-green-500 text-white px-3 py-1 rounded" data-id="{{ $product->id }}">購入</button>
                    @else
                        <span class="text-red-500">売り切れ</span>
                    @endif
                </td>

            </tr>
        @endforeach
    </tbody>
</table>
<div id="pagination" class="flex justify-center">
        {{ $products->links() }}
</div>