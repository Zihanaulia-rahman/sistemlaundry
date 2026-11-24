<x-guest-layout>
    <div class="min-h-screen flex flex-col md:flex-row bg-[#FAFAFA]">
        <!-- Sisi Kiri: Panel Brand Klinzy Berwarna #FA699E dengan Pola Gelembung Bersih -->
        <div class="relative overflow-hidden md:w-1/2 lg:w-5/12 bg-[#FA699E] p-8 md:p-12 lg:p-16 flex flex-col justify-between text-white">
            <!-- Background Decorative Bubbles (Subtle SVG Elements) -->
            <div class="absolute -top-12 -left-12 w-48 h-48 rounded-full bg-white/10 pointer-events-none"></div>
            <div class="absolute top-1/4 -right-16 w-64 h-64 rounded-full bg-white/10 pointer-events-none"></div>
            <div class="absolute bottom-16 left-8 w-32 h-32 rounded-full bg-white/10 pointer-events-none"></div>
            <div class="absolute top-1/2 left-1/3 w-16 h-16 rounded-full bg-white/15 pointer-events-none"></div>
            <div class="absolute bottom-1/3 right-12 w-20 h-20 rounded-full bg-white/15 pointer-events-none"></div>

            <!-- Top Header Logo in White Container -->
            <div class="relative z-10 flex items-center gap-3">
                <div class="w-10 h-10 rounded-2xl bg-white flex items-center justify-center text-[#FA699E] shadow-sm">
                    <svg class="w-6 h-6 text-[#FA699E]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 2.69l5.66 5.66a8 8 0 1 1-11.31 0z" fill="currentColor" fill-opacity="0.2"></path>
                        <path d="M12 2.69l5.66 5.66a8 8 0 1 1-11.31 0z"></path>
                        <circle cx="10" cy="11" r="1.5" fill="currentColor" stroke="none"></circle>
                        <circle cx="14" cy="15" r="1" fill="currentColor" stroke="none"></circle>
                    </svg>
                </div>
                <div>
                    <span class="text-2xl font-extrabold tracking-tight text-white block leading-none">Klinzy</span>
                    <span class="text-[10px] font-semibold text-rose-100 tracking-wider uppercase">Smart Laundry Management</span>
                </div>
            </div>

            <!-- Center Tagline & Features -->
            <div class="relative z-10 my-12">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/20 text-xs font-semibold backdrop-blur-xs mb-4">
                    <span class="w-2 h-2 rounded-full bg-white animate-pulse"></span>
                    Sistem Kasir & Operasional Cerdas
                </div>
                <h1 class="text-3xl lg:text-4xl font-extrabold tracking-tight leading-tight text-white">
                    Kelola Cucian Lebih Cepat, Rapi, & Bersih.
                </h1>
                <p class="mt-4 text-sm text-rose-100 leading-relaxed max-w-sm">
                    Klinzy menghadirkan kemudahan input pesanan, kalkulasi otomatis tarif kilogram, dan pemantauan status lunas secara real-time.
                </p>

                <!-- Value Props Minimalis -->
                <div class="mt-8 space-y-3">
                    <div class="flex items-center gap-3 text-xs text-rose-50">
                        <div class="w-5 h-5 rounded-full bg-white/20 flex items-center justify-center shrink-0">✓</div>
                        <span>Kalkulasi tarif kilogram & rupiah otomatis</span>
                    </div>
                    <div class="flex items-center gap-3 text-xs text-rose-50">
                        <div class="w-5 h-5 rounded-full bg-white/20 flex items-center justify-center shrink-0">✓</div>
                        <span>Kontrol hak akses terpisah: Administrator & Kasir</span>
                    </div>
                    <div class="flex items-center gap-3 text-xs text-rose-50">
                        <div class="w-5 h-5 rounded-full bg-white/20 flex items-center justify-center shrink-0">✓</div>
                        <span>Pelacakan pembayaran (Lunas / Belum Lunas) 1 klik</span>
                    </div>
                </div>
            </div>

            <!-- Bottom Note -->
            <div class="relative z-10 text-xs text-rose-200">
                &copy; {{ date('Y') }} Klinzy Laundry System. All rights reserved.
            </div>
        </div>

        <!-- Sisi Kanan: Form Putih Bersih dengan Input rounded-xl dan Tombol #FA699E -->
        <div class="flex-1 flex flex-col justify-center px-6 sm:px-12 lg:px-20 py-12 bg-white">
            <div class="w-full max-w-md mx-auto">
                <div class="mb-8">
                    <h2 class="text-2xl font-bold tracking-tight text-[#1E293B]">
                        Selamat Datang Kembali
                    </h2>
                    <p class="text-sm text-slate-500 mt-1">
                        Masukkan email dan password untuk masuk ke dashboard Klinzy
                    </p>
                </div>

                <!-- Session Flash Message -->
                <x-auth-session-status class="mb-5 p-3 rounded-xl bg-[#FFF1F6] border border-[#F1E4E8] text-[#FA699E] text-sm font-medium" :status="session('status')" />

                @if ($errors->any())
                    <div class="mb-5 p-4 rounded-xl bg-rose-50 border border-rose-200 text-sm text-rose-800">
                        <div class="flex items-center gap-2 font-semibold mb-1">
                            <svg class="w-4 h-4 text-rose-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Gagal Masuk
                        </div>
                        <ul class="list-disc list-inside text-xs space-y-1 text-rose-700">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-4">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <x-input-label for="email" :value="__('Alamat Email')" />
                        <x-text-input 
                            id="email" 
                            type="email" 
                            name="email" 
                            :value="old('email')" 
                            required 
                            autofocus 
                            autocomplete="username" 
                            placeholder="nama@domain.com"
                        />
                        <x-input-error :messages="$errors->get('email')" class="mt-1.5" />
                    </div>

                    <!-- Password -->
                    <div>
                        <div class="flex items-center justify-between mb-1.5">
                            <x-input-label for="password" :value="__('Kata Sandi')" class="mb-0" />
                            @if (Route::has('password.request'))
                                <a class="text-xs font-semibold text-[#FA699E] hover:text-[#E14B82] hover:underline" href="{{ route('password.request') }}">
                                    Lupa sandi?
                                </a>
                            @endif
                        </div>
                        <x-text-input 
                            id="password" 
                            type="password"
                            name="password"
                            required 
                            autocomplete="current-password" 
                            placeholder="••••••••"
                        />
                        <x-input-error :messages="$errors->get('password')" class="mt-1.5" />
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center justify-between pt-1">
                        <label for="remember_me" class="inline-flex items-center cursor-pointer">
                            <input 
                                id="remember_me" 
                                type="checkbox" 
                                class="rounded border-[#F1E4E8] text-[#FA699E] focus:ring-[#FA699E] focus:ring-offset-0 transition" 
                                name="remember"
                            >
                            <span class="ms-2 text-xs text-slate-600 font-medium">Ingat saya di perangkat ini</span>
                        </label>
                    </div>

                    <!-- Submit Button #FA699E -->
                    <div class="pt-2">
                        <button 
                            type="submit" 
                            class="w-full py-3 px-4 rounded-xl text-sm font-bold text-white bg-[#FA699E] hover:bg-[#E14B82] active:bg-[#BF3367] transition-colors shadow-none cursor-pointer flex items-center justify-center gap-2"
                        >
                            <span>Masuk ke Akun</span>
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </button>
                    </div>
                </form>

                <!-- Navigasi Mulus Antara Login dan Register -->
                <div class="mt-8 pt-6 border-t border-[#F1E4E8] text-center">
                    <p class="text-xs text-slate-600">
                        Belum punya akun petugas? 
                        <a href="{{ route('register') }}" class="font-bold text-[#FA699E] hover:text-[#E14B82] hover:underline">
                            Daftar Akun Kasir di sini &rarr;
                        </a>
                    </p>
                </div>

                <!-- Info Akun Cepat -->
                <div class="mt-4 p-3 bg-[#FFF1F6] rounded-xl border border-[#F1E4E8] text-xs text-slate-600">
                    <div class="font-bold text-[#FA699E] mb-1">Akun Demo Tersedia:</div>
                    <div class="flex justify-between items-center text-[11px] py-0.5">
                        <span class="font-semibold text-slate-700">Admin:</span>
                        <code class="bg-white px-1.5 py-0.5 rounded border border-[#F1E4E8] text-slate-800">admin@gmail.com / admin123</code>
                    </div>
                    <div class="flex justify-between items-center text-[11px] py-0.5 mt-0.5">
                        <span class="font-semibold text-slate-700">Kasir:</span>
                        <code class="bg-white px-1.5 py-0.5 rounded border border-[#F1E4E8] text-slate-800">kasir@gmail.com / kasir123</code>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
