<x-guest-layout>
    <div class="relative min-h-screen bg-gradient-to-br from-primary-100 via-secondary-100 to-accent-100 flex items-center justify-center p-4 sm:p-6 lg:p-8 overflow-hidden">
        <!-- Enhanced Background Shapes -->
        <div class="absolute top-0 left-0 w-64 h-64 bg-primary-200 rounded-full opacity-50 -translate-x-16 -translate-y-16 animate-float"></div>
        <div class="absolute bottom-0 right-0 w-72 h-72 bg-accent-200 rounded-full opacity-50 translate-x-16 translate-y-16 animate-float" style="animation-delay: 2s"></div>
        <div class="absolute top-1/2 left-1/2 w-48 h-48 bg-secondary-200 rounded-full opacity-30 -translate-x-1/2 -translate-y-1/2 animate-float" style="animation-delay: 4s"></div>

        <!-- Floating Library Elements -->
        <div class="absolute top-20 right-20 animate-float opacity-20" style="animation-delay: 1s">
            <i class="fas fa-book text-primary-400 text-5xl"></i>
        </div>
        <div class="absolute bottom-32 left-16 animate-float opacity-20" style="animation-delay: 3s">
            <i class="fas fa-feather text-accent-400 text-4xl"></i>
        </div>
        <div class="absolute top-1/3 left-10 animate-page-turn opacity-10">
            <div class="w-20 h-24 bg-primary-300 rounded-sm shadow-xl"></div>
        </div>
        <div class="absolute bottom-1/4 right-10 animate-page-turn opacity-10" style="animation-delay: 2s">
            <div class="w-16 h-20 bg-accent-300 rounded-sm shadow-xl"></div>
        </div>

        <!-- Animated Ink Splatter -->
        <div class="absolute top-16 left-1/4 w-2 h-2 bg-primary-500 rounded-full animate-ink-flow opacity-60"></div>
        <div class="absolute bottom-20 right-1/3 w-3 h-3 bg-accent-500 rounded-full animate-ink-flow opacity-60" style="animation-delay: 1s"></div>

        <!-- Login Form - Full Width -->
        <div class="w-full max-w-md mx-auto bg-white/80 backdrop-blur-xl rounded-3xl shadow-2xl p-8 sm:p-12 z-10 animate-fade-in">
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-primary-100 rounded-full mb-6 animate-parchment-glow">
                    <i class="fas fa-sign-in-alt text-primary-600 text-3xl"></i>
                </div>
                <h2 class="text-3xl sm:text-4xl font-bold text-secondary-800 mb-3">Login Anggota</h2>
                <p class="text-secondary-600 text-lg">Masuk ke akun perpustakaan Anda</p>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-6" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" value="Alamat Email" class="text-secondary-700 text-lg font-medium" />
                    <x-text-input id="email" class="block mt-2 w-full text-lg" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="contoh@email.com" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="password" value="Kata Sandi" class="text-secondary-700 text-lg font-medium" />
                    <x-text-input id="password" class="block mt-2 w-full text-lg" type="password" name="password" required autocomplete="current-password" placeholder="••••••••" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between text-sm">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-secondary-300 text-primary-600 shadow-sm focus:ring-primary-500" name="remember">
                        <span class="ml-2 text-secondary-600">Ingat Saya</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a class="underline text-secondary-600 hover:text-primary-600 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500" href="{{ route('password.request') }}">
                            Lupa Kata Sandi?
                        </a>
                    @endif
                </div>

                <!-- Submit Button -->
                <div class="pt-4">
                    <x-primary-button class="w-full flex justify-center py-4 text-lg font-semibold">
                        Masuk
                    </x-primary-button>
                </div>
            </form>

            <!-- Link to Register -->
            <p class="mt-8 text-center text-lg text-secondary-600">
                Belum punya akun?
                <a href="{{ route('register') }}" class="font-semibold text-primary-600 hover:text-primary-800 underline ml-2">
                    Daftar di sini
                </a>
            </p>
        </div>
    </div>
</x-guest-layout>
