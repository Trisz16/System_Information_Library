<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div class="flex items-center space-x-4">
                <a href="{{ route('chat.index') }}" class="btn-outline">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Kembali
                </a>
                <div>
                    <h2 class="font-bold text-2xl text-secondary-900 leading-tight">
                        @if($chat->isAdminChat())
                            Chat dengan Admin
                        @else
                            AI Assistant
                        @endif
                    </h2>
                    <p class="text-sm text-secondary-600 mt-1">
                        Status: <span class="px-2 py-1 text-xs font-medium rounded-full
                            @if($chat->status === 'active') bg-green-100 text-green-800
                            @else bg-gray-100 text-gray-800 @endif">
                            {{ ucfirst($chat->status) }}
                        </span>
                    </p>
                </div>
            </div>
            @if(auth()->user()->isAdminOrStaff() && $chat->isAdminChat())
            <button id="closeChatBtn" class="btn-outline text-red-600 border-red-300 hover:bg-red-50">
                <i class="fas fa-times mr-2"></i>
                Tutup Chat
            </button>
            @endif
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="card">
                <div class="card-body p-0">
                    <!-- Messages Container -->
                    <div id="messagesContainer" class="h-96 overflow-y-auto p-6 space-y-4">
                        @forelse($messages as $message)
                        <div class="flex {{ $message->sender_id === auth()->id() ? 'justify-end' : 'justify-start' }}">
                            <div class="max-w-xs lg:max-w-md px-4 py-2 rounded-2xl
                                {{ $message->sender_id === auth()->id()
                                    ? 'bg-primary-500 text-white'
                                    : ($message->isFromChatbot()
                                        ? 'bg-accent-100 text-accent-900'
                                        : 'bg-secondary-100 text-secondary-900') }}">

                                @if($message->isFromChatbot())
                                <div class="flex items-center mb-1">
                                    <i class="fas fa-robot text-accent-600 mr-2"></i>
                                    <span class="text-xs font-medium text-accent-700">AI Assistant</span>
                                </div>
                                @elseif($message->isFromAdmin() && auth()->user()->isMahasiswa())
                                <div class="flex items-center mb-1">
                                    <i class="fas fa-user-tie text-primary-600 mr-2"></i>
                                    <span class="text-xs font-medium text-primary-700">Admin</span>
                                </div>
                                @elseif($message->isFromStaff() && auth()->user()->isMahasiswa())
                                <div class="flex items-center mb-1">
                                    <i class="fas fa-user-tie text-primary-600 mr-2"></i>
                                    <span class="text-xs font-medium text-primary-700">Admin</span>
                                </div>
                                @endif

                                <p class="text-sm">{{ $message->message }}</p>

                                <div class="text-xs mt-1 opacity-75">
                                    <span id="time-{{ $message->id }}" data-timestamp="{{ $message->created_at->toISOString() }}">{{ $message->created_at->format('H:i') }}</span>
                                    @if($message->sender_id === auth()->id())
                                        <i class="fas fa-check ml-1"></i>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-8">
                            <div class="w-16 h-16 bg-secondary-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-comments text-secondary-400 text-2xl"></i>
                            </div>
                            <p class="text-secondary-600">Belum ada pesan. Mulai percakapan!</p>
                        </div>
                        @endforelse
                    </div>

                    <!-- Message Input -->
                    @if($chat->status === 'active')
                    <div class="border-t border-secondary-200 p-4">
                        <form id="messageForm" class="flex space-x-4">
                            @csrf
                            <input type="hidden" name="chat_id" value="{{ $chat->id }}">
                            <div class="flex-1">
                                <input type="text" id="messageInput" name="message"
                                       class="w-full border border-secondary-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                                       placeholder="Ketik pesan Anda..." required>
                            </div>
                            <button type="submit" class="btn-primary px-6">
                                <i class="fas fa-paper-plane mr-2"></i>
                                Kirim
                            </button>
                        </form>
                    </div>
                    @else
                    <div class="border-t border-secondary-200 p-4 bg-secondary-50">
                        <div class="text-center text-secondary-600">
                            <i class="fas fa-lock text-xl mb-2"></i>
                            <p>Chat ini telah ditutup dan tidak dapat menerima pesan baru.</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        const messagesContainer = document.getElementById('messagesContainer');
        const messageForm = document.getElementById('messageForm');
        const messageInput = document.getElementById('messageInput');
        const closeChatBtn = document.getElementById('closeChatBtn');

        // Auto scroll to bottom
        function scrollToBottom() {
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
        }

        // Scroll to bottom on load
        scrollToBottom();

        // Send message
        messageForm.addEventListener('submit', function(e) {
            e.preventDefault();

            const message = messageInput.value.trim();
            if (!message) return;

            const formData = new FormData(this);

            fetch(`/chat/{{ $chat->id }}/message`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    messageInput.value = '';
                    // Add message to UI (we'll implement real-time later)
                    location.reload();
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan. Silakan coba lagi.');
            });
        });

        // Close chat (admin only)
        if (closeChatBtn) {
            closeChatBtn.addEventListener('click', function() {
                if (confirm('Apakah Anda yakin ingin menutup chat ini?')) {
                    fetch(`/chat/{{ $chat->id }}/close`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            location.reload();
                        }
                    })
                    .catch(error => console.error('Error:', error));
                }
            });
        }

        // Update time every second for real-time display
        function updateTimes() {
            const now = new Date();
            const timeElements = document.querySelectorAll('[id^="time-"]');

            timeElements.forEach(element => {
                const messageId = element.id.replace('time-', '');
                const messageTime = new Date(element.dataset.timestamp);
                const diffMs = now - messageTime;
                const diffMins = Math.floor(diffMs / 60000);
                const diffHours = Math.floor(diffMs / 3600000);
                const diffDays = Math.floor(diffMs / 86400000);

                let displayTime;
                if (diffMins < 1) {
                    displayTime = 'Baru saja';
                } else if (diffMins < 60) {
                    displayTime = diffMins + ' menit lalu';
                } else if (diffHours < 24) {
                    displayTime = diffHours + ' jam lalu';
                } else if (diffDays < 7) {
                    displayTime = diffDays + ' hari lalu';
                } else {
                    displayTime = messageTime.toLocaleDateString('id-ID', {
                        day: 'numeric',
                        month: 'short',
                        hour: '2-digit',
                        minute: '2-digit'
                    });
                }

                element.textContent = displayTime;
            });
        }

        // Update times immediately and then every minute
        updateTimes();
        setInterval(updateTimes, 60000); // Update every minute

        // Auto refresh messages every 5 seconds (temporary until WebSocket)
        setInterval(function() {
            // We'll implement WebSocket later for real-time updates
        }, 5000);
    </script>
</x-app-layout>
