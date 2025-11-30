<x-guest-layout>
    <div class="relative min-h-screen bg-gradient-to-br from-primary-100 via-secondary-100 to-accent-100 flex items-center justify-center p-4 sm:p-6 lg:p-8">
        <!-- Background Shapes -->
        <div class="absolute top-0 left-0 w-64 h-64 bg-primary-200 rounded-full opacity-50 -translate-x-16 -translate-y-16"></div>
        <div class="absolute bottom-0 right-0 w-72 h-72 bg-accent-200 rounded-full opacity-50 translate-x-16 translate-y-16"></div>

        <div class="relative w-full max-w-4xl bg-white/70 backdrop-blur-xl rounded-3xl shadow-2xl overflow-hidden z-10">
            <div class="grid md:grid-cols-2">
                <!-- Left Side: Information -->
                <div class="p-8 sm:p-12 bg-gradient-to-br from-primary-500 to-primary-700 text-white flex flex-col justify-center items-center text-center">
                    <div class="animate-fade-in-down">
                        <div class="mb-6">
                            <i class="fas fa-book-reader text-6xl text-white/80"></i>
                        </div>
                        <h1 class="text-4xl font-bold mb-3">Perpustakaan Azfakun</h1>
                        <p class="text-lg opacity-90">Gerbang Pengetahuan Anda</p>
                        <p class="mt-4 text-sm opacity-80 max-w-sm mx-auto">
                            Akses ribuan koleksi buku, ajukan peminjaman online, dan kelola akun keanggotaan Anda dengan mudah.
                        </p>
                    </div>
                </div>

                <!-- Right Side: Auth Actions -->
                <div class="p-8 sm:p-12 flex flex-col justify-center items-center">
                    <div class="w-full max-w-xs text-center animate-fade-in-up">
                        <h2 class="text-2xl font-bold text-secondary-800 mb-8">Selamat Datang</h2>
                        
                        <div class="space-y-4">
                            <a href="{{ route('login') }}" class="block w-full bg-primary-600 text-white font-semibold py-3 px-4 rounded-lg shadow-lg hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transition-transform transform hover:scale-105 duration-300 ease-in-out">
                                Masuk
                            </a>
                            
                            <a href="{{ route('register') }}" class="block w-full bg-secondary-200 text-secondary-800 font-semibold py-3 px-4 rounded-lg shadow-lg hover:bg-secondary-300 focus:outline-none focus:ring-2 focus:ring-secondary-400 focus:ring-offset-2 transition-transform transform hover:scale-105 duration-300 ease-in-out">
                                Daftar Akun Baru
                            </a>
                        </div>

                        <p class="mt-8 text-xs text-secondary-500">
                            © {{ date('Y') }} Perpustakaan Azfakun. All rights reserved.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
