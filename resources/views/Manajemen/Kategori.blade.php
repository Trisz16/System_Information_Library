<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-bold text-2xl text-gray-900 leading-tight">
                    {{ __('Manajemen Kategori') }}
                </h2>
                <p class="text-sm text-gray-600 mt-1">Kelola kategori buku perpustakaan Azfakun</p>
            </div>
            @if(Auth::user() && in_array(Auth::user()->role, ['admin', 'staff']))
            <button id="addCategoryBtn" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 border border-transparent rounded-xl font-semibold text-sm text-white uppercase tracking-widest hover:from-blue-700 hover:to-blue-800 focus:from-blue-700 focus:to-blue-800 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200 shadow-lg hover:shadow-xl">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Tambah Kategori Baru
            </button>
            @endif
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Search Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                        <div class="mb-4 md:mb-0">
                            <h3 class="text-lg font-medium text-gray-900">Daftar Kategori</h3>
                            <p class="text-sm text-gray-600">Kelola kategori buku perpustakaan</p>
                        </div>
                        <div class="flex flex-col sm:flex-row gap-4">
                            <div class="relative">
                                <input type="text" placeholder="Cari kategori..." class="w-full sm:w-64 pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Categories Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Category Card 1 -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-lg transition-shadow duration-300">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4 flex-1">
                                <h3 class="text-lg font-medium text-gray-900">Teknologi</h3>
                                <p class="text-sm text-gray-600">Buku-buku teknologi dan programming</p>
                                <div class="mt-2 flex items-center text-sm text-gray-500">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        25 Buku
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 flex justify-end space-x-2">
                            @if(Auth::user() && in_array(Auth::user()->role, ['admin', 'staff']))
                            <button class="edit-category-btn inline-flex items-center px-3 py-1.5 bg-blue-50 text-blue-700 border border-blue-200 rounded-lg hover:bg-blue-100 hover:border-blue-300 transition-colors duration-200" data-category-id="1">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                Edit
                            </button>
                            <button class="delete-category-btn inline-flex items-center px-3 py-1.5 bg-red-50 text-red-700 border border-red-200 rounded-lg hover:bg-red-100 hover:border-red-300 transition-colors duration-200" data-category-id="1">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                                Hapus
                            </button>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Category Card 2 -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-lg transition-shadow duration-300">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4 flex-1">
                                <h3 class="text-lg font-medium text-gray-900">Sastra</h3>
                                <p class="text-sm text-gray-600">Kumpulan karya sastra dan novel</p>
                                <div class="mt-2 flex items-center text-sm text-gray-500">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        18 Buku
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 flex justify-end space-x-2">
                            @if(Auth::user() && in_array(Auth::user()->role, ['admin', 'staff']))
                            <button class="edit-category-btn inline-flex items-center px-3 py-1.5 bg-blue-50 text-blue-700 border border-blue-200 rounded-lg hover:bg-blue-100 hover:border-blue-300 transition-colors duration-200" data-category-id="2">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                Edit
                            </button>
                            <button class="delete-category-btn inline-flex items-center px-3 py-1.5 bg-red-50 text-red-700 border border-red-200 rounded-lg hover:bg-red-100 hover:border-red-300 transition-colors duration-200" data-category-id="2">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                                Hapus
                            </button>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Category Card 3 -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-lg transition-shadow duration-300">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4 flex-1">
                                <h3 class="text-lg font-medium text-gray-900">Ilmu Sosial</h3>
                                <p class="text-sm text-gray-600">Buku ilmu sosial dan humaniora</p>
                                <div class="mt-2 flex items-center text-sm text-gray-500">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                        12 Buku
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 flex justify-end space-x-2">
                            @if(Auth::user() && in_array(Auth::user()->role, ['admin', 'staff']))
                            <button class="edit-category-btn inline-flex items-center px-3 py-1.5 bg-blue-50 text-blue-700 border border-blue-200 rounded-lg hover:bg-blue-100 hover:border-blue-300 transition-colors duration-200" data-category-id="3">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                Edit
                            </button>
                            <button class="delete-category-btn inline-flex items-center px-3 py-1.5 bg-red-50 text-red-700 border border-red-200 rounded-lg hover:bg-red-100 hover:border-red-300 transition-colors duration-200" data-category-id="3">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                                Hapus
                            </button>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Category Card 4 -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-lg transition-shadow duration-300">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4 flex-1">
                                <h3 class="text-lg font-medium text-gray-900">Sains</h3>
                                <p class="text-sm text-gray-600">Buku sains dan pengetahuan alam</p>
                                <div class="mt-2 flex items-center text-sm text-gray-500">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        15 Buku
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 flex justify-end space-x-2">
                            @if(Auth::user() && in_array(Auth::user()->role, ['admin', 'staff']))
                            <button class="edit-category-btn inline-flex items-center px-3 py-1.5 bg-blue-50 text-blue-700 border border-blue-200 rounded-lg hover:bg-blue-100 hover:border-blue-300 transition-colors duration-200" data-category-id="4">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                Edit
                            </button>
                            <button class="delete-category-btn inline-flex items-center px-3 py-1.5 bg-red-50 text-red-700 border border-red-200 rounded-lg hover:bg-red-100 hover:border-red-300 transition-colors duration-200" data-category-id="4">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                                Hapus
                            </button>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Category Card 5 -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-lg transition-shadow duration-300">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4 flex-1">
                                <h3 class="text-lg font-medium text-gray-900">Romansa</h3>
                                <p class="text-sm text-gray-600">Cerita romansa dan kisah cinta</p>
                                <div class="mt-2 flex items-center text-sm text-gray-500">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        8 Buku
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 flex justify-end space-x-2">
                            @if(Auth::user() && in_array(Auth::user()->role, ['admin', 'staff']))
                            <button class="edit-category-btn inline-flex items-center px-3 py-1.5 bg-blue-50 text-blue-700 border border-blue-200 rounded-lg hover:bg-blue-100 hover:border-blue-300 transition-colors duration-200" data-category-id="5">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                Edit
                            </button>
                            <button class="delete-category-btn inline-flex items-center px-3 py-1.5 bg-red-50 text-red-700 border border-red-200 rounded-lg hover:bg-red-100 hover:border-red-300 transition-colors duration-200" data-category-id="5">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                                Hapus
                            </button>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Category Card 6 -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-lg transition-shadow duration-300">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4 flex-1">
                                <h3 class="text-lg font-medium text-gray-900">Bisnis</h3>
                                <p class="text-sm text-gray-600">Buku bisnis dan entrepreneurship</p>
                                <div class="mt-2 flex items-center text-sm text-gray-500">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                                        10 Buku
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 flex justify-end space-x-2">
                            @if(Auth::user() && in_array(Auth::user()->role, ['admin', 'staff']))
                            <button class="edit-category-btn inline-flex items-center px-3 py-1.5 bg-blue-50 text-blue-700 border border-blue-200 rounded-lg hover:bg-blue-100 hover:border-blue-300 transition-colors duration-200" data-category-id="6">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                Edit
                            </button>
                            <button class="delete-category-btn inline-flex items-center px-3 py-1.5 bg-red-50 text-red-700 border border-red-200 rounded-lg hover:bg-red-100 hover:border-red-300 transition-colors duration-200" data-category-id="6">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                                Hapus
                            </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Add New Category Card -->
            <div class="mt-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-2 border-dashed border-gray-300 hover:border-blue-400 transition-colors duration-300">
                    <div class="p-6 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">Tambah Kategori Baru</h3>
                        <p class="mt-1 text-sm text-gray-500">Buat kategori baru untuk mengorganisir buku</p>
                        <div class="mt-6">
                            @if(Auth::user() && in_array(Auth::user()->role, ['admin', 'staff']))
                            <button id="addNewCategoryBtn" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Tambah Kategori
                            </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Add/Edit Category -->
    <div id="categoryModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-xl bg-white">
            <div class="mt-3">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-bold text-gray-900" id="categoryModalTitle">Tambah Kategori Baru</h3>
                    <button id="closeCategoryModalBtn" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <form id="categoryForm">
                    @csrf
                    <input type="hidden" id="categoryId" name="category_id">

                    <div class="space-y-4">
                        <div>
                            <label for="categoryName" class="block text-sm font-medium text-gray-700 mb-1">Nama Kategori *</label>
                            <input type="text" id="categoryName" name="name" required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                   placeholder="Masukkan nama kategori">
                        </div>

                        <div>
                            <label for="categoryDescription" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                            <textarea id="categoryDescription" name="description" rows="3"
                                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                      placeholder="Deskripsi singkat tentang kategori..."></textarea>
                        </div>
                    </div>

                    <div class="flex justify-end space-x-3 mt-8">
                        <button type="button" id="cancelCategoryBtn"
                                class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition-colors duration-200">
                            Batal
                        </button>
                        <button type="submit"
                                class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200">
                            <span id="categorySubmitText">Simpan</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteCategoryModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-xl bg-white">
            <div class="mt-3 text-center">
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100 mb-4">
                    <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">Hapus Kategori</h3>
                <p class="text-sm text-gray-500 mb-6">
                    Apakah Anda yakin ingin menghapus kategori "<span id="deleteCategoryName"></span>"? Tindakan ini tidak dapat dibatalkan.
                </p>
                <div class="flex justify-center space-x-3">
                    <button id="cancelDeleteCategoryBtn"
                            class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition-colors duration-200">
                        Batal
                    </button>
                    <button id="confirmDeleteCategoryBtn"
                            class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors duration-200">
                        Hapus
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Modal functionality
        const categoryModal = document.getElementById('categoryModal');
        const deleteCategoryModal = document.getElementById('deleteCategoryModal');
        const addCategoryBtn = document.getElementById('addCategoryBtn');
        const addNewCategoryBtn = document.getElementById('addNewCategoryBtn');
        const closeCategoryModalBtn = document.getElementById('closeCategoryModalBtn');
        const cancelCategoryBtn = document.getElementById('cancelCategoryBtn');
        const cancelDeleteCategoryBtn = document.getElementById('cancelDeleteCategoryBtn');
        const confirmDeleteCategoryBtn = document.getElementById('confirmDeleteCategoryBtn');
        const categoryForm = document.getElementById('categoryForm');

        // Open add category modal
        [addCategoryBtn, addNewCategoryBtn].forEach(btn => {
            btn.addEventListener('click', () => {
                document.getElementById('categoryModalTitle').textContent = 'Tambah Kategori Baru';
                document.getElementById('categorySubmitText').textContent = 'Simpan';
                categoryForm.reset();
                document.getElementById('categoryId').value = '';
                categoryModal.classList.remove('hidden');
            });
        });

        // Close modals
        [closeCategoryModalBtn, cancelCategoryBtn].forEach(btn => {
            btn.addEventListener('click', () => {
                categoryModal.classList.add('hidden');
            });
        });

        cancelDeleteCategoryBtn.addEventListener('click', () => {
            deleteCategoryModal.classList.add('hidden');
        });

        // Edit category functionality
        document.querySelectorAll('.edit-category-btn').forEach(btn => {
            btn.addEventListener('click', (e) => {
                const categoryId = e.target.closest('.edit-category-btn').dataset.categoryId;
                // Here you would typically fetch category data from server
                // For demo purposes, we'll populate with sample data
                document.getElementById('categoryModalTitle').textContent = 'Edit Kategori';
                document.getElementById('categorySubmitText').textContent = 'Update';
                document.getElementById('categoryId').value = categoryId;

                // Sample data - replace with actual data fetching
                if (categoryId === '1') {
                    document.getElementById('categoryName').value = 'Teknologi';
                    document.getElementById('categoryDescription').value = 'Buku-buku teknologi dan programming';
                } else if (categoryId === '2') {
                    document.getElementById('categoryName').value = 'Sastra';
                    document.getElementById('categoryDescription').value = 'Kumpulan karya sastra dan novel';
                }

                categoryModal.classList.remove('hidden');
            });
        });

        // Delete category functionality
        document.querySelectorAll('.delete-category-btn').forEach(btn => {
            btn.addEventListener('click', (e) => {
                const categoryId = e.target.closest('.delete-category-btn').dataset.categoryId;
                const categoryName = e.target.closest('.bg-white').querySelector('h3').textContent;
                document.getElementById('deleteCategoryName').textContent = categoryName;
                confirmDeleteCategoryBtn.dataset.categoryId = categoryId;
                deleteCategoryModal.classList.remove('hidden');
            });
        });

        // Confirm delete
        confirmDeleteCategoryBtn.addEventListener('click', () => {
            const categoryId = confirmDeleteCategoryBtn.dataset.categoryId;
            // Here you would send delete request to server
            alert(`Kategori dengan ID ${categoryId} telah dihapus`);
            deleteCategoryModal.classList.add('hidden');
            // Refresh page or update grid
            location.reload();
        });

        // Form submission
        categoryForm.addEventListener('submit', (e) => {
            e.preventDefault();

            const formData = new FormData(categoryForm);
            const categoryId = document.getElementById('categoryId').value;

            // Here you would send the form data to your Laravel backend
            // For demo purposes, we'll just show an alert
            if (categoryId) {
                alert('Kategori berhasil diupdate!');
            } else {
                alert('Kategori berhasil ditambahkan!');
            }

            categoryModal.classList.add('hidden');
            // Refresh page or update grid
            location.reload();
        });

        // Close modal when clicking outside
        [categoryModal, deleteCategoryModal].forEach(modal => {
            modal.addEventListener('click', (e) => {
                if (e.target === modal) {
                    modal.classList.add('hidden');
                }
            });
        });
    </script>
</x-app-layout>
