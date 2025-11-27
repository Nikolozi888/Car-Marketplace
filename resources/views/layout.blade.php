<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Project</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <style>
        .dropdown:hover .dropdown-menu {
            display: block;
        }

        .notification-dropdown-menu {
            display: none;
        }

        .notification-dropdown:hover .notification-dropdown-menu {
            display: block;
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-800">

    <nav class="bg-white shadow-xl border-b border-gray-100 sticky top-0 z-50">
        <div class="container mx-auto px-6 lg:px-8 py-4 flex justify-between items-center">

            <div class="flex items-center space-x-8">
                <a href="{{ route('cars.index') }}"
                    class="text-4xl font-black text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 transition duration-300 tracking-wider">
                    CarMarket
                </a>

                <a href="{{ route('cars.create') }}"
                    class="flex items-center space-x-2 bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-xl shadow-md hover:shadow-lg transform hover:scale-[1.02] transition duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                            clip-rule="evenodd" />
                    </svg>
                    <span>დამატება</span>
                </a>

                <a href="{{ route('admin.dashboard') }}"
                    class="hidden md:block text-gray-600 hover:text-blue-600 font-semibold py-2 px-3 transition duration-150 rounded-lg">
                    ადმინ. პანელი
                </a>
            </div>

            <div class="flex items-center space-x-4">

                @auth

                    <div class="relative notification-dropdown">
                        <button class="p-2 rounded-full hover:bg-gray-100 transition duration-150 focus:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500 hover:text-indigo-600"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                        </button>
                        ({{ Auth::user()->unreadNotifications->count() }})

                        <div
                            class="notification-dropdown-menu absolute right-0 mt-3 w-80 bg-white rounded-xl shadow-2xl border border-gray-200 z-50 overflow-hidden">
                            <div class="px-4 py-3 border-b border-gray-100">
                                <p class="text-sm font-bold text-gray-800">შეტყობინებები</p>
                            </div>
                            <div class="max-h-80 overflow-y-auto">
                                @foreach (Auth::user()->notifications as $notification)
                                    <a href="#"
                                        class="block px-4 py-3 hover:bg-blue-50 transition duration-150 border-b border-gray-100">

                                        @if (($notification->data['type'] ?? null) === 'car')
                                            <p class="text-sm text-gray-700 font-semibold">🚗 {{ $notification->data['message'] }}</p>
                                            <p class="text-sm text-gray-500">
                                                {{ $notification->data['make'] }} - {{ $notification?->data['model'] ?? 'N/A' }}
                                            </p>

                                        @elseif (($notification->data['type'] ?? null) === 'center')
                                            <p class="text-sm text-gray-700 font-semibold">🏢{{ $notification->data['message']  }}</p>
                                            <p class="text-sm text-gray-500">
                                                {{ $notification->data['center_name'] }}
                                            </p>
                                        @endif

                                        <p class="text-xs text-gray-400 mt-1">
                                            {{ $notification->created_at->diffForHumans() }}
                                        </p>
                                    </a>
                                @endforeach

                            </div>
                            <a href="#"
                                class="block text-center py-2 text-sm text-indigo-600 hover:bg-gray-50 border-t border-gray-100">
                                ყველა შეტყობინების ნახვა
                            </a>
                        </div>
                    </div>

                    <div class="relative">
                        <a href="#" class="text-gray-600 hover:text-blue-600 font-medium py-2 px-3 transition duration-150">
                            {{ Auth::user()->name ?? 'ჩემი პროფილი' }}
                        </a>
                    </div>
                @endauth

                @guest
                    <div>
                        <a href="{{ route('login') }}"
                            class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-6 rounded-xl shadow-md hover:shadow-lg transition duration-300 transform hover:scale-[1.02]">
                            შესვლა
                        </a>
                    </div>
                @endguest
            </div>
        </div>
    </nav>

    <main class="container mx-auto px-4 lg:px-8 py-8">
        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 px-4 py-3 rounded-lg relative mb-6 shadow-md"
                role="alert">
                <div class="flex items-center">
                    <svg class="w-6 h-6 mr-2 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path
                            d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z" />
                    </svg>
                    <span class="block sm:inline font-medium">{{ session('success') }}</span>
                </div>
            </div>
        @endif

        @yield('content')
    </main>

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