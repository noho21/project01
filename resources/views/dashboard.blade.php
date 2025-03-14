<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="text-center max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
                <div class="p-6 text-gray-900">
                    <p>ようこそ、{{ Auth::user()->name }}さん！</p>

                    <a href="{{ route('product.index') }}" class="bg-pink-400 p-2 rounded">商品一覧ページ</a>

                    <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                        @csrf
                        <button type="submit" class="bg-gray-300 p-2 rounded">ログアウト</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

