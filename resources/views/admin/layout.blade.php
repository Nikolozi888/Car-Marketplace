<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script> 
</head>
<body class="bg-gray-100">

<div class="flex h-screen bg-gray-200">
    <div class="w-64 bg-gray-800 text-white shadow-md">
        <div class="p-4 border-b border-gray-700">
            <h2 class="text-2xl font-bold">Admin Panel</h2>
        </div>
        <nav class="mt-4">
            <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-gray-300 hover:bg-gray-700 hover:text-white">
                Dashboard
            </a>
            <a href="{{ route('admin.cars.index') }}" class="block px-4 py-2 text-gray-300 hover:bg-gray-700 hover:text-white">
                მანქანების მართვა
            </a>
            <hr class="my-4 border-gray-600">
            <a href="{{ route('cars.index') }}" target="_blank" class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-700 hover:text-white">
                საჯარო საიტზე გადასვლა &rarr;
            </a>
        </nav>
    </div>

    <div class="flex-1 flex flex-col overflow-hidden">
        <header class="bg-white shadow-md p-4">
            <h1 class="text-xl font-semibold text-gray-800">
                @yield('title', 'Dashboard')
            </h1>
        </header>
        
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
            
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                    <strong>შეცდომა!</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</div>

</body>
</html>