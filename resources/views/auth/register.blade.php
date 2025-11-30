<x-guest-layout>
    <div class="relative min-h-screen bg-gradient-to-br from-primary-100 via-secondary-100 to-accent-100 flex items-center justify-center p-4 sm:p-6 lg:p-8 overflow-hidden">
        <!-- Enhanced Background Shapes -->
        <div class="absolute top-0 right-0 w-64 h-64 bg-primary-200 rounded-full opacity-50 translate-x-16 -translate-y-16 animate-float"></div>
        <div class="absolute bottom-0 left-0 w-72 h-72 bg-accent-200 rounded-full opacity-50 -translate-x-16 translate-y-16 animate-float" style="animation-delay: 2s"></div>
        <div class="absolute top-1/3 right-1/4 w-56 h-56 bg-secondary-200 rounded-full opacity-30 animate-float" style="animation-delay: 4s"></div>

        <!-- Floating Library Elements -->
        <div class="absolute top-16 left-20 animate-float opacity-20" style="animation-delay: 1s">
            <i class="fas fa-user-plus text-primary-400 text-5xl"></i>
        </div>
        <div class="absolute bottom-20 right-16 animate-float opacity-20" style="animation-delay: 3s">
            <i class="fas fa-book text-accent-400 text-4xl"></i>
        </div>
        <div class="absolute top-2/3 right-20 animate-page-turn opacity-10">
            <div class="w-18 h-22 bg-primary-300 rounded-sm shadow-xl"></div>
        </div>
        <div class="absolute bottom-1/3 left-20 animate-page-turn opacity-10" style="animation-delay: 2s">
            <div class="w-14 h-18 bg-accent-300 rounded-sm shadow-xl"></div>
        </div>

        <!-- Animated Ink Splatter -->
        <div class="absolute top-24 right-1/4 w-2 h-2 bg-primary-500 rounded-full animate-ink-flow opacity-60"></div>
        <div class="absolute bottom-16 left-1/3 w-3 h-3 bg-accent-500 rounded-full animate-ink-flow opacity-60" style="animation-delay: 1s"></div>
        <div class="absolute top-1/2 left-1/6 w-1.5 h-1.5 bg-secondary-500 rounded-full animate-ink-flow opacity-60" style="animation-delay: 0.5s"></div>

        <!-- Registration Form - Full Width -->
        <div class="w-full max-w-md mx-auto bg-white/80 backdrop-blur-xl rounded-3xl shadow-2xl p-8 sm:p-12 z-10 animate-fade-in">
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-primary-100 rounded-full mb-6 animate-parchment-glow">
                    <i class="fas fa-user-plus text-primary-600 text-3xl"></i>
                </div>
                <h2 class="text-3xl sm:text-4xl font-bold text-secondary-800 mb-3">Daftar Akun Baru</h2>
                <p class="text-secondary-600 text-lg">Bergabunglah dengan perpustakaan kami</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-6">
                @csrf

                <!-- Name -->
                <div>
                    <x-input-label for="name" value="Nama Lengkap" class="text-secondary-700 text-lg font-medium" />
                    <x-text-input id="name" class="block mt-2 w-full text-lg" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Nama Anda" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" value="Alamat Email" class="text-secondary-700 text-lg font-medium" />
                    <x-text-input id="email" class="block mt-2 w-full text-lg" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="contoh@email.com" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="password" value="Kata Sandi" class="text-secondary-700 text-lg font-medium" />
                    <x-text-input id="password" class="block mt-2 w-full text-lg" type="password" name="password" required autocomplete="new-password" placeholder="Minimal 8 karakter" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div>
                    <x-input-label for="password_confirmation" value="Konfirmasi Kata Sandi" class="text-secondary-700 text-lg font-medium" />
                    <x-text-input id="password_confirmation" class="block mt-2 w-full text-lg" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Ulangi kata sandi" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <!-- Submit Button -->
                <div class="pt-4">
                    <x-primary-button class="w-full flex justify-center py-4 text-lg font-semibold">
                        Daftar
                    </x-primary-button>
                </div>
            </form>

            <!-- Link to Login -->
            <p class="mt-8 text-center text-lg text-secondary-600">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="font-semibold text-primary-600 hover:text-primary-800 underline ml-2">
                    Masuk di sini
                </a>
            </p>
        </div>
    </div>
</x-guest-layout>
