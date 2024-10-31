<!doctype html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ヘッダー</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    <!-- ヘッダーバー -->
    <header class="bg-gray-800 text-white shadow-md">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <!-- 左側（ロゴ） -->
            <div class="text-lg font-bold">
                <a href="/dashboard" class="hover:text-gray-400">STEP7</a>
            </div>
            <!-- 右側（プロフィールボタン） -->
            <div class="flex items-center space-x-4">
                <!-- プロフィールページへのリンク -->
                <a href="{{ route('profile.edit') }}" class="text-gray-300 hover:text-white px-4 py-2 rounded-md">プロフィール</a>
                <!-- ログアウトボタン -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 px-4 py-2 rounded-md">ログアウト</button>
                </form>
            </div>
        </div>
    </header>

    <!-- メインコンテンツ -->
    @yield('content')
</body>
</html>
