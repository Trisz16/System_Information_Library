<!-- resources/views/layouts/sidebar.blade.php -->
<aside id="sidebar" class="bg-white w-64 min-h-screen flex flex-col shadow-lg fixed lg:relative z-40 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out">
    <!-- Logo -->
    <div class="shrink-0 flex items-center justify-center h-20 border-b">
        <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 group">
            <div class="w-12 h-12 bg-gradient-to-br from-primary-500 to-primary-600 rounded-xl flex items-center justify-center shadow-lg group-hover:shadow-xl transition-all duration-300">
                <i class="fas fa-book text-white text-xl"></i>
            </div>
            <div>
                <h1 class="text-xl font-bold bg-gradient-to-r from-primary-600 to-primary-700 bg-clip-text text-transparent">
                    Perpustakaan
                </h1>
                <p class="text-xs text-secondary-500 -mt-1">Azfakun Library</p>
            </div>
        </a>
    </div>

    <!-- Navigation Links -->
    <nav class="flex-1 px-4 py-6 space-y-2">
        <h3 class="px-4 mb-2 text-xs font-semibold text-gray-400 uppercase tracking-wider">Menu</h3>

        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
            <i class="fas fa-tachometer-alt w-6 text-center"></i>
            <span class="ml-3">Dashboard</span>
        </x-nav-link>

        <!-- Student Menu -->
        @if(Auth::user()->isMahasiswa())
            <x-nav-link :href="route('chat.ai-assistant')" :active="request()->routeIs('chat.ai-assistant')">
                <i class="fas fa-robot w-6 text-center"></i>
                <span class="ml-3">AI Assistant</span>
            </x-nav-link>
            @if(Auth::user()->member && Auth::user()->member->isProfileComplete())
                <x-nav-link :href="route('books.index')" :active="request()->routeIs('books.index')">
                    <i class="fas fa-book-open w-6 text-center"></i>
                    <span class="ml-3">Browse Books</span>
                </x-nav-link>
                <x-nav-link :href="route('loans.request')" :active="request()->routeIs('loans.request')">
                    <i class="fas fa-hand-holding-heart w-6 text-center"></i>
                    <span class="ml-3">Request a Loan</span>
                </x-nav-link>
            @else
                <div class="px-4 py-2 bg-yellow-50 border border-yellow-200 rounded-lg mx-4 mb-2">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-triangle text-yellow-500 text-sm mr-2"></i>
                        <span class="text-sm text-yellow-800 font-medium">Lengkapi Profil Anggota</span>
                    </div>
                    <p class="text-xs text-yellow-700 mt-1">Anda perlu melengkapi data anggota untuk mengakses fitur peminjaman.</p>
                </div>
            @endif
        @endif

        <!-- Staff & Admin Menu -->
        @if(Auth::user()->isAdminOrStaff())
            <div class="pt-4">
                <h3 class="px-4 mb-2 text-xs font-semibold text-gray-400 uppercase tracking-wider">Management</h3>
                <x-nav-link :href="route('Manajemen/Buku')" :active="request()->routeIs('Manajemen/Buku')">
                    <i class="fas fa-book w-6 text-center"></i>
                    <span class="ml-3">Book Management</span>
                </x-nav-link>
                <x-nav-link :href="route('Manajemen/Kategori')" :active="request()->routeIs('Manajemen/Kategori')">
                    <i class="fas fa-tags w-6 text-center"></i>
                    <span class="ml-3">Category Management</span>
                </x-nav-link>
                <x-nav-link :href="route('Manajemen/Anggota')" :active="request()->routeIs('Manajemen/Anggota')">
                    <i class="fas fa-users w-6 text-center"></i>
                    <span class="ml-3">Member Management</span>
                </x-nav-link>
                <x-nav-link :href="route('Manajemen/Peminjaman')" :active="request()->routeIs('Manajemen/Peminjaman')">
                    <i class="fas fa-hand-holding-usd w-6 text-center"></i>
                    <span class="ml-3">Loan Management</span>
                </x-nav-link>
                <x-nav-link :href="route('Manajemen/Pengembalian')" :active="request()->routeIs('Manajemen/Pengembalian')">
                    <i class="fas fa-undo-alt w-6 text-center"></i>
                    <span class="ml-3">Return Management</span>
                </x-nav-link>
                <x-nav-link :href="route('reports.loans')" :active="request()->routeIs('reports.loans')">
                    <i class="fas fa-chart-bar w-6 text-center"></i>
                    <span class="ml-3">Loan Reports</span>
                </x-nav-link>
            </div>
        @endif

        <!-- Admin Only Menu -->
        @if(Auth::user()->isAdmin())
            <div class="pt-4">
                <h3 class="px-4 mb-2 text-xs font-semibold text-gray-400 uppercase tracking-wider">Admin</h3>
                <x-nav-link :href="route('Manajemen/User&Role')" :active="request()->routeIs('Manajemen/User&Role')">
                    <i class="fas fa-user-shield w-6 text-center"></i>
                    <span class="ml-3">User & Role Management</span>
                </x-nav-link>
            </div>
        @endif
    </nav>

    <!-- Sidebar Footer -->
    <div class="p-4 border-t">
        <p class="text-center text-xs text-gray-500">
            &copy; {{ date('Y') }} Perpustakaan Azfakun
        </p>
    </div>
</aside>
