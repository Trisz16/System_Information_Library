<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-bold text-2xl text-secondary-900 leading-tight animate-fade-in">
                    {{ __('Dashboard Perpustakaan Azfakun') }}
                </h2>
                <p class="text-sm text-secondary-600 mt-1">Selamat datang di Sistem Informasi Perpustakaan Modern</p>
            </div>
            <div class="text-right">
                <p class="text-sm text-secondary-500" id="real-time-date">{{ date('l, d F Y') }}</p>
                <p class="text-xs text-secondary-400" id="real-time-clock">{{ date('H:i:s') }} WIB</p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <!-- Welcome Banner -->
            <div class="bg-gradient-to-br from-primary-500 via-primary-600 to-accent-600 rounded-3xl shadow-large overflow-hidden animate-slide-up">
                <div class="px-8 py-12 text-white relative">
                    <div class="absolute inset-0 bg-black/10"></div>
                    <div class="relative flex items-center justify-between">
                        <div class="max-w-lg">
                            <h1 class="text-4xl font-bold mb-4 animate-fade-in">Perpustakaan Azfakun</h1>
                            <p class="text-xl opacity-90 mb-6">Jl. Aladin, No. 777, Kota Atlantis</p>
                            <p class="text-lg opacity-80">Menyediakan akses pengetahuan untuk semua kalangan</p>
                        </div>
                        <div class="hidden md:block">
                            <div class="w-32 h-32 bg-white/10 rounded-full flex items-center justify-center animate-float">
                                <i class="fas fa-book text-white text-6xl"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if(Auth::user() && in_array(Auth::user()->role, ['admin', 'staff']))
            <!-- Statistics Cards -->
            @elseif(Auth::user() && Auth::user()->role == 'mahasiswa' && (!Auth::user()->member || !Auth::user()->member->isProfileComplete()))
            <!-- Member Registration Form for Incomplete Profiles -->
            <div class="bg-yellow-50 border border-yellow-200 rounded-3xl p-8 mb-8">
                <div class="text-center mb-6">
                    <i class="fas fa-user-plus text-yellow-500 text-6xl mb-4"></i>
                    <h2 class="text-2xl font-bold text-yellow-800 mb-2">Lengkapi Data Anggota</h2>
                    <p class="text-yellow-700">Untuk dapat mengakses semua fitur peminjaman buku, Anda perlu melengkapi data anggota terlebih dahulu.</p>
                </div>

                <form action="{{ route('member.registration.store') }}" method="POST" class="max-w-2xl mx-auto">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <!-- Nama -->
                        <div>
                            <x-input-label for="name" :value="__('Nama Lengkap')" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', auth()->user()->name ?? '')" required autofocus autocomplete="name" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Email -->
                        <div>
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', auth()->user()->email ?? '')" required autocomplete="email" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- No. Telepon -->
                        <div>
                            <x-input-label for="phone" :value="__('No. Telepon')" />
                            <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" :value="old('phone')" autocomplete="phone" />
                            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                        </div>

                        <!-- Tanggal Lahir -->
                        <div>
                            <x-input-label for="date_of_birth" :value="__('Tanggal Lahir')" />
                            <x-text-input id="date_of_birth" name="date_of_birth" type="date" class="mt-1 block w-full" :value="old('date_of_birth')" required />
                            <x-input-error :messages="$errors->get('date_of_birth')" class="mt-2" />
                        </div>

                        <!-- Jenis Kelamin -->
                        <div>
                            <x-input-label for="gender" :value="__('Jenis Kelamin')" />
                            <select id="gender" name="gender" class="mt-1 block w-full border-gray-300 focus:border-yellow-500 focus:ring-yellow-500 rounded-md shadow-sm" required>
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            <x-input-error :messages="$errors->get('gender')" class="mt-2" />
                        </div>

                        <!-- Alamat -->
                        <div class="md:col-span-2">
                            <x-input-label for="address" :value="__('Alamat')" />
                            <textarea id="address" name="address" rows="3" class="mt-1 block w-full border-gray-300 focus:border-yellow-500 focus:ring-yellow-500 rounded-md shadow-sm" placeholder="Alamat lengkap..." required>{{ old('address') }}</textarea>
                            <x-input-error :messages="$errors->get('address')" class="mt-2" />
                        </div>
                    </div>

                    <div class="text-center">
                        <x-primary-button class="bg-yellow-600 hover:bg-yellow-700 focus:bg-yellow-700">
                            {{ __('Daftar sebagai Anggota') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
            @elseif(Auth::user() && in_array(Auth::user()->role, ['admin', 'staff']))
            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Total Books -->
                <div class="card animate-fade-in">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-secondary-600 uppercase tracking-wide">Total Buku</p>
                                <p class="text-3xl font-bold text-secondary-900 mt-2" id="totalBooks">{{ $stats['totalBooks'] ?? 'N/A' }}</p>
                                <p class="text-sm text-green-600 mt-1 flex items-center">
                                    <i class="fas fa-book-open mr-1"></i>
                                    <span>Total all books</span>
                                </p>
                            </div>
                            <div class="w-12 h-12 bg-primary-100 rounded-xl flex items-center justify-center">
                                <i class="fas fa-book text-primary-600 text-lg"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Members -->
                <div class="card animate-fade-in" style="animation-delay: 0.1s">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-secondary-600 uppercase tracking-wide">Total Anggota</p>
                                <p class="text-3xl font-bold text-secondary-900 mt-2" id="totalMembers">{{ $stats['totalMembers'] ?? 'N/A' }}</p>
                                <p class="text-sm text-green-600 mt-1 flex items-center">
                                    <i class="fas fa-users mr-1"></i>
                                    <span>All registered members</span>
                                </p>
                            </div>
                            <div class="w-12 h-12 bg-accent-100 rounded-xl flex items-center justify-center">
                                <i class="fas fa-users text-accent-600 text-lg"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Active Loans -->
                <div class="card animate-fade-in" style="animation-delay: 0.2s">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-secondary-600 uppercase tracking-wide">Peminjaman Aktif</p>
                                <p class="text-3xl font-bold text-secondary-900 mt-2" id="activeLoans">{{ $stats['activeLoans'] ?? 'N/A' }}</p>
                                <p class="text-sm text-yellow-600 mt-1 flex items-center">
                                    <i class="fas fa-clock mr-1"></i>
                                    <span>{{ $stats['overdueLoans'] ?? 0 }} terlambat</span>
                                </p>
                            </div>
                            <div class="w-12 h-12 bg-secondary-100 rounded-xl flex items-center justify-center">
                                <i class="fas fa-hand-holding text-secondary-600 text-lg"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Overdue Books -->
                <div class="card animate-fade-in" style="animation-delay: 0.3s">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-secondary-600 uppercase tracking-wide">Buku Terlambat</p>
                                <p class="text-3xl font-bold text-secondary-900 mt-2" id="overdueBooks">{{ $stats['overdueLoans'] ?? 'N/A' }}</p>
                                <p class="text-sm text-red-600 mt-1 flex items-center">
                                    <i class="fas fa-exclamation-triangle mr-1"></i>
                                    Perlu tindakan
                                </p>
                            </div>
                            <div class="w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center">
                                <i class="fas fa-exclamation-triangle text-red-600 text-lg"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @else
            <!-- Mahasiswa Loan Status -->
                        <div class="space-y-6">
                            <div class="card">
                                <div class="p-6 flex justify-between items-center">
                                    <div>
                                        <h3 class="text-lg font-semibold text-secondary-900">Status Peminjaman Anda</h3>
                                        <p class="text-sm text-secondary-600">Anda memiliki {{ $stats['overdueCount'] ?? 0 }} buku yang telah jatuh tempo.</p>
                                    </div>
                                    <a href="{{ route('loans.request') }}" class="btn-primary">Ajukan Peminjaman Baru</a>
                                </div>
                            </div>
            
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="text-lg font-semibold text-secondary-900">5 Peminjaman Terakhir Anda</h3>
                                </div>
                                <div class="card-body">
                                    <div class="overflow-x-auto">
                                        <table class="min-w-full divide-y divide-gray-200">
                                            <thead class="bg-gray-50">
                                                <tr>
                                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul Buku</th>
                                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Pinjam</th>
                                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jatuh Tempo</th>
                                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody class="bg-white divide-y divide-gray-200">
                                                @forelse ($stats['userLoans'] as $loan)
                                                    <tr>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $loan->book->title }}</td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $loan->loan_date->format('d M Y') }}</td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $loan->due_date->format('d M Y') }}</td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                                @if($loan->status == 'borrowed' && $loan->due_date < now()) bg-red-100 text-red-800 @elseif($loan->status == 'borrowed') bg-yellow-100 text-yellow-800 @else bg-green-100 text-green-800 @endif">
                                                                {{ ucfirst($loan->status) }}
                                                            </span>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="4" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">Anda belum memiliki riwayat peminjaman.</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>            @endif

            @if(Auth::user() && in_array(Auth::user()->role, ['admin', 'staff']))
            <!-- Charts Section -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Loan Trends Chart -->
                <div class="card animate-fade-in" style="animation-delay: 0.4s">
                    <div class="card-header">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-semibold text-secondary-900">Trend Peminjaman Bulanan</h3>
                            <div class="flex items-center space-x-2">
                                <div class="w-3 h-3 bg-primary-500 rounded-full animate-pulse"></div>
                                <span class="text-sm text-secondary-600">Data Real-time</span>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="relative">
                            <canvas id="loanTrendsChart" width="400" height="250"></canvas>
                            <div class="absolute top-4 right-4 text-xs text-secondary-500 bg-white/80 px-2 py-1 rounded-full shadow-soft">
                                <i class="fas fa-chart-line mr-1"></i>
                                12 Bulan Terakhir
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Category Distribution -->
                <div class="card animate-fade-in" style="animation-delay: 0.5s">
                    <div class="card-header">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-semibold text-secondary-900">Distribusi Kategori Buku</h3>
                            <div class="text-sm text-secondary-500">
                                <i class="fas fa-book mr-1"></i>
                                Total: {{ $stats['totalBooks'] ?? 0 }} buku
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="relative">
                            <canvas id="categoryChart" width="400" height="250"></canvas>
                            <div class="absolute top-4 right-4 text-xs text-secondary-500 bg-white/80 px-2 py-1 rounded-full shadow-soft">
                                <i class="fas fa-chart-pie mr-1"></i>
                                Distribusi Real-time
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Activities -->
            <div class="card animate-fade-in" style="animation-delay: 0.6s">
                <div class="card-header">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-secondary-900">Aktivitas Terbaru</h3>
                        <a href="{{ route('notifications.index') }}" class="text-sm text-primary-600 hover:text-primary-800 font-medium transition-colors duration-200">Lihat Semua</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="space-y-4">
                        @forelse($stats['recentLoans'] as $loan)
                        <div class="flex items-center space-x-4 p-4 bg-secondary-50 rounded-xl hover:bg-secondary-100 transition-colors duration-200">
                            <div class="w-10 h-10 bg-primary-100 rounded-xl flex items-center justify-center">
                                <i class="fas fa-hand-holding text-primary-600"></i>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-secondary-900">Peminjaman baru: "{{ $loan->book->title }}"</p>
                                <p class="text-xs text-secondary-500">Oleh {{ $loan->member->name }} • {{ $loan->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                        @empty
                        @endforelse

                        @forelse($stats['recentReturns'] as $return)
                        <div class="flex items-center space-x-4 p-4 bg-secondary-50 rounded-xl hover:bg-secondary-100 transition-colors duration-200">
                            <div class="w-10 h-10 bg-accent-100 rounded-xl flex items-center justify-center">
                                <i class="fas fa-undo text-accent-600"></i>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-secondary-900">Pengembalian buku: "{{ $return->book->title }}"</p>
                                <p class="text-xs text-secondary-500">Oleh {{ $return->member->name }} • {{ $return->updated_at->diffForHumans() }}</p>
                            </div>
                        </div>
                        @empty
                        @endforelse

                        @if($stats['recentLoans']->isEmpty() && $stats['recentReturns']->isEmpty())
                        <div class="p-4 text-center text-secondary-600">Tidak ada aktivitas terbaru.</div>
                        @endif
                    </div>
                </div>
            </div>
            @endif

            <!-- Quick Actions -->
            <div class="card animate-fade-in" style="animation-delay: 0.7s">
                <div class="card-header">
                    <h3 class="text-lg font-semibold text-secondary-900">Aksi Cepat</h3>
                </div>
                <div class="card-body">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        @if(Auth::user() && in_array(Auth::user()->role, ['admin', 'staff']))
                        <a href="{{ route('books.create') }}" class="btn-primary flex flex-col items-center p-4 bg-primary-50 rounded-xl hover:bg-primary-100 transition-all duration-200 transform hover:scale-105">
                            <i class="fas fa-plus text-primary-600 text-2xl mb-2"></i>
                            <span class="text-sm font-medium text-secondary-900">Tambah Buku</span>
                        </a>

                        <a href="{{ route('members.create') }}" class="btn-secondary flex flex-col items-center p-4 bg-accent-50 rounded-xl hover:bg-accent-100 transition-all duration-200 transform hover:scale-105">
                            <i class="fas fa-user-plus text-accent-600 text-2xl mb-2"></i>
                            <span class="text-sm font-medium text-secondary-900">Tambah Anggota</span>
                        </a>

                        <a href="{{ route('loans.create') }}" class="btn-accent flex flex-col items-center p-4 bg-secondary-50 rounded-xl hover:bg-secondary-100 transition-all duration-200 transform hover:scale-105">
                            <i class="fas fa-hand-holding text-secondary-600 text-2xl mb-2"></i>
                            <span class="text-sm font-medium text-secondary-900">Proses Pinjam</span>
                        </a>

                        <a href="{{ route('reports.loans') }}" class="btn-outline flex flex-col items-center p-4 bg-red-50 rounded-xl hover:bg-red-100 transition-all duration-200 transform hover:scale-105">
                            <i class="fas fa-chart-bar text-red-600 text-2xl mb-2"></i>
                            <span class="text-sm font-medium text-secondary-900">Laporan</span>
                        </a>
                        @elseif(Auth::user() && Auth::user()->role == 'mahasiswa')
                        <a href="{{ route('loans.request') }}" class="btn-primary flex flex-col items-center p-4 bg-primary-50 rounded-xl hover:bg-primary-100 transition-all duration-200 transform hover:scale-105">
                            <i class="fas fa-plus-circle text-primary-600 text-2xl mb-2"></i>
                            <span class="text-sm font-medium text-secondary-900">Ajukan Peminjaman</span>
                        </a>

                        <a href="{{ route('profile.notification') }}" class="btn-accent flex flex-col items-center p-4 bg-accent-50 rounded-xl hover:bg-accent-100 transition-all duration-200 transform hover:scale-105">
                            <i class="fas fa-bell text-accent-600 text-2xl mb-2"></i>
                            <span class="text-sm font-medium text-secondary-900">Notifikasi</span>
                        </a>

                        <a href="{{ route('books.index') }}" class="btn-secondary flex flex-col items-center p-4 bg-secondary-50 rounded-xl hover:bg-secondary-100 transition-all duration-200 transform hover:scale-105">
                            <i class="fas fa-book text-secondary-600 text-2xl mb-2"></i>
                            <span class="text-sm font-medium text-secondary-900">Lihat Daftar Buku</span>
                        </a>

                        <a href="{{ route('categories.index') }}" class="btn-outline flex flex-col items-center p-4 bg-primary-50 rounded-xl hover:bg-primary-100 transition-all duration-200 transform hover:scale-105">
                            <i class="fas fa-tags text-primary-600 text-2xl mb-2"></i>
                            <span class="text-sm font-medium text-secondary-900">Lihat Kategori</span>
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Floating Background Elements -->
    <div class="fixed inset-0 pointer-events-none overflow-hidden z-0">
        <!-- Floating Books -->
        <div class="absolute top-20 left-10 animate-float opacity-10">
            <i class="fas fa-book text-primary-300 text-4xl"></i>
        </div>
        <div class="absolute top-40 right-20 animate-float opacity-10" style="animation-delay: 2s">
            <i class="fas fa-book-open text-accent-300 text-3xl"></i>
        </div>
        <div class="absolute bottom-32 left-20 animate-float opacity-10" style="animation-delay: 4s">
            <i class="fas fa-scroll text-secondary-300 text-2xl"></i>
        </div>
        <div class="absolute bottom-20 right-32 animate-float opacity-10" style="animation-delay: 1s">
            <i class="fas fa-feather text-primary-300 text-3xl"></i>
        </div>

        <!-- Page Turning Animation -->
        <div class="absolute top-1/2 left-1/4 animate-page-turn opacity-5">
            <div class="w-16 h-20 bg-primary-200 rounded-sm shadow-lg transform rotate-12"></div>
        </div>
        <div class="absolute top-1/3 right-1/3 animate-page-turn opacity-5" style="animation-delay: 3s">
            <div class="w-12 h-16 bg-accent-200 rounded-sm shadow-lg transform -rotate-6"></div>
        </div>
    </div>

    <!-- Chart Data Script -->
    @if(Auth::user() && in_array(Auth::user()->role, ['admin', 'staff']))
    <script>
        window.monthlyLoansData = @json($stats['monthlyLoans'] ?? []);
        window.categoryData = @json($stats['categoryDistribution'] ?? []);
    </script>
    @endif

</x-app-layout>
