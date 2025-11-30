<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-bold text-2xl text-secondary-900 leading-tight animate-fade-in">
                    {{ __('Chat Support') }}
                </h2>
                <p class="text-sm text-secondary-600 mt-1">Kelola percakapan dengan mahasiswa</p>
            </div>
            <div class="flex items-center space-x-4">
                <div class="bg-secondary-100 px-4 py-2 rounded-lg">
                    <span class="text-sm text-secondary-600">Chat Aktif:</span>
                    <span class="font-semibold text-secondary-900">{{ $activeChats->count() }}</span>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Active Chats -->
            <div class="card animate-fade-in">
                <div class="card-header">
                    <h3 class="text-lg font-semibold text-secondary-900">Chat Aktif</h3>
                    <p class="text-sm text-secondary-600 mt-1">Percakapan yang sedang berlangsung dengan mahasiswa</p>
                </div>
                <div class="card-body">
                    @if($activeChats->count() > 0)
                        <div class="space-y-4">
                            @foreach($activeChats as $chat)
                            <div class="flex items-center justify-between p-4 bg-secondary-50 rounded-xl hover:bg-secondary-100 transition-colors duration-200">
                                <div class="flex items-center space-x-4">
                                    <div class="w-12 h-12 bg-accent-100 rounded-full flex items-center justify-center">
                                        <i class="fas fa-user-graduate text-accent-600 text-lg"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-secondary-900">{{ $chat->student->name }}</h4>
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
                                    <span class="px-3 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">
                                        Aktif
                                    </span>
                                    <a href="{{ route('chat.show', $chat) }}" class="btn-primary text-sm">
                                        Balas Chat
                                    </a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-12">
                            <div class="w-24 h-24 bg-secondary-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-inbox text-secondary-400 text-3xl"></i>
                            </div>
                            <h3 class="text-lg font-medium text-secondary-900 mb-2">Tidak ada chat aktif</h3>
                            <p class="text-secondary-600">Belum ada mahasiswa yang memulai percakapan</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
                <div class="card animate-fade-in" style="animation-delay: 0.1s">
                    <div class="card-body text-center">
                        <div class="w-12 h-12 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-comments text-primary-600 text-xl"></i>
                        </div>
                        <div class="text-2xl font-bold text-secondary-900">{{ $activeChats->count() }}</div>
                        <div class="text-sm text-secondary-600">Chat Aktif</div>
                    </div>
                </div>

                <div class="card animate-fade-in" style="animation-delay: 0.2s">
                    <div class="card-body text-center">
                        <div class="w-12 h-12 bg-accent-100 rounded-full flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-clock text-accent-600 text-xl"></i>
                        </div>
                        <div class="text-2xl font-bold text-secondary-900">
                            {{ \App\Models\Chat::where('type', 'admin_chat')->where('status', 'active')->count() }}
                        </div>
                        <div class="text-sm text-secondary-600">Total Chat Hari Ini</div>
                    </div>
                </div>

                <div class="card animate-fade-in" style="animation-delay: 0.3s">
                    <div class="card-body text-center">
                        <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-check-circle text-green-600 text-xl"></i>
                        </div>
                        <div class="text-2xl font-bold text-secondary-900">
                            {{ \App\Models\Chat::where('type', 'admin_chat')->where('status', 'closed')->whereDate('updated_at', today())->count() }}
                        </div>
                        <div class="text-sm text-secondary-600">Chat Diselesaikan</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
