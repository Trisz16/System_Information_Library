<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-bold text-2xl text-gray-900 leading-tight">
                    {{ __('Detail Peminjaman') }}
                </h2>
                <p class="text-sm text-gray-600 mt-1">Informasi lengkap peminjaman buku</p>
            </div>
            <div class="flex space-x-3">
                @if(Auth::user() && in_array(Auth::user()->role, ['admin', 'staff']))
                <a href="{{ route('loans.edit', $loan) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-lg font-semibold text-sm text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Edit
                </a>
                @endif
                <a href="{{ route('loans.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-lg font-semibold text-sm text-gray-700 uppercase tracking-widest hover:bg-gray-400 focus:bg-gray-400 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-all duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Loan Information -->
                        <div class="space-y-6">
                            <div>
                                <h3 class="text-lg font-medium text-gray-900 mb-4">Informasi Peminjaman</h3>
                                <div class="space-y-3">
                                    <div class="flex justify-between">
                                        <span class="text-sm font-medium text-gray-500">ID Peminjaman:</span>
                                        <span class="text-sm text-gray-900">L-{{ str_pad($loan->id, 4, '0', STR_PAD_LEFT) }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-sm font-medium text-gray-500">Tanggal Pinjam:</span>
                                        <span class="text-sm text-gray-900">{{ $loan->loan_date->format('d M Y') }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-sm font-medium text-gray-500">Tanggal Kembali:</span>
                                        <span class="text-sm text-gray-900">{{ $loan->due_date->format('d M Y') }}</span>
                                    </div>
                                    @if($loan->return_date)
                                    <div class="flex justify-between">
                                        <span class="text-sm font-medium text-gray-500">Tanggal Dikembalikan:</span>
                                        <span class="text-sm text-gray-900">{{ $loan->return_date->format('d M Y') }}</span>
                                    </div>
                                    @endif
                                    <div class="flex justify-between">
                                        <span class="text-sm font-medium text-gray-500">Status:</span>
                                        @if($loan->status == 'active')
                                            @if($loan->due_date < now())
                                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">Terlambat</span>
                                            @else
                                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Aktif</span>
                                            @endif
                                        @elseif($loan->status == 'returned')
                                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">Dikembalikan</span>
                                        @else
                                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">{{ ucfirst($loan->status) }}</span>
                                        @endif
                                    </div>
                                    @if($loan->fine > 0)
                                    <div class="flex justify-between">
                                        <span class="text-sm font-medium text-gray-500">Denda:</span>
                                        <span class="text-sm text-red-600 font-semibold">Rp {{ number_format($loan->fine, 0, ',', '.') }}</span>
                                    </div>
                                    @endif
                                </div>
                            </div>

                            @if($loan->notes)
                            <div>
                                <h4 class="text-sm font-medium text-gray-500 uppercase tracking-wide mb-2">Catatan</h4>
                                <p class="text-gray-900 bg-gray-50 p-3 rounded-lg">{{ $loan->notes }}</p>
                            </div>
                            @endif
                        </div>

                        <!-- Member and Book Information -->
                        <div class="space-y-6">
                            <!-- Member Info -->
                            <div>
                                <h3 class="text-lg font-medium text-gray-900 mb-4">Informasi Anggota</h3>
                                <div class="bg-blue-50 p-4 rounded-lg">
                                    <div class="flex items-center mb-3">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center">
                                                <span class="text-sm font-medium text-blue-600">{{ substr($loan->member->name, 0, 2) }}</span>
                                            </div>
                                        </div>
                                        <div class="ml-3">
                                            <div class="text-sm font-medium text-gray-900">{{ $loan->member->name }}</div>
                                            <div class="text-sm text-gray-500">LIB-{{ str_pad($loan->member->id, 4, '0', STR_PAD_LEFT) }}</div>
                                        </div>
                                    </div>
                                    <div class="text-sm text-gray-600">
                                        <p>{{ $loan->member->email }}</p>
                                        @if($loan->member->phone)
                                        <p>{{ $loan->member->phone }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Book Info -->
                            <div>
                                <h3 class="text-lg font-medium text-gray-900 mb-4">Informasi Buku</h3>
                                <div class="bg-green-50 p-4 rounded-lg">
                                    <div class="mb-3">
                                        <h4 class="text-sm font-medium text-gray-900">{{ $loan->book->title }}</h4>
                                        <p class="text-sm text-gray-600">oleh {{ $loan->book->author }}</p>
                                    </div>
                                    <div class="text-sm text-gray-600">
                                        <p>ISBN: {{ $loan->book->isbn ?? 'N/A' }}</p>
                                        <p>Kategori: {{ $loan->book->category->name ?? 'N/A' }}</p>
                                        <p>Penerbit: {{ $loan->book->publisher ?? 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    @if(Auth::user() && in_array(Auth::user()->role, ['admin', 'staff']))
                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <div class="flex justify-end space-x-3">
                            @if($loan->status == 'active')
                            <form action="{{ route('returns.create', ['loan' => $loan->id]) }}" method="GET" class="inline">
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-lg font-semibold text-sm text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-all duration-200">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Kembalikan Buku
                                </button>
                            </form>
                            @endif
                            <a href="{{ route('loans.edit', $loan) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-lg font-semibold text-sm text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                Edit Peminjaman
                            </a>
                            <form action="{{ route('loans.destroy', $loan) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus peminjaman ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-lg font-semibold text-sm text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-all duration-200">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                    Hapus Peminjaman
                                </button>
                            </form>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
