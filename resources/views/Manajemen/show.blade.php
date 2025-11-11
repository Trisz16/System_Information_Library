<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-bold text-2xl text-gray-900 leading-tight">
                    {{ __('Detail Buku') }}
                </h2>
                <p class="text-sm text-gray-600 mt-1">Informasi lengkap buku</p>
            </div>
            <div class="flex space-x-3">
                @if(Auth::user() && in_array(Auth::user()->role, ['admin', 'staff']))
                <a href="{{ route('books.edit', $book) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-lg font-semibold text-sm text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Edit
                </a>
                @endif
                <a href="{{ route('books.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-lg font-semibold text-sm text-gray-700 uppercase tracking-widest hover:bg-gray-400 focus:bg-gray-400 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-all duration-200">
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
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Cover Image -->
                        <div class="md:col-span-1">
                            <div class="bg-gray-100 rounded-lg overflow-hidden">
                                @if($book->cover_image)
                                    <img src="{{ asset('storage/' . $book->cover_image) }}" alt="{{ $book->title }}" class="w-full h-64 object-cover">
                                @else
                                    <div class="w-full h-64 flex items-center justify-center bg-blue-100">
                                        <svg class="h-24 w-24 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                        </svg>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Book Details -->
                        <div class="md:col-span-2">
                            <div class="space-y-4">
                                <div>
                                    <h3 class="text-2xl font-bold text-gray-900">{{ $book->title }}</h3>
                                    <p class="text-lg text-gray-600">oleh {{ $book->author }}</p>
                                </div>

                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div class="bg-gray-50 p-4 rounded-lg">
                                        <h4 class="text-sm font-medium text-gray-500 uppercase tracking-wide">ISBN</h4>
                                        <p class="text-lg font-semibold text-gray-900">{{ $book->isbn }}</p>
                                    </div>
                                    <div class="bg-gray-50 p-4 rounded-lg">
                                        <h4 class="text-sm font-medium text-gray-500 uppercase tracking-wide">Kategori</h4>
                                        <p class="text-lg font-semibold text-gray-900">{{ $book->category->name ?? 'N/A' }}</p>
                                    </div>
                                    <div class="bg-gray-50 p-4 rounded-lg">
                                        <h4 class="text-sm font-medium text-gray-500 uppercase tracking-wide">Penerbit</h4>
                                        <p class="text-lg font-semibold text-gray-900">{{ $book->publisher ?? 'N/A' }}</p>
                                    </div>
                                    <div class="bg-gray-50 p-4 rounded-lg">
                                        <h4 class="text-sm font-medium text-gray-500 uppercase tracking-wide">Tahun Terbit</h4>
                                        <p class="text-lg font-semibold text-gray-900">{{ $book->publication_year ?? 'N/A' }}</p>
                                    </div>
                                    <div class="bg-gray-50 p-4 rounded-lg">
                                        <h4 class="text-sm font-medium text-gray-500 uppercase tracking-wide">Stok</h4>
                                        <p class="text-lg font-semibold text-gray-900">{{ $book->stock }}</p>
                                    </div>
                                    <div class="bg-gray-50 p-4 rounded-lg">
                                        <h4 class="text-sm font-medium text-gray-500 uppercase tracking-wide">Status</h4>
                                        @if($book->stock > 0)
                                            <span class="inline-flex px-2 py-1 text-sm font-semibold rounded-full bg-green-100 text-green-800">Tersedia</span>
                                        @else
                                            <span class="inline-flex px-2 py-1 text-sm font-semibold rounded-full bg-red-100 text-red-800">Habis</span>
                                        @endif
                                    </div>
                                </div>

                                @if($book->description)
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <h4 class="text-sm font-medium text-gray-500 uppercase tracking-wide mb-2">Deskripsi</h4>
                                    <p class="text-gray-900">{{ $book->description }}</p>
                                </div>
                                @endif

                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <h4 class="text-sm font-medium text-gray-500 uppercase tracking-wide mb-2">Informasi Tambahan</h4>
                                    <div class="text-sm text-gray-600">
                                        <p>Dibuat: {{ $book->created_at->format('d M Y H:i') }}</p>
                                        <p>Terakhir diupdate: {{ $book->updated_at->format('d M Y H:i') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    @if(Auth::user() && in_array(Auth::user()->role, ['admin', 'staff']))
                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <div class="flex justify-end space-x-3">
                            <a href="{{ route('books.edit', $book) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-lg font-semibold text-sm text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                Edit Buku
                            </a>
                            <form action="{{ route('books.destroy', $book) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus buku ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-lg font-semibold text-sm text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-all duration-200">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                    Hapus Buku
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
