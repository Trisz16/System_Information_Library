<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-bold text-2xl text-gray-900 leading-tight">
                    {{ __('Tambah Buku Baru') }}
                </h2>
                <p class="text-sm text-gray-600 mt-1">Tambahkan buku baru ke koleksi perpustakaan</p>
            </div>
            <a href="{{ route('books.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-lg font-semibold text-sm text-gray-700 uppercase tracking-widest hover:bg-gray-400 focus:bg-gray-400 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-all duration-200">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="space-y-6">
                            <!-- Judul Buku -->
                            <div>
                                <x-input-label for="title" :value="__('Judul Buku')" />
                                <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title')" required autofocus autocomplete="title" />
                                <x-input-error :messages="$errors->get('title')" class="mt-2" />
                            </div>

                            <!-- Penulis -->
                            <div>
                                <x-input-label for="author" :value="__('Penulis')" />
                                <x-text-input id="author" name="author" type="text" class="mt-1 block w-full" :value="old('author')" required autocomplete="author" />
                                <x-input-error :messages="$errors->get('author')" class="mt-2" />
                            </div>

                            <!-- ISBN -->
                            <div>
                                <x-input-label for="isbn" :value="__('ISBN')" />
                                <x-text-input id="isbn" name="isbn" type="text" class="mt-1 block w-full" :value="old('isbn')" required autocomplete="isbn" />
                                <x-input-error :messages="$errors->get('isbn')" class="mt-2" />
                            </div>

                            <!-- Kategori -->
                            <div>
                                <x-input-label for="category_id" :value="__('Kategori')" />
                                <select id="category_id" name="category_id" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                    <option value="">Pilih Kategori</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                            </div>

                            <!-- Penerbit -->
                            <div>
                                <x-input-label for="publisher" :value="__('Penerbit')" />
                                <x-text-input id="publisher" name="publisher" type="text" class="mt-1 block w-full" :value="old('publisher')" autocomplete="publisher" />
                                <x-input-error :messages="$errors->get('publisher')" class="mt-2" />
                            </div>

                            <!-- Tahun Terbit -->
                            <div>
                                <x-input-label for="publication_year" :value="__('Tahun Terbit')" />
                                <x-text-input id="publication_year" name="publication_year" type="number" class="mt-1 block w-full" :value="old('publication_year')" min="1000" :max="date('Y') + 1" required />
                                <x-input-error :messages="$errors->get('publication_year')" class="mt-2" />
                            </div>

                            <!-- Stok -->
                            <div>
                                <x-input-label for="stock" :value="__('Stok')" />
                                <x-text-input id="stock" name="stock" type="number" class="mt-1 block w-full" :value="old('stock')" min="0" required />
                                <x-input-error :messages="$errors->get('stock')" class="mt-2" />
                            </div>

                            <!-- Cover Image -->
                            <div>
                                <x-input-label for="cover_image" :value="__('Cover Buku')" />
                                <input id="cover_image" name="cover_image" type="file" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" accept="image/*" />
                                <p class="mt-1 text-sm text-gray-500">Upload gambar cover buku (JPG, PNG, max 2MB)</p>
                                <x-input-error :messages="$errors->get('cover_image')" class="mt-2" />
                            </div>

                            <!-- Deskripsi -->
                            <div>
                                <x-input-label for="description" :value="__('Deskripsi')" />
                                <textarea id="description" name="description" rows="4" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" placeholder="Deskripsi singkat tentang buku...">{{ old('description') }}</textarea>
                                <x-input-error :messages="$errors->get('description')" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-8">
                            <a href="{{ route('books.index') }}" class="mr-4 inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-lg font-semibold text-sm text-gray-700 uppercase tracking-widest hover:bg-gray-400 focus:bg-gray-400 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-all duration-200">
                                Batal
                            </a>

                            <x-primary-button>
                                {{ __('Simpan Buku') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
