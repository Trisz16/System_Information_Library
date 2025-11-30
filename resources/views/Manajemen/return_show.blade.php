<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-bold text-2xl text-gray-900 leading-tight">
                    {{ __('Detail Pengembalian') }}
                </h2>
                <p class="text-sm text-gray-600 mt-1">Informasi lengkap pengembalian buku</p>
            </div>
            <a href="{{ route('Manajemen/Pengembalian') }}" class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-lg font-semibold text-sm text-gray-700 uppercase tracking-widest hover:bg-gray-400 focus:bg-gray-400 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-all duration-200">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Return Information -->
                        <div class="space-y-6">
                            <div>
                                <h3 class="text-lg font-medium text-gray-900 mb-4">Informasi Pengembalian</h3>
                                <div class="space-y-3">
                                    <div class="flex justify-between">
                                        <span class="text-sm font-medium text-gray-500">ID Pengembalian:</span>
                                        <span class="text-sm text-gray-900">R-{{ str_pad($loan->id, 4, '0', STR_PAD_LEFT) }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-sm font-medium text-gray-500">Tanggal Pinjam:</span>
                                        <span class="text-sm text-gray-900">{{ $loan->loan_date->format('d M Y') }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-sm font-medium text-gray-500">Tanggal Kembali:</span>
                                        <span class="text-sm text-gray-900">{{ $loan->due_date->format('d M Y') }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-sm font-medium text-gray-500">Tanggal Dikembalikan:</span>
                                        <span class="text-sm text-gray-900">{{ $loan->return_date->format('d M Y') }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-sm font-medium text-gray-500">Status:</span>
                                        @if($loan->fine > 0)
                                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">Dengan Denda</span>
                                        @elseif($loan->return_date <= $loan->due_date)
                                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Tepat Waktu</span>
                                        @else
                                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">Terlambat</span>
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

                    <!-- Return Timeline -->
                    <div class="mt-8">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Timeline Pengembalian</h3>
                        <div class="bg-gray-50 rounded-lg p-6">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0">
                                        <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <p class="text-sm font-medium text-gray-900">Peminjaman Dibuat</p>
                                        <p class="text-sm text-gray-500">{{ $loan->loan_date->format('d M Y H:i') }}</p>
                                    </div>
                                </div>
                                <div class="text-sm text-gray-500">Tanggal Pinjam</div>
                            </div>

                            <div class="mt-4 flex items-center">
                                <div class="flex-1 border-t border-gray-300"></div>
                            </div>

                            <div class="mt-4 flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0">
                                        <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                                            <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <p class="text-sm font-medium text-gray-900">Buku Dikembalikan</p>
                                        <p class="text-sm text-gray-500">{{ $loan->return_date->format('d M Y H:i') }}</p>
                                        @if($loan->fine > 0)
                                        <p class="text-sm text-red-600">Denda: Rp {{ number_format($loan->fine, 0, ',', '.') }}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="text-sm text-gray-500">Tanggal Kembali</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
