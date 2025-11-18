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
        <div class="p-4 border-b border-gray-700 flex justify-between items-center">
            <h2 class="text-2xl font-bold">Admin Panel</h2>

            <div class="relative notification-dropdown">
                <button id="notification-toggle" class="p-2 rounded-full hover:bg-gray-700 transition duration-150 focus:outline-none relative">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white/80 hover:text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                    @if (Auth::user()->unreadNotifications->count() > 0)
                        <span class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-100 transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full">
                            {{ Auth::user()->unreadNotifications->count() }}
                        </span>
                    @endif
                </button>

                <div id="notification-menu" class="notification-dropdown-menu absolute right-0 mt-3 w-80 bg-white rounded-xl shadow-2xl border border-gray-200 z-50 overflow-hidden hidden">
                    <div class="px-4 py-3 border-b border-gray-100">
                        <p class="text-sm font-bold text-gray-800">შეტყობინებები</p>
                    </div>
                    <div class="max-h-80 overflow-y-auto">
                        @foreach (Auth::user()->notifications as $notification)
                            <a href="#"
                            class="block px-4 py-3 hover:bg-blue-50 transition duration-150 border-b border-gray-100 {{ $notification->read_at ? '' : 'bg-blue-50 font-semibold' }}">
                                @if(isset($notification->data['message']))
                                    <p class="text-sm text-gray-700">{{ $notification->data['message'] }}</p>
                                @endif

                                <p class="text-xs text-gray-400 mt-1">
                                    {{ $notification->created_at->diffForHumans() }}
                                </p>
                            </a>
                        @endforeach
                    </div>
                    <a href="#" class="block text-center py-2 text-sm text-indigo-600 hover:bg-gray-50 border-t border-gray-100">
                        ყველა შეტყობინების ნახვა
                    </a>
                </div>
            </div>
        </div>
        <nav class="mt-4">
            <a href="{{ route('admin.dashboard') }}" 
            class="block px-4 py-2 text-gray-300 hover:bg-gray-700 hover:text-white {{ Route::is('admin.dashboard') ? 'bg-gray-700 text-white font-semibold' : '' }}">
                Dashboard
            </a>
            <a href="{{ route('admin.cars.index') }}" 
            class="block px-4 py-2 text-gray-300 hover:bg-gray-700 hover:text-white {{ Route::is('admin.cars.*') ? 'bg-gray-700 text-white font-semibold' : '' }}">
                მანქანების მართვა
            </a>
            <a href="{{ route('admin.centers.index') }}" 
            class="block px-4 py-2 text-gray-300 hover:bg-gray-700 hover:text-white {{ Route::is('admin.centers.*') ? 'bg-gray-700 text-white font-semibold' : '' }}">
                ცენტრების მართვა
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

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toggleButton = document.getElementById('notification-toggle');
        const menu = document.getElementById('notification-menu');

        toggleButton.addEventListener('click', function () {
            menu.classList.toggle('hidden');
        });
        
        document.addEventListener('click', function (event) {
            if (!toggleButton.contains(event.target) && !menu.contains(event.target)) {
                menu.classList.add('hidden');
            }
        });
    });
</script>