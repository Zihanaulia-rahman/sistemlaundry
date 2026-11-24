<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                @if(auth()->user()->role === 'admin')
                    <h1 class="text-xl font-bold text-[#1E293B] tracking-tight">Dashboard Ringkasan Bisnis & Rekap</h1>
                    <p class="text-xs text-slate-500 mt-0.5">Analisis performa pendapatan laundry, status pembayaran pelanggan, dan seluruh riwayat transaksi.</p>
                @else
                    <h1 class="text-xl font-bold text-[#1E293B] tracking-tight">Panel Operasional Harian Kasir</h1>
                    <p class="text-xs text-slate-500 mt-0.5">Kelola antrean masuk, pantau status pembayaran, dan selesaikan cucian siap ambil.</p>
                @endif
            </div>

            <!-- Tombol Aksi di Header Sesuai Role -->
            <div class="flex items-center gap-2.5">
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('laundry_items.index') }}" class="inline-flex items-center gap-1.5 px-3.5 py-2 bg-white hover:bg-slate-50 text-slate-700 text-xs font-semibold rounded-xl border border-[#F1E4E8] transition-colors shadow-none">
                        <svg class="w-4 h-4 text-[#FA699E]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                        Kelola Data Layanan
                    </a>
                @endif

                <!-- Tombol Cepat Input Transaksi Baru -->
                <a href="{{ route('customer.index') }}" class="inline-flex items-center gap-1.5 px-4 py-2 bg-[#FA699E] hover:bg-[#E14B82] active:bg-[#c93b6e] text-white text-xs font-bold rounded-xl transition-colors shadow-none cursor-pointer">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    + Input Transaksi Baru
                </a>
            </div>
        </div>
    </x-slot>

    <!-- State Filter Menggunakan AlpineJS: activeFilter (Pengerjaan) & activePayFilter (Pembayaran) -->
    <div class="space-y-6" x-data="{ activeFilter: 'semua', activePayFilter: 'semua' }">
        <!-- Notifikasi Pesan Sukses / Error / Peringatan Redirect -->
        @if(session('success'))
            <div class="p-4 rounded-xl bg-[#FFF1F6] border border-[#F1E4E8] text-[#FA699E] text-sm flex items-center justify-between">
                <div class="flex items-center gap-2.5">
                    <svg class="w-5 h-5 text-[#FA699E] shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="font-semibold text-slate-800">{{ session('success') }}</span>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-900 text-sm flex items-center gap-2.5">
                <svg class="w-5 h-5 text-rose-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="font-bold">{{ session('error') }}</span>
            </div>
        @endif

        @php
            $totalOrders = $orders->count();
            $prosesOrders = $orders->filter(function($o) {
                $st = strtolower($o->status);
                return in_array($st, ['pending', 'proses cuci', 'proses']);
            })->count();
            $selesaiOrders = $orders->filter(function($o) {
                $st = strtolower($o->status);
                return in_array($st, ['completed', 'selesai', 'diambil']);
            })->count();

            // Perhitungan Status Pembayaran
            $ordersLunas = $orders->filter(fn($o) => strtolower($o->status_bayar ?? 'belum lunas') === 'lunas');
            $ordersBelumLunas = $orders->filter(fn($o) => strtolower($o->status_bayar ?? 'belum lunas') !== 'lunas');

            $countLunas = $ordersLunas->count();
            $countBelumLunas = $ordersBelumLunas->count();

            $totalPemasukanLunas = $ordersLunas->sum('total_price');
            $totalTagihanBelumLunas = $ordersBelumLunas->sum('total_price');
        @endphp

        <!-- ======================================================= -->
        <!-- KARTU RINGKASAN ATAS: TOTAL PEMASUKAN LUNAS & BELUM LUNAS-->
        <!-- ======================================================= -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <!-- 1. Total Pemasukan Lunas -->
            <div class="bg-white p-5 rounded-xl border border-[#F1E4E8] shadow-none">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Total Pemasukan Lunas</span>
                    <span class="p-1.5 rounded-lg bg-emerald-50 text-emerald-700 border border-emerald-200">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </span>
                </div>
                <div class="mt-3 text-2xl font-extrabold text-emerald-700 tabular-nums">
                    Rp {{ number_format($totalPemasukanLunas, 0, ',', '.') }}
                </div>
                <div class="mt-1 text-xs text-slate-400">Dari {{ $countLunas }} transaksi telah lunas</div>
            </div>

            <!-- 2. Total Tagihan Belum Lunas -->
            <div class="bg-white p-5 rounded-xl border border-[#F1E4E8] shadow-none">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Tagihan Belum Lunas</span>
                    <span class="p-1.5 rounded-lg bg-rose-50 text-rose-700 border border-rose-200">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </span>
                </div>
                <div class="mt-3 text-2xl font-extrabold text-rose-600 tabular-nums">
                    Rp {{ number_format($totalTagihanBelumLunas, 0, ',', '.') }}
                </div>
                <div class="mt-1 text-xs text-slate-400">Dari {{ $countBelumLunas }} transaksi belum bayar</div>
            </div>

            <!-- 3. Status Cucian Dalam Pengerjaan -->
            <div class="bg-white p-5 rounded-xl border border-[#F1E4E8] shadow-none">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Dalam Pengerjaan</span>
                    <span class="w-2.5 h-2.5 rounded-full bg-amber-500 animate-pulse"></span>
                </div>
                <div class="mt-3 text-2xl font-extrabold text-amber-600 tabular-nums">
                    {{ $prosesOrders }} <span class="text-sm font-semibold text-slate-500">cucian</span>
                </div>
                <div class="mt-1 text-xs text-slate-400">Perlu diproses hari ini</div>
            </div>

            <!-- 4. Total Seluruh Transaksi / Cucian Selesai -->
            <div class="bg-white p-5 rounded-xl border border-[#F1E4E8] shadow-none">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Cucian Selesai</span>
                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span>
                </div>
                <div class="mt-3 text-2xl font-extrabold text-[#1E293B] tabular-nums">
                    {{ $selesaiOrders }} <span class="text-sm font-normal text-slate-500">/ {{ $totalOrders }} pesanan</span>
                </div>
                <div class="mt-1 text-xs text-emerald-600 font-medium">Siap diserahkan ke pelanggan</div>
            </div>
        </div>

        <!-- ============================================================== -->
        <!-- TABEL REKAP TRANSAKSI DENGAN STATUS BAYAR & STATUS PENGERJAAN -->
        <!-- ============================================================== -->
        <div class="bg-white rounded-xl border border-[#F1E4E8] overflow-hidden shadow-none">
            <!-- Header Card dengan Filter Ganda (Status Bayar & Status Pengerjaan) -->
            <div class="px-6 py-4 border-b border-[#F1E4E8] flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                <div>
                    <h2 class="text-sm font-bold text-[#1E293B] uppercase tracking-wider">
                        {{ auth()->user()->role === 'admin' ? 'Rekap Seluruh Transaksi Laundry' : 'Daftar Antrean & Transaksi Kasir' }}
                    </h2>
                    <p class="text-xs text-slate-500 mt-0.5">
                        Pantau pembayaran dan status pengerjaan cucian pelanggan secara real-time.
                    </p>
                </div>

                <!-- Bagian Filter Berdasarkan Status Pembayaran & Pengerjaan -->
                <div class="flex flex-wrap items-center gap-2">
                    <!-- Filter Status Pembayaran (Semua, Lunas, Belum Lunas) -->
                    <div class="inline-flex items-center p-1 rounded-xl bg-slate-100 border border-slate-200 text-xs font-semibold">
                        <span class="px-2 text-[10px] uppercase font-bold text-slate-400">Bayar:</span>
                        <button 
                            type="button" 
                            @click="activePayFilter = 'semua'"
                            :class="activePayFilter === 'semua' ? 'bg-white text-slate-900 shadow-xs border border-slate-200/80 font-bold' : 'text-slate-600 hover:text-slate-900'"
                            class="px-2.5 py-1 rounded-lg transition-colors cursor-pointer"
                        >
                            Semua
                        </button>
                        <button 
                            type="button" 
                            @click="activePayFilter = 'lunas'"
                            :class="activePayFilter === 'lunas' ? 'bg-white text-emerald-700 shadow-xs border border-slate-200/80 font-bold' : 'text-slate-600 hover:text-slate-900'"
                            class="px-2.5 py-1 rounded-lg transition-colors cursor-pointer flex items-center gap-1"
                        >
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                            Lunas ({{ $countLunas }})
                        </button>
                        <button 
                            type="button" 
                            @click="activePayFilter = 'belum_lunas'"
                            :class="activePayFilter === 'belum_lunas' ? 'bg-white text-rose-700 shadow-xs border border-slate-200/80 font-bold' : 'text-slate-600 hover:text-slate-900'"
                            class="px-2.5 py-1 rounded-lg transition-colors cursor-pointer flex items-center gap-1"
                        >
                            <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>
                            Belum Lunas ({{ $countBelumLunas }})
                        </button>
                    </div>

                    <!-- Filter Status Pengerjaan (Semua, Proses, Selesai) -->
                    <div class="inline-flex items-center p-1 rounded-xl bg-slate-100 border border-slate-200 text-xs font-semibold">
                        <span class="px-2 text-[10px] uppercase font-bold text-slate-400">Status:</span>
                        <button 
                            type="button" 
                            @click="activeFilter = 'semua'"
                            :class="activeFilter === 'semua' ? 'bg-white text-slate-900 shadow-xs border border-slate-200/80' : 'text-slate-600 hover:text-slate-900'"
                            class="px-2.5 py-1 rounded-lg transition-colors cursor-pointer"
                        >
                            Semua
                        </button>
                        <button 
                            type="button" 
                            @click="activeFilter = 'proses'"
                            :class="activeFilter === 'proses' ? 'bg-white text-amber-800 shadow-xs border border-slate-200/80 font-bold' : 'text-slate-600 hover:text-slate-900'"
                            class="px-2.5 py-1 rounded-lg transition-colors cursor-pointer"
                        >
                            Proses ({{ $prosesOrders }})
                        </button>
                        <button 
                            type="button" 
                            @click="activeFilter = 'selesai'"
                            :class="activeFilter === 'selesai' ? 'bg-white text-emerald-800 shadow-xs border border-slate-200/80 font-bold' : 'text-slate-600 hover:text-slate-900'"
                            class="px-2.5 py-1 rounded-lg transition-colors cursor-pointer"
                        >
                            Selesai ({{ $selesaiOrders }})
                        </button>
                    </div>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-slate-50 text-slate-600 text-[11px] font-semibold uppercase tracking-wider border-b border-[#F1E4E8]">
                        <tr>
                            <th class="px-4 py-3.5 text-center w-14"># ID</th>
                            <th class="px-4 py-3.5">Pelanggan</th>
                            <th class="px-4 py-3.5">Rincian Layanan & Berat</th>
                            <th class="px-4 py-3.5 text-right">Total Biaya</th>
                            <th class="px-4 py-3.5 text-center">Status Bayar</th>
                            <th class="px-4 py-3.5 text-center">Status Pengerjaan</th>
                            <th class="px-4 py-3.5 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#F1E4E8] text-sm">
                        @forelse($orders as $order)
                            @php
                                $rawStatus = strtolower($order->status);
                                $isCompleted = in_array($rawStatus, ['completed', 'selesai', 'diambil']);
                                $isProcessing = in_array($rawStatus, ['pending', 'proses cuci', 'proses']);
                                $filterGroup = $isCompleted ? 'selesai' : ($isProcessing ? 'proses' : 'lainnya');

                                $rawBayar = strtolower($order->status_bayar ?? 'belum lunas');
                                $isLunas = ($rawBayar === 'lunas');
                                $filterBayarGroup = $isLunas ? 'lunas' : 'belum_lunas';
                            @endphp
                            <tr 
                                x-show="(activeFilter === 'semua' || activeFilter === '{{ $filterGroup }}') && (activePayFilter === 'semua' || activePayFilter === '{{ $filterBayarGroup }}')"
                                class="hover:bg-slate-50/75 transition-colors"
                            >
                                <!-- ID -->
                                <td class="px-4 py-4 text-center font-bold text-slate-500 tabular-nums text-xs">
                                    #{{ $order->id }}
                                </td>

                                <!-- Pelanggan -->
                                <td class="px-4 py-4">
                                    <div class="font-bold text-[#1E293B] leading-tight">
                                        {{ $order->customer_name }}
                                    </div>
                                    @if($order->phone)
                                        <div class="text-[11px] text-slate-500 tabular-nums flex items-center gap-1 mt-0.5">
                                            <svg class="w-3 h-3 text-[#FA699E]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                            </svg>
                                            {{ $order->phone }}
                                        </div>
                                    @endif
                                </td>

                                <!-- Rincian Layanan (Dinamis dari Relasi belongsTo) -->
                                <td class="px-4 py-4">
                                    <ul class="space-y-1.5 text-xs text-slate-600">
                                        @foreach($order->orderDetails as $detail)
                                            <li class="flex items-center justify-between gap-3">
                                                <span class="font-medium text-slate-800">
                                                    {{ $detail->laundryItem ? $detail->laundryItem->name : 'Layanan' }}
                                                </span>
                                                <div class="flex items-center gap-2">
                                                    <span class="px-1.5 py-0.5 rounded-md bg-[#FFF1F6] text-[#FA699E] font-semibold tabular-nums text-right border border-[#F1E4E8]">
                                                        {{ $detail->quantity }} kg
                                                    </span>
                                                    <span class="text-slate-400 tabular-nums text-right">
                                                        Rp {{ number_format($detail->laundryItem ? ($detail->laundryItem->price * $detail->quantity) : $detail->price, 0, ',', '.') }}
                                                    </span>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </td>

                                <!-- Total Harga (Rata Kanan & Tabular-nums) -->
                                <td class="px-4 py-4 text-right font-extrabold text-[#FA699E] tabular-nums text-sm">
                                    Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                </td>

                                <!-- Status Bayar (Badge Emerald untuk Lunas & Rose untuk Belum Lunas) -->
                                <td class="px-4 py-4 text-center">
                                    @if($isLunas)
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                            Lunas
                                        </span>
                                    @else
                                        <div class="inline-flex flex-col items-center gap-1">
                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-rose-50 text-rose-700 border border-rose-200">
                                                <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>
                                                Belum Lunas
                                            </span>
                                            <!-- Tombol Aksi Cepat 'Lunasi' (1 Klik Baik untuk Kasir maupun Admin) -->
                                            <form action="{{ route('admin.orders.updateStatusBayar', $order->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status_bayar" value="Lunas">
                                                <button 
                                                    type="submit" 
                                                    class="inline-flex items-center gap-1 px-2.5 py-0.5 text-[11px] font-bold text-emerald-700 hover:text-emerald-800 bg-emerald-50 hover:bg-emerald-100 border border-emerald-300 rounded-lg transition cursor-pointer"
                                                    title="Tandai pembayaran menjadi Lunas"
                                                >
                                                    <svg class="w-3 h-3 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                                                    </svg>
                                                    Lunasi
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                </td>

                                <!-- Status Pengerjaan (Badge Minimalis Amber & Emerald) -->
                                <td class="px-4 py-4 text-center">
                                    @if($isCompleted)
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                            Selesai
                                        </span>
                                    @elseif($isProcessing)
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-amber-50 text-amber-700 border border-amber-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                            {{ $rawStatus === 'proses cuci' ? 'Proses Cuci' : 'Dalam Proses' }}
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-rose-50 text-rose-700 border border-rose-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>
                                            {{ ucfirst($rawStatus) }}
                                        </span>
                                    @endif
                                </td>

                                <!-- Aksi Pengerjaan & Hapus -->
                                <td class="px-4 py-4 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        @if(auth()->user()->role === 'admin')
                                            <!-- Tombol Aksi Satu Klik 'Tandai Selesai' (Khusus Admin) -->
                                            @if($isProcessing)
                                                <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status" value="completed">
                                                    <button 
                                                        type="submit" 
                                                        class="inline-flex items-center gap-1 px-2.5 py-1.5 bg-emerald-600 hover:bg-emerald-700 active:bg-emerald-800 text-white rounded-xl text-xs font-bold shadow-none transition-colors cursor-pointer"
                                                        title="Selesaikan cucian sekarang"
                                                    >
                                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                                                        </svg>
                                                        Tandai Selesai
                                                    </button>
                                                </form>
                                            @endif

                                            <!-- Dropdown Update Status Pengerjaan (Khusus Admin) -->
                                            <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('PATCH')
                                                <select 
                                                    name="status" 
                                                    onchange="this.form.submit()" 
                                                    class="text-xs font-medium text-slate-700 bg-white border border-[#F1E4E8] rounded-xl px-2 py-1.5 focus:outline-none focus:border-[#FA699E] focus:ring-1 focus:ring-[#FA699E] cursor-pointer shadow-none"
                                                >
                                                    <option value="pending" {{ $rawStatus == 'pending' ? 'selected' : '' }}>Pending</option>
                                                    <option value="proses cuci" {{ $rawStatus == 'proses cuci' ? 'selected' : '' }}>Proses Cuci</option>
                                                    <option value="completed" {{ in_array($rawStatus, ['completed', 'selesai']) ? 'selected' : '' }}>Selesai</option>
                                                    <option value="diambil" {{ $rawStatus == 'diambil' ? 'selected' : '' }}>Diambil</option>
                                                    <option value="cancelled" {{ in_array($rawStatus, ['cancelled', 'batal']) ? 'selected' : '' }}>Dibatalkan</option>
                                                </select>  
                                            </form>

                                            <!-- Tombol Hapus Transaksi (Khusus Admin) -->
                                            <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data transaksi #{{ $order->id }} ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button 
                                                    type="submit" 
                                                    class="inline-flex items-center p-1.5 rounded-xl text-slate-400 hover:text-rose-600 hover:bg-rose-50 border border-transparent hover:border-rose-200 transition-colors cursor-pointer"
                                                    title="Hapus Transaksi (Khusus Admin)"
                                                >
                                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
                                        @else
                                            <!-- Tampilan untuk Kasir (Hanya Memantau, Tidak Bisa Mengubah Status Pengerjaan) -->
                                            <span class="inline-flex items-center gap-1 text-xs text-slate-400 italic">
                                                <svg class="w-3.5 h-3.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                                </svg>
                                                Khusus Admin
                                            </span>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-12 text-center text-slate-400">
                                    <svg class="w-8 h-8 mx-auto mb-2 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                    </svg>
                                    Belum ada transaksi laundry yang tercatat.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
