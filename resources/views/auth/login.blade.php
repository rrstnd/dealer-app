<x-guest-layout>
    <div class="space-y-6">

        {{-- BRANDING & HEADER --}}
        <div class="text-center space-y-3">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-3 group">
                <div class="w-12 h-12 rounded-2xl bg-slate-900 flex items-center justify-center text-white font-black text-2xl shadow-lg shadow-slate-900/20 group-hover:scale-105 transition duration-200">
                    S
                </div>
            </a>
            <div>
                <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">
                    Suja <span class="text-blue-600">MobilIndo</span>
                </h1>
                <span class="inline-block mt-1 text-[11px] font-bold uppercase tracking-wider text-slate-500 bg-slate-100 px-2.5 py-0.5 rounded-full border border-slate-200/80">
                    Portal Management Admin
                </span>
            </div>
            <p class="text-xs text-slate-500 max-w-xs mx-auto">
                Silakan masuk untuk mengelola katalog, inventaris unit, dan transaksi showroom.
            </p>
        </div>

        {{-- LOGIN CARD CONTAINER --}}
        <div class="bg-white border border-slate-200/80 rounded-3xl p-6 sm:p-8 shadow-xl shadow-slate-200/50 backdrop-blur-xl">

            <!-- Session Status Alert -->
            <x-auth-session-status class="mb-5 text-sm text-emerald-600 font-semibold bg-emerald-50 p-3.5 rounded-xl border border-emerald-100" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <!-- EMAIL ADDRESS -->
                <div class="space-y-1.5">
                    <label for="email" class="block text-xs font-bold text-slate-700 uppercase tracking-wider">
                        Alamat Email
                    </label>
                    <input id="email" 
                           type="email" 
                           name="email" 
                           value="{{ old('email') }}" 
                           required 
                           autofocus 
                           autocomplete="username"
                           class="w-full px-4 py-3 bg-slate-50 border border-slate-200/80 rounded-xl text-sm font-medium text-slate-900 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-600/20 focus:border-blue-600 transition shadow-xs" />
                    <x-input-error :messages="$errors->get('email')" class="text-xs text-rose-500 font-medium mt-1" />
                </div>

                <!-- PASSWORD -->
                <div x-data="{ showPassword: false }" class="space-y-1.5">
                    <label for="password" class="block text-xs font-bold text-slate-700 uppercase tracking-wider">
                        Kata Sandi
                    </label>
                    <div class="relative rounded-xl shadow-xs">
                        <input id="password" 
                               :type="showPassword ? 'text' : 'password'" 
                               name="password" 
                               required 
                               autocomplete="current-password"
                               class="w-full pl-4 pr-12 py-3 bg-slate-50 border border-slate-200/80 rounded-xl text-sm font-medium text-slate-900 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-600/20 focus:border-blue-600 transition" />
                        
                        <!-- Toggle Password Visibility (Eye Button) -->
                        <button type="button" 
                                @click="showPassword = !showPassword" 
                                class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-slate-600 focus:outline-none cursor-pointer transition"
                                title="Tampilkan / Sembunyikan Kata Sandi">
                            <!-- Eye Open Icon (Shows when password is hidden) -->
                            <svg x-show="!showPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            <!-- Eye Off / Slash Icon (Shows when password is visible) -->
                            <svg x-show="showPassword" x-cloak class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858-5.908a10.025 10.025 0 014.122-.863c4.478 0 8.268 2.943 9.542 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21M3 3l18 18" />
                            </svg>
                        </button>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="text-xs text-rose-500 font-medium mt-1" />
                </div>

                <!-- REMEMBER ME & FORGOT PASSWORD -->
                <div class="flex items-center justify-between pt-1">
                    <label for="remember_me" class="inline-flex items-center gap-2 cursor-pointer select-none">
                        <input id="remember_me" 
                               type="checkbox" 
                               name="remember"
                               class="w-4 h-4 rounded border-slate-300 text-blue-600 shadow-xs focus:ring-blue-500 focus:ring-offset-0 cursor-pointer transition">
                        <span class="text-xs font-semibold text-slate-600">Ingat Saya</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-xs font-semibold text-blue-600 hover:text-blue-700 hover:underline transition">
                            Lupa kata sandi?
                        </a>
                    @endif
                </div>

                <!-- SUBMIT BUTTON -->
                <button type="submit" 
                        class="w-full inline-flex items-center justify-center gap-2 bg-slate-900 hover:bg-blue-600 text-white font-bold text-sm py-3.5 px-5 rounded-xl shadow-lg shadow-slate-900/15 hover:shadow-blue-600/25 transition duration-200 active:scale-[0.99] cursor-pointer">
                    <span>Masuk ke Portal Admin</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </button>
            </form>
        </div>

        {{-- BACK TO WEBSITE LINK --}}
        <div class="text-center pt-2">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-xs font-bold text-slate-600 hover:text-slate-900 transition group">
                <svg class="w-4 h-4 text-slate-400 group-hover:-translate-x-1 transition duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                <span>Kembali ke Website Utama</span>
            </a>
        </div>

    </div>
</x-guest-layout>

