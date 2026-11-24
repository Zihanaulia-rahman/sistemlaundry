<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Klinzy') }} - Smart Laundry Management</title>

        <!-- Google Fonts: Plus Jakarta Sans -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

        <!-- Scripts & Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="h-full bg-[#FAFAFA] font-sans text-[#1E293B] antialiased" x-data="{ sidebarOpen: false }">
        <div class="min-h-screen flex flex-col lg:flex-row">
            <!-- Mobile Off-Canvas Backdrop -->
            <div 
                x-show="sidebarOpen" 
                x-transition:enter="transition-opacity ease-linear duration-200"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition-opacity ease-linear duration-200"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                @click="sidebarOpen = false" 
                class="fixed inset-0 z-40 bg-slate-900/40 backdrop-blur-xs lg:hidden"
                style="display: none;"
            ></div>

            <!-- Fixed Desktop & Off-Canvas Mobile Sidebar -->
            <aside 
                :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
                class="fixed inset-y-0 left-0 z-50 w-64 bg-white border-r border-[#F1E4E8] flex flex-col justify-between transition-transform duration-200 ease-in-out lg:static lg:inset-auto lg:h-screen lg:shrink-0"
            >
                <div class="flex flex-col h-full">
                    <!-- Brand Logo -->
                    <div class="h-16 flex items-center justify-between px-6 border-b border-[#F1E4E8]">
                        <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-xl bg-[#FFF1F6] border border-[#F1E4E8] flex items-center justify-center text-[#FA699E]">
                                <svg class="w-5 h-5 text-[#FA699E]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M12 2.69l5.66 5.66a8 8 0 1 1-11.31 0z" fill="currentColor" fill-opacity="0.2"></path>
                                    <path d="M12 2.69l5.66 5.66a8 8 0 1 1-11.31 0z"></path>
                                    <circle cx="10" cy="11" r="1.5" fill="currentColor" stroke="none"></circle>
                                    <circle cx="14" cy="15" r="1" fill="currentColor" stroke="none"></circle>
                                </svg>
                            </div>
                            <div>
                                <span class="font-extrabold text-base text-[#1E293B] tracking-tight block leading-none">Klinzy</span>
                                <span class="text-[10px] font-semibold text-[#FA699E] tracking-wider uppercase">Smart Laundry</span>
                            </div>
                        </a>
                        <button @click="sidebarOpen = false" class="lg:hidden text-slate-400 hover:text-slate-600 p-1">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <!-- Navigation Links Berdasarkan Role -->
                    <div class="flex-1 px-4 py-5 space-y-1.5 overflow-y-auto">
                        <div class="px-3 pb-2 text-[11px] font-bold uppercase tracking-wider text-slate-400">
                            Menu Utama
                        </div>

                        <!-- 1. Dashboard (Tampil untuk Admin & Kasir) -->
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard') || request()->routeIs('admin.dashboard')">
                            <svg class="w-5 h-5 shrink-0 {{ (request()->routeIs('dashboard') || request()->routeIs('admin.dashboard')) ? 'text-[#FA699E]' : 'text-slate-400' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            <span>Dashboard</span>
                        </x-nav-link>

                        <!-- Pengecekan Menu Khusus Role Admin -->
                        @if(auth()->check() && auth()->user()->role === 'admin')
                            <!-- 2. Data Layanan (Khusus Admin: Tambah/Edit/Hapus Paket Cuci) -->
                            <x-nav-link :href="route('laundry_items.index')" :active="request()->routeIs('laundry_items.*')">
                                <svg class="w-5 h-5 shrink-0 {{ request()->routeIs('laundry_items.*') ? 'text-[#FA699E]' : 'text-slate-400' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                </svg>
                                <span>Data Layanan</span>
                            </x-nav-link>

                            <!-- 3. Rekap Transaksi (Untuk Admin) -->
                            <x-nav-link :href="route('customer.index')" :active="request()->routeIs('customer.index')">
                                <svg class="w-5 h-5 shrink-0 {{ request()->routeIs('customer.index') ? 'text-[#FA699E]' : 'text-slate-400' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <span>Rekap Transaksi</span>
                            </x-nav-link>
                        @else
                            <!-- Menu Khusus Kasir: Hanya Dashboard & Transaksi Laundry (Data Layanan Disembunyikan) -->
                            <x-nav-link :href="route('customer.index')" :active="request()->routeIs('customer.index')">
                                <svg class="w-5 h-5 shrink-0 {{ request()->routeIs('customer.index') ? 'text-[#FA699E]' : 'text-slate-400' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                                </svg>
                                <span>Transaksi Laundry</span>
                            </x-nav-link>
                        @endif
                    </div>

                    <!-- Sidebar Footer: Role Info Card -->
                    <div class="p-3 m-3 rounded-xl border text-xs {{ (auth()->check() && auth()->user()->role === 'admin') ? 'bg-[#FFF1F6] border-[#F1E4E8] text-[#FA699E]' : 'bg-slate-50 border-slate-200 text-slate-700' }}">
                        <div class="font-bold flex items-center justify-between">
                            <span>Mode Akses</span>
                            <span class="uppercase tracking-wider text-[10px] px-2 py-0.5 rounded-full {{ (auth()->check() && auth()->user()->role === 'admin') ? 'bg-[#FA699E] text-white' : 'bg-slate-600 text-white' }}">
                                {{ auth()->user()->role ?? 'Guest' }}
                            </span>
                        </div>
                        <p class="text-[11px] mt-1 text-slate-500 leading-tight">
                            {{ (auth()->check() && auth()->user()->role === 'admin') ? 'Hak akses penuh master data & rekap bisnis.' : 'Akses operasional harian kasir & transaksi.' }}
                        </p>
                    </div>
                </div>
            </aside>

            <!-- Main Content Container (With Header & Slot) -->
            <div class="flex-1 flex flex-col min-w-0 min-h-screen">
                <!-- Top Header -->
                <header class="h-16 bg-white border-b border-[#F1E4E8] px-4 sm:px-6 lg:px-8 flex items-center justify-between sticky top-0 z-30 shadow-none">
                    <div class="flex items-center gap-3">
                        <!-- Mobile Hamburger Button -->
                        <button 
                            @click="sidebarOpen = true" 
                            class="lg:hidden p-2 rounded-xl text-slate-600 hover:text-slate-900 hover:bg-slate-100 focus:outline-none"
                            aria-label="Buka Menu"
                        >
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>

                        <div class="font-semibold text-base text-[#1E293B]">
                            {{ $headerTitle ?? 'Klinzy Smart Management' }}
                        </div>
                    </div>

                    <!-- Right Side: User Profile, Role Badge Khusus, Logout -->
                    <div class="flex items-center gap-3 sm:gap-4">
                        @auth
                            <!-- User info & Role Badge Khusus Sesuai Role -->
                            <div class="flex items-center gap-2.5">
                                <div class="w-8 h-8 rounded-full border flex items-center justify-center font-bold text-xs {{ auth()->user()->role === 'admin' ? 'bg-[#FFF1F6] border-[#F1E4E8] text-[#FA699E]' : 'bg-slate-100 border-slate-200 text-slate-700' }}">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                                </div>
                                <div class="hidden sm:block text-left">
                                    <div class="text-sm font-semibold text-[#1E293B] leading-tight">
                                        {{ Auth::user()->name }}
                                    </div>
                                    <div class="text-[11px] text-slate-500 leading-none">
                                        {{ Auth::user()->email }}
                                    </div>
                                </div>

                                <!-- Badge Warna Khusus: Role: Admin vs Role: Kasir -->
                                @if(auth()->user()->role === 'admin')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-[#FFF1F6] text-[#FA699E] border border-[#F1E4E8]">
                                        <span class="w-1.5 h-1.5 rounded-full bg-[#FA699E]"></span>
                                        Role: Admin
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-sky-50 text-sky-700 border border-sky-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-sky-500"></span>
                                        Role: Kasir
                                    </span>
                                @endif
                            </div>

                            <div class="h-5 w-px bg-[#F1E4E8] hidden sm:block"></div>

                            <!-- Logout Button -->
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button 
                                    type="submit" 
                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl text-xs font-medium text-slate-600 hover:text-rose-700 hover:bg-rose-50 border border-slate-200 hover:border-rose-200 transition-colors cursor-pointer"
                                    title="Keluar dari sistem"
                                >
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>
                                    <span class="hidden sm:inline">Logout</span>
                                </button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="inline-flex items-center px-4 py-2 rounded-xl text-xs font-semibold bg-[#FA699E] hover:bg-[#E14B82] text-white transition-colors">
                                Masuk
                            </a>
                        @endauth
                    </div>
                </header>

                <!-- Page Subheader / Breadcrumbs (Optional) -->
                @isset($header)
                    <div class="bg-white border-b border-[#F1E4E8] px-4 sm:px-6 lg:px-8 py-4">
                        {{ $header }}
                    </div>
                @endisset

                <!-- Main Content Area -->
                <main class="flex-1 p-4 sm:p-6 lg:p-8 bg-[#FAFAFA]">
                    {{ $slot }}
                </main>
            </div>
        </div>
    </body>
</html>
