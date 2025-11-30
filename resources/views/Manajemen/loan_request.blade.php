<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-bold text-2xl text-gray-900 leading-tight">
                    {{ __('Request Peminjaman Buku') }}
                </h2>
                <p class="text-sm text-gray-600 mt-1">Ajukan permintaan peminjaman buku</p>
            </div>
            <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-lg font-semibold text-sm text-gray-700 uppercase tracking-widest hover:bg-gray-400 focus:bg-gray-400 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-all duration-200">
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
                    <form action="{{ route('loans.store_request') }}" method="POST">
                        @csrf

                        <div class="space-y-6">
                            <!-- Book Selection -->
                            <div>
                                <x-input-label for="book_id" :value="__('Pilih Buku')" />
                                <select id="book_id" name="book_id" class="mt-1 block w-full border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm" required>
                                    <option value="">-- Pilih Buku --</option>
                                    @foreach($books as $book)
                                        <option value="{{ $book->id }}" {{ old('book_id') == $book->id ? 'selected' : '' }}>
                                            {{ $book->title }} - {{ $book->author }} (Stok: {{ $book->stock }})
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('book_id')" class="mt-2" />
                            </div>

                            <!-- Loan Date -->
                            <div>
                                <x-input-label for="loan_date" :value="__('Tanggal Pinjam')" />
                                <x-text-input id="loan_date" name="loan_date" type="date" class="mt-1 block w-full" :value="old('loan_date', date('Y-m-d'))" required />
                                <x-input-error :messages="$errors->get('loan_date')" class="mt-2" />
                            </div>

                            <!-- Due Date -->
                            <div>
                                <x-input-label for="due_date" :value="__('Tanggal Kembali')" />
                                <x-text-input id="due_date" name="due_date" type="date" class="mt-1 block w-full" :value="old('due_date')" required />
                                <x-input-error :messages="$errors->get('due_date')" class="mt-2" />
                            </div>

                            <!-- Notes -->
                            <div>
                                <x-input-label for="notes" :value="__('Catatan')" />
                                <textarea id="notes" name="notes" rows="3" class="mt-1 block w-full border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm" placeholder="Catatan permintaan peminjaman...">{{ old('notes') }}</textarea>
                                <x-input-error :messages="$errors->get('notes')" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-8">
                            <a href="{{ route('dashboard') }}" class="mr-4 inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-lg font-semibold text-sm text-gray-700 uppercase tracking-widest hover:bg-gray-400 focus:bg-gray-400 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-all duration-200">
                                Batal
                            </a>

                            <x-primary-button onclick="showNotification()">
                                {{ __('Ajukan Permintaan') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showNotification() {
            // Show success notification
            toastr.success('Permintaan peminjaman telah masuk ke admin/staff. Silakan tunggu konfirmasi.');

            // Optionally, you can add a delay before submitting the form
            setTimeout(function() {
                // The form will be submitted by the button's default behavior
            }, 1000);
        }
    </script>
</x-app-layout>
