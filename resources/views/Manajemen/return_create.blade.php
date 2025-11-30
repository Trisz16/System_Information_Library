<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-bold text-2xl text-gray-900 leading-tight">
                    {{ __('Pengembalian Buku') }}
                </h2>
                <p class="text-sm text-gray-600 mt-1">Proses pengembalian buku perpustakaan</p>
            </div>
            <a href="{{ route('loans.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-lg font-semibold text-sm text-gray-700 uppercase tracking-widest hover:bg-gray-400 focus:bg-gray-400 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-all duration-200">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <!-- Loan Information -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Informasi Peminjaman</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="bg-blue-50 p-4 rounded-lg">
                            <h4 class="text-sm font-medium text-blue-600 uppercase tracking-wide mb-2">Anggota</h4>
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-8 w-8">
                                    <div class="h-8 w-8 rounded-full bg-blue-100 flex items-center justify-center">
                                        <span class="text-xs font-medium text-blue-600">{{ substr($loan->member->name, 0, 2) }}</span>
                                    </div>
                                </div>
                                <div class="ml-3">
                                    <div class="text-sm font-medium text-gray-900">{{ $loan->member->name }}</div>
                                    <div class="text-sm text-gray-500">LIB-{{ str_pad($loan->member->id, 4, '0', STR_PAD_LEFT) }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-green-50 p-4 rounded-lg">
                            <h4 class="text-sm font-medium text-green-600 uppercase tracking-wide mb-2">Buku</h4>
                            <div class="text-sm text-gray-900">{{ $loan->book->title }}</div>
                            <div class="text-sm text-gray-600">oleh {{ $loan->book->author }}</div>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h4 class="text-sm font-medium text-gray-600 uppercase tracking-wide mb-2">Tanggal Pinjam</h4>
                            <div class="text-sm text-gray-900">{{ $loan->loan_date->format('d M Y') }}</div>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h4 class="text-sm font-medium text-gray-600 uppercase tracking-wide mb-2">Tanggal Kembali</h4>
                            <div class="text-sm text-gray-900">{{ $loan->due_date->format('d M Y') }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Return Form -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('loans.return', $loan) }}" method="POST">
                        @csrf

                        <div class="space-y-6">
                            <!-- Tanggal Pengembalian -->
                            <div>
                                <x-input-label for="return_date" :value="__('Tanggal Pengembalian')" />
                                <x-text-input id="return_date" name="return_date" type="date" class="mt-1 block w-full" :value="old('return_date', date('Y-m-d'))" required />
                                <x-input-error :messages="$errors->get('return_date')" class="mt-2" />
                            </div>

                            <!-- Status Pengembalian -->
                            <div>
                                <x-input-label :value="__('Status Pengembalian')" />
                                <div class="mt-2">
                                    @php
                                        $isLate = $loan->due_date->isBefore(now()->startOfDay());
                                        $daysLate = $isLate ? ceil($loan->due_date->diffInDays(now()->startOfDay(), false)) : 0;
                                        $fineAmount = $daysLate * 5000; // Rp 5,000 per day
                                    @endphp
                                    @if($isLate)
                                        <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                                            <div class="flex items-center">
                                                <svg class="w-5 h-5 text-red-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                                </svg>
                                                <div>
                                                    <h4 class="text-sm font-medium text-red-800">Pengembalian Terlambat</h4>
                                                    <p class="text-sm text-red-600">Terlambat {{ $daysLate }} hari. Denda otomatis: Rp {{ number_format($fineAmount, 0, ',', '.') }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                                            <div class="flex items-center">
                                                <svg class="w-5 h-5 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                <div>
                                                    <h4 class="text-sm font-medium text-green-800">Tepat Waktu</h4>
                                                    <p class="text-sm text-green-600">Buku dikembalikan tepat waktu.</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Denda -->
                            <div>
                                <x-input-label for="fine" :value="__('Denda (Rp)')" />
                                <x-text-input id="fine" name="fine" type="number" class="mt-1 block w-full" :value="old('fine', $isLate ? $fineAmount : 0)" min="0" step="1000" />
                                <p class="mt-1 text-sm text-gray-500">Kosongkan jika tidak ada denda tambahan</p>
                                <x-input-error :messages="$errors->get('fine')" class="mt-2" />
                            </div>

                            <!-- Catatan -->
                            <div>
                                <x-input-label for="notes" :value="__('Catatan')" />
                                <textarea id="notes" name="notes" rows="3" class="mt-1 block w-full border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm" placeholder="Catatan pengembalian...">{{ old('notes') }}</textarea>
                                <x-input-error :messages="$errors->get('notes')" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-8">
                            <a href="{{ route('loans.index') }}" class="mr-4 inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-lg font-semibold text-sm text-gray-700 uppercase tracking-widest hover:bg-gray-400 focus:bg-gray-400 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-all duration-200">
                                Batal
                            </a>

                            <x-primary-button>
                                {{ __('Proses Pengembalian') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
