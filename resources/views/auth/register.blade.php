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
                    Gabung Tim Operasional Klinzy
                </div>
                <h1 class="text-3xl lg:text-4xl font-extrabold tracking-tight leading-tight text-white">
                    Mulai Kelola Pesanan Cuci Lebih Mudah.
                </h1>
                <p class="mt-4 text-sm text-rose-100 leading-relaxed max-w-sm">
                    Daftarkan akun staf baru untuk mendapatkan akses langsung ke modul kasir, pencatatan transaksi, dan status nota pelanggan.
                </p>

                <!-- Value Props Minimalis -->
                <div class="mt-8 space-y-3">
                    <div class="flex items-center gap-3 text-xs text-rose-50">
                        <div class="w-5 h-5 rounded-full bg-white/20 flex items-center justify-center shrink-0">✓</div>
                        <span>Akun otomatis terdaftar sebagai staf kasir resmi</span>
                    </div>
                    <div class="flex items-center gap-3 text-xs text-rose-50">
                        <div class="w-5 h-5 rounded-full bg-white/20 flex items-center justify-center shrink-0">✓</div>
                        <span>Form input transaksi kilat dan kalkulasi berat otomatis</span>
                    </div>
                    <div class="flex items-center gap-3 text-xs text-rose-50">
                        <div class="w-5 h-5 rounded-full bg-white/20 flex items-center justify-center shrink-0">✓</div>
                        <span>Terhubung langsung ke database rekapitulasi real-time</span>
                    </div>
                </div>
            </div>

            <!-- Bottom Note -->
            <div class="relative z-10 text-xs text-rose-200">
                &copy; {{ date('Y') }} Klinzy Laundry System. All rights reserved.
            </div>
        </div>

        <!-- Sisi Kanan: Form Register Bersih & Modern -->
        <div class="md:w-1/2 lg:w-7/12 flex items-center justify-center p-6 md:p-12 lg:p-16">
            <div class="w-full max-w-md">
                <!-- Mobile Brand Header (Tampil hanya di layar kecil) -->
                <div class="md:hidden flex items-center gap-3 mb-8">
                    <div class="w-10 h-10 rounded-2xl bg-[#FFF1F6] border border-[#F1E4E8] flex items-center justify-center text-[#FA699E]">
                        <svg class="w-6 h-6 text-[#FA699E]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 2.69l5.66 5.66a8 8 0 1 1-11.31 0z" fill="currentColor" fill-opacity="0.2"></path>
                            <path d="M12 2.69l5.66 5.66a8 8 0 1 1-11.31 0z"></path>
                            <circle cx="10" cy="11" r="1.5" fill="currentColor" stroke="none"></circle>
                            <circle cx="14" cy="15" r="1" fill="currentColor" stroke="none"></circle>
                        </svg>
                    </div>
                    <div>
                        <span class="text-xl font-bold tracking-tight text-[#1E293B]">Klinzy</span>
                        <span class="text-[10px] font-semibold text-slate-500 tracking-wider uppercase block">Smart Laundry Management</span>
                    </div>
                </div>

                <div class="mb-8">
                    <h2 class="text-2xl font-extrabold tracking-tight text-[#1E293B]">
                        Daftar Akun Baru
                    </h2>
                    <p class="mt-2 text-sm text-slate-500">
                        Buat akun pengguna baru untuk mulai mengoperasikan sistem kasir Klinzy.
                    </p>
                </div>

                <!-- Alert Error Validasi -->
                @if ($errors->any())
                    <div class="mb-6 p-4 rounded-xl bg-rose-50 border border-rose-200 text-sm text-rose-800">
                        <div class="flex items-center gap-2 font-semibold mb-1">
                            <svg class="w-4 h-4 text-rose-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Pendaftaran Akun Gagal
                        </div>
                        <ul class="list-disc list-inside text-xs space-y-1 text-rose-700">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}" class="space-y-4">
                    @csrf

                    <!-- Nama Lengkap -->
                    <div>
                        <x-input-label for="name" :value="__('Nama Lengkap')" class="text-xs font-semibold text-slate-700 uppercase tracking-wider" />
                        <div class="mt-1 relative">
                            <x-text-input 
                                id="name" 
                                type="text" 
                                name="name" 
                                :value="old('name')" 
                                required 
                                autofocus 
                                autocomplete="name" 
                                placeholder="Contoh: Salsabila Putri"
                                class="w-full pl-10"
                            />
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                        </div>
                        <x-input-error :messages="$errors->get('name')" class="mt-1.5" />
                    </div>

                    <!-- Alamat Email -->
                    <div>
                        <x-input-label for="email" :value="__('Alamat Email')" class="text-xs font-semibold text-slate-700 uppercase tracking-wider" />
                        <div class="mt-1 relative">
                            <x-text-input 
                                id="email" 
                                type="email" 
                                name="email" 
                                :value="old('email')" 
                                required 
                                autocomplete="username" 
                                placeholder="nama@klinzy.id"
                                class="w-full pl-10"
                            />
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                </svg>
                            </div>
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-1.5" />
                    </div>

                    <!-- Kata Sandi -->
                    <div>
                        <x-input-label for="password" :value="__('Kata Sandi')" class="text-xs font-semibold text-slate-700 uppercase tracking-wider" />
                        <div class="mt-1 relative">
                            <x-text-input 
                                id="password" 
                                type="password" 
                                name="password" 
                                required 
                                autocomplete="new-password" 
                                placeholder="Minimal 8 karakter"
                                class="w-full pl-10"
                            />
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-1.5" />
                    </div>

                    <!-- Konfirmasi Kata Sandi -->
                    <div>
                        <x-input-label for="password_confirmation" :value="__('Konfirmasi Kata Sandi')" class="text-xs font-semibold text-slate-700 uppercase tracking-wider" />
                        <div class="mt-1 relative">
                            <x-text-input 
                                id="password_confirmation" 
                                type="password" 
                                name="password_confirmation" 
                                required 
                                autocomplete="new-password" 
                                placeholder="Ulangi kata sandi"
                                class="w-full pl-10"
                            />
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                            </div>
                        </div>
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1.5" />
                    </div>

                    <!-- Role Info Note -->
                    <div class="p-3 rounded-xl bg-[#FFF1F6] border border-[#F1E4E8] flex items-center gap-2.5 text-xs text-[#FA699E]">
                        <svg class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>Pendaftaran ini akan otomatis terdaftar sebagai <strong>Role: Kasir</strong>.</span>
                    </div>

                    <!-- Tombol Register -->
                    <div class="pt-2">
                        <x-primary-button class="w-full justify-center py-3 text-sm font-bold tracking-wide">
                            {{ __('Daftar Sekarang') }}
                        </x-primary-button>
                    </div>
                </form>

                <!-- Footer Navigasi ke Login -->
                <div class="mt-8 pt-6 border-t border-[#F1E4E8] text-center">
                    <p class="text-sm text-slate-600">
                        Sudah punya akun?
                        <a href="{{ route('login') }}" class="font-bold text-[#FA699E] hover:text-[#E14B82] transition duration-150 underline-offset-4 hover:underline">
                            Masuk di sini
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
