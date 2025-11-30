<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-bold text-2xl text-gray-900 leading-tight">
                    {{ __('Edit Peminjaman') }}
                </h2>
                <p class="text-sm text-gray-600 mt-1">Edit informasi peminjaman buku</p>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('loans.show', $loan) }}" class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-lg font-semibold text-sm text-gray-700 uppercase tracking-widest hover:bg-gray-400 focus:bg-gray-400 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-all duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                    Lihat
                </a>
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
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('loans.update', $loan) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="space-y-6">
                            <!-- Anggota -->
                            <div>
                                <x-input-label for="member_id" :value="__('Anggota')" />
                                <select id="member_id" name="member_id" class="mt-1 block w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm" required>
                                    <option value="">Pilih Anggota</option>
                                    @foreach($members as $member)
                                        <option value="{{ $member->id }}" {{ old('member_id', $loan->member_id) == $member->id ? 'selected' : '' }}>
                                            {{ $member->name }} (LIB-{{ str_pad($member->id, 4, '0', STR_PAD_LEFT) }})
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('member_id')" class="mt-2" />
                            </div>

                            <!-- Buku -->
                            <div>
                                <x-input-label for="book_id" :value="__('Buku')" />
                                <select id="book_id" name="book_id" class="mt-1 block w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm" required>
                                    <option value="">Pilih Buku</option>
                                    @foreach($books as $book)
                                        <option value="{{ $book->id }}" {{ old('book_id', $loan->book_id) == $book->id ? 'selected' : '' }}>
                                            {{ $book->title }} - {{ $book->author }} (Stok: {{ $book->stock }})
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('book_id')" class="mt-2" />
                            </div>

                            <!-- Tanggal Pinjam -->
                            <div>
                                <x-input-label for="loan_date" :value="__('Tanggal Pinjam')" />
                                <x-text-input id="loan_date" name="loan_date" type="date" class="mt-1 block w-full" :value="old('loan_date', $loan->loan_date->format('Y-m-d'))" required />
                                <x-input-error :messages="$errors->get('loan_date')" class="mt-2" />
                            </div>

                            <!-- Tanggal Kembali -->
                            <div>
                                <x-input-label for="due_date" :value="__('Tanggal Kembali')" />
                                <x-text-input id="due_date" name="due_date" type="date" class="mt-1 block w-full" :value="old('due_date', $loan->due_date->format('Y-m-d'))" required />
                                <x-input-error :messages="$errors->get('due_date')" class="mt-2" />
                            </div>

                            <!-- Catatan -->
                            <div>
                                <x-input-label for="notes" :value="__('Catatan')" />
                                <textarea id="notes" name="notes" rows="3" class="mt-1 block w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm" placeholder="Catatan tambahan...">{{ old('notes', $loan->notes) }}</textarea>
                                <x-input-error :messages="$errors->get('notes')" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-8">
                            <a href="{{ route('loans.index') }}" class="mr-4 inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-lg font-semibold text-sm text-gray-700 uppercase tracking-widest hover:bg-gray-400 focus:bg-gray-400 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-all duration-200">
                                Batal
                            </a>

                            <x-primary-button>
                                {{ __('Update Peminjaman') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
