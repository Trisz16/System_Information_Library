<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-bold text-2xl text-amber-800 leading-tight">
                    {{ __('Manajemen Peminjaman') }}
                </h2>
                <p class="text-sm text-amber-600 mt-1">Kelola peminjaman buku perpustakaan Azfakun</p>
            </div>
            @if(Auth::user() && in_array(Auth::user()->role, ['admin', 'staff']))
            <div class="flex space-x-3">
                <a href="{{ route('loans.create') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-amber-600 to-amber-700 border border-transparent rounded-xl font-semibold text-sm text-white uppercase tracking-widest hover:from-amber-700 hover:to-amber-800 focus:from-amber-700 focus:to-amber-800 active:bg-amber-900 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Peminjaman Baru
                </a>
                <a href="{{ route('notifications.index') }}" class="inline-flex items-center px-4 py-3 bg-yellow-100 border border-yellow-300 rounded-xl font-semibold text-sm text-yellow-800 uppercase tracking-widest hover:bg-yellow-200 focus:bg-yellow-200 active:bg-yellow-300 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition-all duration-200 shadow-md hover:shadow-lg">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5v-5z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.868 12.683A17.925 17.925 0 0112 21c7.962 0 12-1.21 12-2.683m-12 2.683a17.925 17.925 0 01-7.132-8.317M12 21V9m0 0l4-4m-4 4L8 5"></path>
                    </svg>
                    Notifikasi
                    @php
                        $unreadCount = \App\Models\Notification::unread()->count();
                    @endphp
                    @if($unreadCount > 0)
                        <span class="ml-2 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-red-500 rounded-full">{{ $unreadCount }}</span>
                    @endif
                </a>
            </div>
            @endif
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Search and Filter Section -->
            <div class="bg-gradient-to-r from-amber-50 to-yellow-50 overflow-hidden shadow-lg sm:rounded-xl mb-6 border border-amber-100">
                <div class="p-6">
                    <form method="GET" action="{{ route('loans.index') }}" class="flex flex-col md:flex-row md:items-center md:justify-between">
                        <div class="mb-4 md:mb-0">
                            <h3 class="text-lg font-semibold text-amber-800">Daftar Peminjaman</h3>
                            <p class="text-sm text-amber-600">Kelola peminjaman buku perpustakaan</p>
                        </div>
                        <div class="flex flex-col sm:flex-row gap-4">
                            <div class="relative">
                                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari peminjaman..." class="w-full sm:w-64 pl-10 pr-4 py-3 border border-amber-300 rounded-xl focus:ring-2 focus:ring-amber-500 focus:border-amber-500 bg-white shadow-sm transition-all duration-200">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <select name="status" class="px-4 py-3 border border-amber-300 rounded-xl focus:ring-2 focus:ring-amber-500 focus:border-amber-500 bg-white shadow-sm transition-all duration-200">
                                <option value="">Semua Status</option>
                                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Menunggu Persetujuan</option>
                                <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Disetujui</option>
                                <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                                <option value="returned" {{ request('status') == 'returned' ? 'selected' : '' }}>Dikembalikan</option>
                            </select>
                            <button type="submit" class="px-6 py-3 bg-gradient-to-r from-amber-600 to-amber-700 text-white rounded-xl hover:from-amber-700 hover:to-amber-800 focus:ring-2 focus:ring-amber-500 focus:ring-offset-2 shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </button>
                            @if(request('search') || request('status'))
                                <a href="{{ route('loans.index') }}" class="px-6 py-3 bg-gradient-to-r from-gray-500 to-gray-600 text-white rounded-xl hover:from-gray-600 hover:to-gray-700 focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 shadow-md hover:shadow-lg transform hover:scale-105 transition-all duration-200">
                                    Reset
                                </a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>

            <!-- Loans Table -->
            <div class="bg-white overflow-hidden shadow-2xl sm:rounded-xl border border-amber-100">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-amber-200">
                        <thead class="bg-gradient-to-r from-amber-50 to-yellow-50">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-amber-700 uppercase tracking-wider">ID Peminjaman</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-amber-700 uppercase tracking-wider">Anggota</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-amber-700 uppercase tracking-wider">Buku</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-amber-700 uppercase tracking-wider">Tanggal Pinjam</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-amber-700 uppercase tracking-wider">Tanggal Kembali</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-amber-700 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-amber-700 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-amber-100">
                            @forelse($loans ?? [] as $loan)
                            <tr class="hover:bg-gradient-to-r hover:from-amber-50 hover:to-yellow-50 transition-all duration-200 transform hover:scale-[1.01]">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-amber-800">L-{{ str_pad($loan->id, 4, '0', STR_PAD_LEFT) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <div class="h-10 w-10 rounded-full bg-gradient-to-r from-amber-100 to-yellow-100 flex items-center justify-center shadow-md">
                                                <span class="text-sm font-semibold text-amber-700">{{ substr($loan->member->name, 0, 2) }}</span>
                                            </div>
                                        </div>
                                        <div class="ml-3">
                                            <div class="text-sm font-semibold text-amber-800">{{ $loan->member->name }}</div>
                                            <div class="text-sm text-amber-600">LIB-{{ str_pad($loan->member->id, 4, '0', STR_PAD_LEFT) }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-amber-800">{{ $loan->book->title }}</div>
                                    <div class="text-sm text-amber-600">{{ $loan->book->isbn ?? 'No ISBN' }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-amber-800">{{ $loan->loan_date->format('d M Y') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-amber-800">{{ $loan->due_date->format('d M Y') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($loan->status == 'pending')
                                        <span class="inline-flex items-center px-3 py-1.5 text-xs font-bold rounded-full bg-gradient-to-r from-yellow-100 to-yellow-200 text-yellow-800 border border-yellow-300 shadow-sm">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                            </svg>
                                            Menunggu Persetujuan
                                        </span>
                                    @elseif($loan->status == 'approved')
                                        @if($loan->isOverdue())
                                            <span class="inline-flex items-center px-3 py-1.5 text-xs font-bold rounded-full bg-gradient-to-r from-red-100 to-red-200 text-red-800 border border-red-300 shadow-sm">
                                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                                </svg>
                                                Terlambat
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-3 py-1.5 text-xs font-bold rounded-full bg-gradient-to-r from-green-100 to-green-200 text-green-800 border border-green-300 shadow-sm">
                                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                                </svg>
                                                Disetujui
                                            </span>
                                        @endif
                                    @elseif($loan->status == 'rejected')
                                        <span class="inline-flex items-center px-3 py-1.5 text-xs font-bold rounded-full bg-gradient-to-r from-red-100 to-red-200 text-red-800 border border-red-300 shadow-sm">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                            </svg>
                                            Ditolak
                                        </span>
                                    @elseif($loan->status == 'returned')
                                        <span class="inline-flex items-center px-3 py-1.5 text-xs font-bold rounded-full bg-gradient-to-r from-gray-100 to-gray-200 text-gray-800 border border-gray-300 shadow-sm">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                            </svg>
                                            Dikembalikan
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-3 py-1.5 text-xs font-bold rounded-full bg-gradient-to-r from-gray-100 to-gray-200 text-gray-800 border border-gray-300 shadow-sm">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                                            </svg>
                                            {{ ucfirst($loan->status) }}
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex flex-wrap gap-2">
                                        @if(Auth::user() && in_array(Auth::user()->role, ['admin', 'staff']))
                                            @if($loan->status == 'pending')
                                                <div class="flex items-center space-x-2">
                                                <form method="POST" action="{{ route('loans.approve', $loan) }}" class="inline-flex">
                                                        @csrf
                                                        <input type="text" name="notes" class="w-full sm:w-40 pl-3 pr-3 py-2 border border-amber-300 rounded-xl focus:ring-2 focus:ring-amber-500 focus:border-amber-500 bg-white shadow-sm transition-all duration-200" placeholder="Catatan (opsional)">
                                                        <button type="submit" class="ml-2 inline-flex items-center px-3 py-2 text-xs font-bold rounded-xl bg-gradient-to-r from-green-500 to-green-600 text-white hover:from-green-600 hover:to-green-700 focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105">
                                                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                            </svg>
                                                            Setujui
                                                        </button>
                                                    </form>
                                                    <form method="POST" action="{{ route('loans.reject', $loan) }}" class="inline-flex">
                                                        @csrf
                                                        <input type="text" name="notes" class="w-full sm:w-40 pl-3 pr-3 py-2 border border-amber-300 rounded-xl focus:ring-2 focus:ring-amber-500 focus:border-amber-500 bg-white shadow-sm transition-all duration-200" placeholder="Catatan (opsional)">
                                                        <button type="submit" class="ml-2 inline-flex items-center px-3 py-2 text-xs font-bold rounded-xl bg-gradient-to-r from-red-500 to-red-600 text-white hover:from-red-600 hover:to-red-700 focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105">
                                                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                            </svg>
                                                            Tolak
                                                        </button>
                                                    </form>
                                                </div>
                                            @elseif($loan->status == 'approved')
                                                <a href="{{ route('loans.show', $loan) }}" class="inline-flex items-center px-4 py-2 text-xs font-bold rounded-xl bg-gradient-to-r from-blue-500 to-blue-600 text-white hover:from-blue-600 hover:to-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105">
                                                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                    </svg>
                                                    Lihat
                                                </a>
                                                <a href="{{ route('loans.edit', $loan) }}" class="inline-flex items-center px-4 py-2 text-xs font-bold rounded-xl bg-gradient-to-r from-yellow-500 to-yellow-600 text-white hover:from-yellow-600 hover:to-yellow-700 focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105">
                                                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                    </svg>
                                                    Edit
                                                </a>
                                                <form method="POST" action="{{ route('loans.destroy', $loan) }}" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus peminjaman ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="inline-flex items-center px-4 py-2 text-xs font-bold rounded-xl bg-gradient-to-r from-red-500 to-red-600 text-white hover:from-red-600 hover:to-red-700 focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105">
                                                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                        </svg>
                                                        Hapus
                                                    </button>
                                                </form>
                                                <form method="POST" action="{{ route('loans.return', $loan) }}" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin mengembalikan buku ini? Denda akan dihitung otomatis jika terlambat.')">
                                                    @csrf
                                                    <input type="hidden" name="return_date" value="{{ date('Y-m-d') }}">
                                                    <button type="submit" class="inline-flex items-center px-4 py-2 text-xs font-bold rounded-xl bg-gradient-to-r from-purple-500 to-purple-600 text-white hover:from-purple-600 hover:to-purple-700 focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105">
                                                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                        </svg>
                                                        Kembalikan
                                                    </button>
                                                </form>
                                            @else
                                                <a href="{{ route('loans.show', $loan) }}" class="inline-flex items-center px-4 py-2 text-xs font-bold rounded-xl bg-gradient-to-r from-gray-500 to-gray-600 text-white hover:from-gray-600 hover:to-gray-700 focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105">
                                                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                    </svg>
                                                    Lihat
                                                </a>
                                            @endif
                                        @else
                                            <a href="{{ route('loans.show', $loan) }}" class="inline-flex items-center px-4 py-2 text-xs font-bold rounded-xl bg-gradient-to-r from-blue-500 to-blue-600 text-white hover:from-blue-600 hover:to-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105">
                                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                </svg>
                                                Lihat
                                            </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="px-6 py-8 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <svg class="w-12 h-12 text-amber-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                        </svg>
                                        <h3 class="text-lg font-semibold text-amber-800 mb-2">Tidak ada data peminjaman</h3>
                                        <p class="text-amber-600">Belum ada peminjaman yang tercatat dalam sistem.</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if(isset($loans) && $loans->hasPages())
                    <div class="bg-gradient-to-r from-amber-50 to-yellow-50 px-6 py-4 flex items-center justify-between border-t border-amber-200 sm:px-8">
                        <div class="flex-1 flex justify-between sm:hidden">
                            @if ($loans->onFirstPage())
                                <span class="relative inline-flex items-center px-4 py-2 border border-amber-300 text-sm font-medium rounded-xl text-amber-400 bg-amber-100 cursor-not-allowed">Previous</span>
                            @else
                                <a href="{{ $loans->previousPageUrl() }}" class="relative inline-flex items-center px-4 py-2 border border-amber-300 text-sm font-medium rounded-xl text-amber-700 bg-white">Previous</a>
                            @endif
                            @if ($loans->hasMorePages())
                                <a href="{{ $loans->nextPageUrl() }}" class="ml-3 relative inline-flex items-center px-4 py-2 border border-amber-300 text-sm font-medium rounded-xl text-amber-700 bg-white">Next</a>
                            @else
                                <span class="ml-3 relative inline-flex items-center px-4 py-2 border border-amber-300 text-sm font-medium rounded-xl text-amber-400 bg-amber-100 cursor-not-allowed">Next</span>
                            @endif
                        </div>
                        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                            <div>
                                <p class="text-sm text-amber-700">
                                    Menampilkan <span class="font-semibold">{{ $loans->firstItem() }}</span> sampai <span class="font-semibold">{{ $loans->lastItem() }}</span> dari <span class="font-semibold">{{ $loans->total() }}</span> hasil
                                </p>
                            </div>
                            <div>
                                <nav class="relative z-0 inline-flex rounded-xl shadow-lg -space-x-px overflow-hidden" aria-label="Pagination">
                                    @if ($loans->onFirstPage())
                                        <span class="relative inline-flex items-center px-3 py-2 rounded-l-xl border border-amber-300 bg-amber-100 text-sm font-medium text-amber-400 cursor-not-allowed">
                                            <span class="sr-only">Previous</span>
                                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 01-.001-1.414l4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </span>
                                    @else
                                        <a href="{{ $loans->previousPageUrl() }}" class="relative inline-flex items-center px-3 py-2 rounded-l-xl border border-amber-300 bg-white text-sm font-medium text-amber-500">
                                            <span class="sr-only">Previous</span>
                                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 01-.001-1.414l4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </a>
                                    @endif

                                    @foreach ($loans->getUrlRange(1, $loans->lastPage()) as $page => $url)
                                        @if ($page == $loans->currentPage())
                                            <span aria-current="page" class="z-10 bg-amber-600 border-amber-600 text-white relative inline-flex items-center px-4 py-2 border text-sm font-bold">{{ $page }}</span>
                                        @else
                                            <a href="{{ $url }}" class="bg-white border-amber-300 text-amber-500 relative inline-flex items-center px-4 py-2 border text-sm font-medium">{{ $page }}</a>
                                        @endif
                                    @endforeach

                                    @if ($loans->hasPages() && $loans->currentPage() < $loans->lastPage() - 2)
                                        <span class="relative inline-flex items-center px-4 py-2 border border-amber-300 bg-white text-sm font-medium text-amber-700">...</span>
                                        <a href="{{ $loans->url($loans->lastPage()) }}" class="bg-white border-amber-300 text-amber-500 relative inline-flex items-center px-4 py-2 border text-sm font-medium">{{ $loans->lastPage() }}</a>
                                    @endif

                                    @if ($loans->hasMorePages())
                                        <a href="{{ $loans->nextPageUrl() }}" class="relative inline-flex items-center px-3 py-2 rounded-r-xl border border-amber-300 bg-white text-sm font-medium text-amber-500">
                                            <span class="sr-only">Next</span>
                                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 01.001 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                            </svg>
                                        </a>
                                    @else
                                        <span class="relative inline-flex items-center px-3 py-2 rounded-r-xl border border-amber-300 bg-amber-100 text-sm font-medium text-amber-400 cursor-not-allowed">
                                            <span class="sr-only">Next</span>
                                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 01.001 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                            </svg>
                                        </span>
                                    @endif
                                </nav>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
