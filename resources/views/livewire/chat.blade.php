<div class="grid grid-cols-1 md:grid-cols-6 h-screen fixed top-20 md:top-28 bottom-0 left-0 right-0">

    <!-- Sidebar de usuários -->
    <div class="md:col-span-1 border-r-2 border-gray-500 overflow-y-auto bg-gray-900 p-4 hidden md:block">
        <ul class="flex flex-col gap-4">

            @foreach ($users as $user)

                <li>
                    <div class="flex items-center gap-4 p-3 w-full bg-gray-800 hover:bg-gray-700 rounded-lg cursor-pointer">
                        <div class="relative">
                            <img class="w-10 h-10 rounded-full" src="{{ asset('/img/user.jpeg') }}" alt="User Image">
                            <span
                                class="top-0 left-7 absolute  w-3.5 h-3.5 {{ $user->status == 1 ? "bg-green-400" : "bg-gray-400"  }} border-2 border-white dark:border-gray-800 rounded-full"></span>
                        </div>
                        <div>
                            <div class="font-medium text-gray-100">{{ $user->name }}</div>
                            <div class="text-sm text-gray-100">
                                {{ $user->status == 1 ? 'Online' : 'Offiline' }}
                            </div>
                        </div>
                    </div>
                </li>
            @endforeach

        </ul>
    </div>


    <div class="md:col-span-5 flex flex-col pb-40 md:pb-20 lg:2  h-screen">

        <!-- Mensagens -->
        <div id="chatContainer" class="h-[700px] overflow-auto p-4 bg-gray-900">
            @foreach ($mensagens as $m)
                @php $isCurrentUser = $m->user_id === auth()->id(); @endphp

                <div class="flex flex-col gap-4">
                    <div class="flex items-start gap-2.5 mb-5 {{ $isCurrentUser ? 'self-end flex-row-reverse' : '' }}">
                        <div class="relative">
                            <img class="w-8 h-8 rounded-full" src="{{ asset('/img/user.jpeg') }}" alt="User Image">

                            <span
                                class="top-0 left-7 absolute  w-3.5 h-3.5 {{ $m->user->status == 1 ? "bg-green-400" : "bg-gray-400"  }} border-2 border-white dark:border-gray-800 rounded-full"></span>

                        </div>

                        <div class="flex flex-col gap-1 max-w-[90%] sm:max-w-[320px]">
                            <div
                                class="flex items-center space-x-2 {{ $isCurrentUser ? 'self-end flex-row-reverse' : '' }}">
                                <span
                                    class="text-sm font-semibold ml-2 text-gray-300 {{ $isCurrentUser ? 'mx-2' : ''  }}">{{ $m->user->name }}</span>
                                <span class="text-sm text-gray-400">{{ $m->created_at->format('H:i') }}</span>
                            </div>
                            <div class="p-3 rounded-lg {{ $isCurrentUser ? 'bg-gray-600 text-start' : 'bg-gray-600' }}">
                                <p class="text-sm text-white">{{ $m->mensagem }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <!-- Fim Mensagens -->

        <!-- input -->

        <div class="fixed bottom-0 left-0 right-0 bg-gray-900 p-3 border-t border-gray-400 shadow-md">
            <div class="flex items-center px-3 py-2 rounded-lg">
                <textarea wire:keydown.enter="enviarMensagem" wire:model="mensagem"
                    class="w-full p-2.5 text-gray-50 text-sm bg-gray-800 border rounded-lg focus:ring-gray-500 focus:border-gray-500"
                    placeholder="Sua mensagem..."></textarea>

                <button wire:click="enviarMensagem"
                    class="p-2 text-gray-400 rounded-full hover:bg-gray-400 hover:text-gray-500">
                    <svg class="w-5 h-5 rotate-90" viewBox="0 0 18 20" fill="currentColor">
                        <path
                            d="m17.914 18.594-8-18a1 1 0 0 0-1.828 0l-8 18a1 1 0 0 0 1.157 1.376L8 18.281V9a1 1 0 0 1 2 0v9.281l6.758 1.689a1 1 0 0 0 1.156-1.376Z" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Fim input -->

    </div>

</div>

<!-- Script para rolagem automática -->
<script>
    function scrollToBottom(force = false) {
        var chatContainer = document.getElementById('chatContainer');
        var isScrolledToBottom = chatContainer.scrollHeight - chatContainer.clientHeight <= chatContainer.scrollTop + 50;

        if (isScrolledToBottom || force) {
            chatContainer.scrollTop = chatContainer.scrollHeight;
        }
    }

    document.addEventListener("DOMContentLoaded", function () {
        scrollToBottom(true);
    });

    document.addEventListener("livewire:load", function () {
        scrollToBottom(true);
    });

    document.addEventListener("livewire:update", function () {
        scrollToBottom();
    });

    const observer = new MutationObserver(() => {
        scrollToBottom();
    });

    observer.observe(document.getElementById('chatContainer'), { childList: true, subtree: true });

</script>