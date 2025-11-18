<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Project</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script> 
</head>
<body class="bg-gray-100 text-gray-800">

    <nav class="bg-white shadow-lg border-b border-gray-200">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center space-x-6">
                <a href="{{ route('cars.index') }}" class="text-3xl font-extrabold text-blue-600 tracking-tight hover:text-blue-700 transition">
                    CarMarket
                </a>
                <a href="{{ route('cars.create') }}" class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded-lg shadow-sm transition">
                    + დამატება
                </a>
                <a href="{{ route('admin.dashboard') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg shadow-sm transition">
                    Dashboard
                </a>
            </div>

            @guest
                <div>
                    <a href="{{ route('login') }}" class="bg-gray-800 hover:bg-gray-900 text-white font-semibold py-2 px-5 rounded-lg shadow-sm transition">
                        Login
                    </a>
                </div>
            @endguest
        </div>
    </nav>

    <main class="container mx-auto px-4 py-8">
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        @yield('content')
    </main>

</body>
</html>
