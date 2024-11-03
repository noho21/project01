<!doctype html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    <header class="bg-gray-800 text-white shadow-md fixed top-0 w-full z-10">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">      
            <div class="text-lg font-bold">
                <a href="/dashboard" class="hover:text-gray-400">STEP7</a>
            </div>
            <div class="flex items-center space-x-4">
                <a href="{{ route('profile.edit') }}" class="text-gray-300 hover:text-white px-4 py-2 rounded-md">プロフィール</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 px-4 py-2 rounded-md">ログアウト</button>
                </form>
            </div>
        </div>
    </header>
    <main class="pt-16">
        @yield('content')
    </main>
</body>
</html>
