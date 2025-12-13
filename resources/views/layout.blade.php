<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}"> <title>Car Project</title>
    
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script> 

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
        
        /* Alpine.js-ის დამალვა სანამ ინიციალიზდება */
        [x-cloak] { display: none !important; }
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
                                            <p class="text-sm text-gray-700 font-semibold">🏢{{ $notification->data['message'] }}</p>
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

    <div x-data="floatingChat()" class="fixed bottom-6 right-6 z-50">
        
        <button 
            @click="isOpen = !isOpen; if (isOpen) { scrollToBottom() }"
            class="bg-blue-600 hover:bg-blue-700 text-white p-4 rounded-full shadow-2xl transition duration-300 transform hover:scale-110 focus:outline-none focus:ring-4 focus:ring-blue-500 focus:ring-opacity-50"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.984L2 17l1.338-3.14A9.13 9.13 0 012 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd" />
            </svg>
        </button>

        <div 
            x-show="isOpen" 
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 scale-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 scale-95"
            @click.outside="isOpen = false"
            x-cloak
            class="absolute bottom-full right-0 mb-4 w-80 h-96 bg-white rounded-xl shadow-2xl flex flex-col overflow-hidden border border-gray-200"
        >
            
            <div class="bg-blue-600 p-3 text-white flex justify-between items-center shadow-md">
                <h2 class="text-lg font-semibold">CarMarket AI Chat</h2>
                <button @click="isOpen = false" class="text-white hover:text-blue-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div class="flex-1 p-3 overflow-y-auto bg-gray-50 flex flex-col gap-2" id="floating-chat-box">

                <template x-for="(msg, index) in messages" :key="index">
                    <div :class="msg.role === 'user' ? 'flex justify-end' : 'flex justify-start'">
                        <div :class="msg.role === 'user' 
                            ? 'bg-blue-600 text-white rounded-lg rounded-br-none' 
                            : 'bg-white border border-gray-200 text-gray-800 rounded-lg rounded-tl-none'"
                             class="p-2 text-sm max-w-[80%] shadow-sm">
                            <p x-text="msg.content"></p>
                        </div>
                    </div>
                </template>

                <div x-show="isLoading" x-cloak class="flex justify-start">
                    <div class="bg-gray-200 p-2 rounded-lg flex gap-1 items-center">
                        <div class="w-2 h-2 bg-gray-500 rounded-full animate-bounce"></div>
                        <div class="w-2 h-2 bg-gray-500 rounded-full animate-bounce delay-75"></div>
                        <div class="w-2 h-2 bg-gray-500 rounded-full animate-bounce delay-150"></div>
                    </div>
                </div>
            </div>

            <div class="p-3 bg-white border-t border-gray-200">
                <form @submit.prevent="sendMessage" class="flex gap-2">
                    <input type="text" 
                           x-model="userInput" 
                           :disabled="isLoading"
                           placeholder="შეტყობინება..." 
                           class="flex-1 border border-gray-300 rounded-lg px-3 py-1 text-sm focus:outline-none focus:border-blue-500 transition disabled:opacity-50">
                    
                    <button type="submit" 
                            :disabled="isLoading || !userInput.trim()"
                            class="bg-blue-600 hover:bg-blue-700 text-white rounded-lg p-2 w-8 h-8 flex items-center justify-center transition disabled:opacity-50 disabled:cursor-not-allowed">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z" />
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </div>
    
    <script>
        function floatingChat() {
            return {
                isOpen: false,
                userInput: '',
                isLoading: false,
                // შეტყობინების ისტორია
                messages: [{ role: 'assistant', content: 'გამარჯობა! მე CarMarket-ის ასისტენტი ვარ. შემიძლია დაგეხმაროთ მანქანების პოვნაში. 🚗' }], 
                
                async sendMessage() {
                    if (this.userInput.trim() === '') return;

                    const text = this.userInput;
                    this.userInput = '';
                    
                    this.messages.push({ role: 'user', content: text });
                    this.scrollToBottom();
                    
                    this.isLoading = true;

                    try {
                        const response = await fetch("{{ route('chat.send') }}", {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') 
                            },
                            body: JSON.stringify({ 
                                message: text,
                                history: this.messages 
                            })
                        });

                        if (!response.ok) throw new Error('API request failed');

                        const data = await response.json();
                        
                        this.messages.push({ role: 'assistant', content: data.reply });
                        
                    } catch (error) {
                        console.error('Chat Error:', error);
                        this.messages.push({ role: 'assistant', content: 'დაფიქსირდა შეცდომა. სცადეთ მოგვიანებით.' });
                    } finally {
                        this.isLoading = false;
                        this.scrollToBottom();
                    }
                },

                scrollToBottom() {
                    this.$nextTick(() => { 
                        const chatBox = document.getElementById('floating-chat-box');
                        if (chatBox) {
                            chatBox.scrollTop = chatBox.scrollHeight;
                        }
                    });
                }
            }
        }
    </script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Note: since your notification dropdown uses :hover classes, this JS may not be strictly necessary 
            // but I've kept it here for robustness if you decide to change the CSS logic.
            const toggleButton = document.getElementById('notification-toggle');
            const menu = document.getElementById('notification-menu');

            if (toggleButton && menu) {
                toggleButton.addEventListener('click', function () {
                    menu.classList.toggle('hidden');
                });
            }

            // Click outside handler
            document.addEventListener('click', function (event) {
                if (toggleButton && menu && !toggleButton.contains(event.target) && !menu.contains(event.target)) {
                    menu.classList.add('hidden');
                }
            });
        });
    </script>

</body>
</html>