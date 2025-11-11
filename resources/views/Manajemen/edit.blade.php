<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-bold text-2xl text-gray-900 leading-tight">
                    {{ __('Edit Buku') }}
                </h2>
                <p class="text-sm text-gray-600 mt-1">Edit informasi buku</p>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('books.show', $book) }}" class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-lg font-semibold text-sm text-gray-700 uppercase tracking-widest hover:bg-gray-400 focus:bg-gray-400 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-all duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                    Lihat
                </a>
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
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('books.update', $book) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="space-y-6">
                            <!-- Judul Buku -->
                            <div>
                                <x-input-label for="title" :value="__('Judul Buku')" />
                                <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title', $book->title)" required autofocus autocomplete="title" />
                                <x-input-error :messages="$errors->get('title')" class="mt-2" />
                            </div>

                            <!-- Penulis -->
                            <div>
                                <x-input-label for="author" :value="__('Penulis')" />
                                <x-text-input id="author" name="author" type="text" class="mt-1 block w-full" :value="old('author', $book->author)" required autocomplete="author" />
                                <x-input-error :messages="$errors->get('author')" class="mt-2" />
                            </div>

                            <!-- ISBN -->
                            <div>
                                <x-input-label for="isbn" :value="__('ISBN')" />
                                <x-text-input id="isbn" name="isbn" type="text" class="mt-1 block w-full" :value="old('isbn', $book->isbn)" required autocomplete="isbn" />
                                <x-input-error :messages="$errors->get('isbn')" class="mt-2" />
                            </div>

                            <!-- Kategori -->
                            <div>
                                <x-input-label for="category_id" :value="__('Kategori')" />
                                <select id="category_id" name="category_id" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                    <option value="">Pilih Kategori</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id', $book->category_id) == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                            </div>

                            <!-- Penerbit -->
                            <div>
                                <x-input-label for="publisher" :value="__('Penerbit')" />
                                <x-text-input id="publisher" name="publisher" type="text" class="mt-1 block w-full" :value="old('publisher', $book->publisher)" autocomplete="publisher" />
                                <x-input-error :messages="$errors->get('publisher')" class="mt-2" />
                            </div>

                            <!-- Tahun Terbit -->
                            <div>
                                <x-input-label for="publication_year" :value="__('Tahun Terbit')" />
                                <x-text-input id="publication_year" name="publication_year" type="number" class="mt-1 block w-full" :value="old('publication_year', $book->publication_year)" min="1000" :max="date('Y') + 1" required />
                                <x-input-error :messages="$errors->get('publication_year')" class="mt-2" />
                            </div>

                            <!-- Stok -->
                            <div>
                                <x-input-label for="stock" :value="__('Stok')" />
                                <x-text-input id="stock" name="stock" type="number" class="mt-1 block w-full" :value="old('stock', $book->stock)" min="0" required />
                                <x-input-error :messages="$errors->get('stock')" class="mt-2" />
                            </div>

                            <!-- Current Cover Image -->
                            @if($book->cover_image)
                            <div>
                                <x-input-label :value="__('Cover Buku Saat Ini')" />
                                <div class="mt-2">
                                    <img src="{{ asset('storage/' . $book->cover_image) }}" alt="Current cover" class="w-32 h-40 object-cover rounded-lg border">
                                </div>
                            </div>
                            @endif

                            <!-- Cover Image -->
                            <div>
                                <x-input-label for="cover_image" :value="__('Ganti Cover Buku')" />
                                <input id="cover_image" name="cover_image" type="file" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" accept="image/*" />
                                <p class="mt-1 text-sm text-gray-500">Upload gambar cover baru (JPG, PNG, max 2MB). Kosongkan jika tidak ingin mengubah.</p>
                                <x-input-error :messages="$errors->get('cover_image')" class="mt-2" />
                            </div>

                            <!-- Deskripsi -->
                            <div>
                                <x-input-label for="description" :value="__('Deskripsi')" />
                                <textarea id="description" name="description" rows="4" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" placeholder="Deskripsi singkat tentang buku...">{{ old('description', $book->description) }}</textarea>
                                <x-input-error :messages="$errors->get('description')" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-8">
                            <a href="{{ route('books.index') }}" class="mr-4 inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-lg font-semibold text-sm text-gray-700 uppercase tracking-widest hover:bg-gray-400 focus:bg-gray-400 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-all duration-200">
                                Batal
                            </a>

                            <x-primary-button>
                                {{ __('Update Buku') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
