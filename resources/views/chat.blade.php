<!DOCTYPE html>
<html lang="ka">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laravel AI Chat</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        [x-cloak] { display: none !important; }
        .scrollbar-hide::-webkit-scrollbar { display: none; }
        .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="bg-gray-100 h-screen flex items-center justify-center">

    <div class="w-full max-w-2xl bg-white shadow-xl rounded-lg overflow-hidden flex flex-col h-[80vh]" 
         x-data="chatBot()">
        
        <div class="bg-indigo-600 p-4 text-white flex justify-between items-center shadow-md">
            <h1 class="text-lg font-bold flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                </svg>
                AI ასისტენტი
            </h1>
            <span class="text-xs bg-indigo-500 px-2 py-1 rounded-full">Laravel 12</span>
        </div>

        <div class="flex-1 p-4 overflow-y-auto bg-gray-50 flex flex-col gap-3" id="chat-box">
            
            <div class="flex justify-start">
                <div class="bg-white border border-gray-200 text-gray-800 p-3 rounded-tr-lg rounded-br-lg rounded-bl-lg max-w-[80%] shadow-sm">
                    <p class="text-sm">გამარჯობა! რით შემიძლია დაგეხმაროთ დღეს? 🤖</p>
                </div>
            </div>

            <template x-for="(msg, index) in messages" :key="index">
                <div :class="msg.role === 'user' ? 'flex justify-end' : 'flex justify-start'">
                    <div :class="msg.role === 'user' 
                        ? 'bg-indigo-600 text-white rounded-tl-lg rounded-bl-lg rounded-br-lg' 
                        : 'bg-white border border-gray-200 text-gray-800 rounded-tr-lg rounded-br-lg rounded-bl-lg'"
                         class="p-3 max-w-[80%] shadow-sm">
                        <p class="text-sm" x-text="msg.content"></p>
                    </div>
                </div>
            </template>

            <div x-show="isLoading" x-cloak class="flex justify-start">
                <div class="bg-gray-200 p-3 rounded-lg flex gap-1 items-center">
                    <div class="w-2 h-2 bg-gray-500 rounded-full animate-bounce"></div>
                    <div class="w-2 h-2 bg-gray-500 rounded-full animate-bounce delay-75"></div>
                    <div class="w-2 h-2 bg-gray-500 rounded-full animate-bounce delay-150"></div>
                </div>
            </div>
        </div>

        <div class="p-4 bg-white border-t border-gray-200">
            <form @submit.prevent="sendMessage" class="flex gap-2">
                <input type="text" 
                       x-model="userInput" 
                       :disabled="isLoading"
                       placeholder="აკრიფეთ შეტყობინება..." 
                       class="flex-1 border border-gray-300 rounded-full px-4 py-2 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition disabled:opacity-50">
                
                <button type="submit" 
                        :disabled="isLoading || !userInput.trim()"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white rounded-full p-2 w-10 h-10 flex items-center justify-center transition disabled:opacity-50 disabled:cursor-not-allowed">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z" />
                    </svg>
                </button>
            </form>
        </div>
    </div>

    <script>
        function chatBot() {
            return {
                userInput: '',
                isLoading: false,
                messages: [], // ინახავს მიმდინარე სესიის ჩატს
                
                async sendMessage() {
                    if (this.userInput.trim() === '') return;

                    const text = this.userInput;
                    this.userInput = '';
                    
                    // ვამატებთ მომხმარებლის მესიჯს ვიზუალურად
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
                                history: this.messages // ვაგზავნით ისტორიას კონტექსტისთვის
                            })
                        });

                        if (!response.ok) throw new Error('Network error');

                        const data = await response.json();
                        
                        // ვამატებთ AI-ს პასუხს
                        this.messages.push({ role: 'assistant', content: data.reply });
                        
                    } catch (error) {
                        console.error(error);
                        this.messages.push({ role: 'assistant', content: 'დაფიქსირდა შეცდომა. სცადეთ მოგვიანებით.' });
                    } finally {
                        this.isLoading = false;
                        this.scrollToBottom();
                    }
                },

                scrollToBottom() {
                    setTimeout(() => {
                        const chatBox = document.getElementById('chat-box');
                        chatBox.scrollTop = chatBox.scrollHeight;
                    }, 50);
                }
            }
        }
    </script>
</body>
</html>