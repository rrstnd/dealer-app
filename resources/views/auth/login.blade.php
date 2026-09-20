<x-guest-layout>
    <div class="space-y-6">

        {{-- BRANDING & HEADER --}}
        <div class="text-center space-y-3">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-3 group">
                <img src="{{ asset('images/logo.png') }}" alt="SUJA MOBILINDO"
                     class="w-16 h-16 rounded-full object-cover shadow-xl shadow-black/40 group-hover:scale-105 transition duration-200 border border-zinc-800">
            </a>
            <div>
                <h1 class="text-2xl font-light text-white tracking-[0.2em] uppercase">
                    SUJA <span class="font-black text-white">MOBILINDO</span>
                </h1>
                <div class="w-10 h-0.5 bg-[#881337] mx-auto mt-2"></div>
                <span class="inline-block mt-3 text-[10px] font-bold uppercase tracking-[0.25em] text-rose-400 bg-rose-950/40 px-3 py-1 border border-rose-900/60 font-mono-code">
                    PORTAL MANAJEMEN RESMI
                </span>
            </div>
            <p class="text-xs text-zinc-400 max-w-xs mx-auto font-light">
                Silakan masuk untuk mengelola inventaris unit, katalog showroom, dan transaksi penjualan.
            </p>
        </div>

        {{-- LOGIN CARD CONTAINER (CARITA OBSIDIAN DESIGN) --}}
        <div class="bg-zinc-900/90 border border-zinc-800 p-6 sm:p-8 shadow-2xl backdrop-blur-xl">

            <!-- Session Status Alert -->
            <x-auth-session-status class="mb-5 text-xs text-emerald-400 font-semibold bg-emerald-950/40 p-3.5 border border-emerald-800/80" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <!-- EMAIL ADDRESS -->
                <div class="space-y-1.5">
                    <label for="email" class="block text-[11px] font-bold text-zinc-300 uppercase tracking-widest">
                        Alamat Email
                    </label>
                    <input id="email" 
                           type="email" 
                           name="email" 
                           value="{{ old('email') }}" 
                           required 
                           autofocus 
                           autocomplete="username"
                           placeholder="admin@dealer.com"
                           class="w-full px-4 py-3 bg-zinc-950/80 border border-zinc-700 text-xs font-medium text-white placeholder-zinc-500 focus:bg-black focus:border-rose-500 focus:outline-none transition rounded-none shadow-xs" />
                    <x-input-error :messages="$errors->get('email')" class="text-xs text-rose-400 font-medium mt-1" />
                </div>

                <!-- PASSWORD -->
                <div x-data="{ showPassword: false }" class="space-y-1.5">
                    <label for="password" class="block text-[11px] font-bold text-zinc-300 uppercase tracking-widest">
                        Kata Sandi
                    </label>
                    <div class="relative shadow-xs">
                        <input id="password" 
                               :type="showPassword ? 'text' : 'password'" 
                               name="password" 
                               required 
                               autocomplete="current-password"
                               placeholder="••••••••"
                               class="w-full pl-4 pr-12 py-3 bg-zinc-950/80 border border-zinc-700 text-xs font-medium text-white placeholder-zinc-500 focus:bg-black focus:border-rose-500 focus:outline-none transition rounded-none" />
                        
                        <!-- Toggle Password Visibility (Eye Button) -->
                        <button type="button" 
                                @click="showPassword = !showPassword" 
                                class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-zinc-400 hover:text-white focus:outline-none cursor-pointer transition"
                                title="Tampilkan / Sembunyikan Kata Sandi">
                            <!-- Eye Open Icon -->
                            <svg x-show="!showPassword" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            <!-- Eye Off / Slash Icon -->
                            <svg x-show="showPassword" x-cloak class="w-4 h-4 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858-5.908a10.025 10.025 0 014.122-.863c4.478 0 8.268 2.943 9.542 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21M3 3l18 18" />
                            </svg>
                        </button>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="text-xs text-rose-400 font-medium mt-1" />
                </div>

                <!-- REMEMBER ME & FORGOT PASSWORD -->
                <div class="flex items-center justify-between pt-1">
                    <label for="remember_me" class="inline-flex items-center gap-2 cursor-pointer select-none">
                        <input id="remember_me" 
                               type="checkbox" 
                               name="remember"
                               class="w-4 h-4 rounded-none border-zinc-700 bg-zinc-950 text-rose-600 focus:ring-0 cursor-pointer transition">
                        <span class="text-xs text-zinc-400">Ingat Sesi Saya</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-xs font-medium text-zinc-400 hover:text-rose-400 hover:underline transition">
                            Lupa kata sandi?
                        </a>
                    @endif
                </div>

                <!-- SUBMIT BUTTON -->
                <button type="submit" 
                        class="w-full inline-flex items-center justify-center gap-2 bg-white hover:bg-zinc-200 text-zinc-950 hover:text-black font-bold text-xs tracking-[0.2em] uppercase py-3.5 px-5 transition duration-200 cursor-pointer shadow-md rounded-none">
                    <span>Masuk ke Portal Admin</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </button>
            </form>
        </div>

        {{-- BACK TO WEBSITE LINK --}}
        <div class="text-center pt-2">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-zinc-400 hover:text-white transition group">
                <svg class="w-4 h-4 text-zinc-500 group-hover:-translate-x-1 transition duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                <span>Kembali ke Website Utama</span>
            </a>
        </div>

    </div>
</x-guest-layout>
