<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-bold text-2xl text-secondary-900 leading-tight animate-fade-in">
                    {{ __('Chat & Dukungan') }}
                </h2>
                <p class="text-sm text-secondary-600 mt-1">Komunikasi dengan admin perpustakaan dan AI Assistant</p>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('chat.ai-assistant') }}" class="btn-primary flex items-center">
                    <i class="fas fa-robot mr-2"></i>
                    AI Assistant
                </a>
                <button id="startChatBtn" class="btn-secondary flex items-center">
                    <i class="fas fa-plus mr-2"></i>
                    Chat Admin
                </button>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <!-- Chat List -->
            <div class="card animate-fade-in">
                <div class="card-header">
                    <h3 class="text-lg font-semibold text-secondary-900">Riwayat Chat dengan Admin</h3>
                    <p class="text-sm text-secondary-600 mt-1">Kelola percakapan Anda dengan admin perpustakaan</p>
                </div>
                <div class="card-body">
                    @if($adminChats->count() > 0)
                        <div class="space-y-4">
                            @foreach($adminChats as $chat)
                            <div class="flex items-center justify-between p-4 bg-secondary-50 rounded-xl hover:bg-secondary-100 transition-colors duration-200">
                                <div class="flex items-center space-x-4">
                                    <div class="w-12 h-12 bg-primary-100 rounded-full flex items-center justify-center">
                                        <i class="fas fa-user-tie text-primary-600 text-lg"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-secondary-900">Admin</h4>
                                        <p class="text-sm text-secondary-600">
                                            @if($chat->messages->count() > 0)
                                                {{ Str::limit($chat->messages->last()->message, 50) }}
                                            @else
                                                Belum ada pesan
                                            @endif
                                        </p>
                                        <p class="text-xs text-secondary-500">
                                            {{ $chat->last_message_at ? $chat->last_message_at->diffForHumans() : 'Belum aktif' }}
                                        </p>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-3">
                                    @if($chat->getUnreadCountForUser(auth()->id()) > 0)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-500 text-white">
                                            {{ $chat->getUnreadCountForUser(auth()->id()) }}
                                        </span>
                                    @endif
                                    <span class="px-3 py-1 text-xs font-medium rounded-full
                                        @if($chat->status === 'active') bg-green-100 text-green-800
                                        @else bg-gray-100 text-gray-800 @endif">
                                        {{ ucfirst($chat->status) }}
                                    </span>
                                    <a href="{{ route('chat.show', $chat) }}" class="btn-primary text-sm">
                                        Lihat Chat
                                    </a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-12">
                            <div class="w-24 h-24 bg-secondary-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-comments text-secondary-400 text-3xl"></i>
                            </div>
                            <h3 class="text-lg font-medium text-secondary-900 mb-2">Belum ada chat</h3>
                            <p class="text-secondary-600 mb-6">Mulai percakapan dengan admin perpustakaan untuk mendapatkan bantuan</p>
                            <button id="startFirstChatBtn" class="btn-primary">
                                <i class="fas fa-plus mr-2"></i>
                                Mulai Chat Baru
                            </button>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="card animate-fade-in" style="animation-delay: 0.1s">
                    <div class="card-header">
                        <h3 class="text-lg font-semibold text-secondary-900">AI Assistant</h3>
                    </div>
                    <div class="card-body text-center">
                        <div class="w-16 h-16 bg-accent-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-robot text-accent-600 text-2xl"></i>
                        </div>
                        <h4 class="font-medium text-secondary-900 mb-2">Bantuan Cepat 24/7</h4>
                        <p class="text-sm text-secondary-600 mb-4">Dapatkan jawaban instan untuk pertanyaan umum tentang perpustakaan</p>
                        <a href="{{ route('chat.ai-assistant') }}" class="btn-accent">
                            <i class="fas fa-robot mr-2"></i>
                            Buka AI Assistant
                        </a>
                    </div>
                </div>

                <div class="card animate-fade-in" style="animation-delay: 0.2s">
                    <div class="card-header">
                        <h3 class="text-lg font-semibold text-secondary-900">Chat dengan Admin</h3>
                    </div>
                    <div class="card-body text-center">
                        <div class="w-16 h-16 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-user-tie text-primary-600 text-2xl"></i>
                        </div>
                        <h4 class="font-medium text-secondary-900 mb-2">Dukungan Personal</h4>
                        <p class="text-sm text-secondary-600 mb-4">Chat langsung dengan admin atau staff perpustakaan untuk bantuan spesifik</p>
                        <button id="startAdminChatBtn" class="btn-primary">
                            <i class="fas fa-comments mr-2"></i>
                            Mulai Chat
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Start Chat Modal -->
    <div id="startChatModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-3xl shadow-xl max-w-md w-full">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-secondary-900 mb-4">Mulai Chat Baru</h3>
                    <form id="startChatForm">
                        @csrf
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-secondary-700 mb-2">Pesan Awal (Opsional)</label>
                            <textarea name="initial_message" rows="3" class="w-full border border-secondary-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary-500 focus:border-primary-500" placeholder="Jelaskan masalah atau pertanyaan Anda..."></textarea>
                        </div>
                        <div class="flex space-x-3">
                            <button type="button" id="cancelChatBtn" class="flex-1 btn-outline">Batal</button>
                            <button type="submit" class="flex-1 btn-primary">Mulai Chat</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Modal controls
        const modal = document.getElementById('startChatModal');
        const startChatBtn = document.getElementById('startChatBtn');
        const startFirstChatBtn = document.getElementById('startFirstChatBtn');
        const startAdminChatBtn = document.getElementById('startAdminChatBtn');
        const cancelChatBtn = document.getElementById('cancelChatBtn');

        [startChatBtn, startFirstChatBtn, startAdminChatBtn].forEach(btn => {
            if (btn) {
                btn.addEventListener('click', () => modal.classList.remove('hidden'));
            }
        });

        cancelChatBtn.addEventListener('click', () => modal.classList.add('hidden'));

        // Start chat form
        document.getElementById('startChatForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);

            fetch('/chat/start', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.chat_id) {
                    window.location.href = `/chat/${data.chat_id}`;
                } else if (data.error) {
                    alert(data.error);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan. Silakan coba lagi.');
            });
        });
    </script>
</x-app-layout>
