@foreach ($products as $product)
    <tr class="border-2 h-40 text-center">
        <td>{{ $product->id }}</td>
        <td>
            <img src="{{ $product->img_path ? asset('storage/images/' . $product->img_path) : asset('storage/no-image.png') }}" alt="商品画像" class="w-20 h-20 md:w-40 md:h-40 object-cover">
        </td>
        <td class="break-words px-2">{{ $product->product_name }}</td>
        <td>{{ $product->price }}</td>
        <td>{{ $product->stock }}</td>
        <td class="break-words px-2">
            {{ $product->company?->company_name ?? 'デフォルトの会社名' }}
        </td>
        <td>
            <div class="button-group flex flex-wrap justify-center space-x-2 h-10">
                <a class="no-underline py-2 px-3 bg-blue-500 rounded-md text-white block md:inline-block" href="{{ route('product.show', ['id' => $product -> id]) }}">
                    詳細
                </a>

                <form id="deleteForm" action="{{ route('product.delete', ['id' => $product->id]) }}" method="POST" data-id="{{ $product->id }}">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="id" value="{{ $product->id }}">
                    <input type="submit" class="deleteButton py-2 px-3 bg-red-500 rounded-md text-white block md:inline-block" value="削除">
                </form>
            </div>
        </td>
    </tr>
@endforeach     
