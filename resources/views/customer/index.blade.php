<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi Laundry - Klinzy Smart Laundry Management</title>

    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Scripts & Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-full bg-[#FAFAFA] font-sans text-[#1E293B] antialiased py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-5xl mx-auto space-y-6">

        <!-- Top Navigation Bar -->
        <header class="bg-white px-6 py-4 rounded-2xl border border-[#F1E4E8] flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 shadow-none">
            <div class="flex items-center gap-3">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-2xl bg-[#FFF1F6] border border-[#F1E4E8] flex items-center justify-center text-[#FA699E]">
                        <svg class="w-6 h-6 text-[#FA699E]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 2.69l5.66 5.66a8 8 0 1 1-11.31 0z" fill="currentColor" fill-opacity="0.2"></path>
                            <path d="M12 2.69l5.66 5.66a8 8 0 1 1-11.31 0z"></path>
                            <circle cx="10" cy="11" r="1.5" fill="currentColor" stroke="none"></circle>
                            <circle cx="14" cy="15" r="1" fill="currentColor" stroke="none"></circle>
                        </svg>
                    </div>
                    <div>
                        <span class="font-extrabold text-base text-[#1E293B] block leading-tight">Klinzy</span>
                        <span class="text-[11px] font-semibold text-[#FA699E] uppercase tracking-wider">Smart Laundry Management</span>
                    </div>
                </a>
            </div>

            <div class="flex items-center gap-3">
                @auth
                    <div class="text-xs text-right hidden sm:block">
                        <div class="font-bold text-[#1E293B]">{{ Auth::user()->name }}</div>
                        <div class="text-[11px] text-slate-400 capitalize">Role: {{ Auth::user()->role }}</div>
                    </div>

                    <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-1.5 px-3.5 py-1.5 text-xs font-bold bg-[#FFF1F6] hover:bg-rose-100/70 text-[#FA699E] border border-[#F1E4E8] rounded-xl transition">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        Dashboard
                    </a>

                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="px-3 py-1.5 text-xs font-semibold bg-white hover:bg-rose-50 text-slate-600 hover:text-rose-700 border border-[#F1E4E8] hover:border-rose-200 rounded-xl transition cursor-pointer">
                            Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="px-4 py-2 text-xs font-bold bg-[#FA699E] hover:bg-[#E14B82] text-white rounded-xl transition">
                        Masuk Petugas
                    </a>
                    <a href="{{ route('register') }}" class="px-4 py-2 text-xs font-bold bg-white hover:bg-slate-50 text-slate-700 border border-[#F1E4E8] rounded-xl transition">
                        Daftar
                    </a>
                @endauth
            </div>
        </header>

        <!-- Flash Notifications -->
        @if(session('success'))
            <div class="p-4 rounded-xl bg-[#FFF1F6] border border-[#F1E4E8] text-[#FA699E] text-sm flex items-center gap-3">
                <svg class="w-5 h-5 text-[#FA699E] shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <div class="font-bold text-slate-800">{{ session('success') }}</div>
            </div>
        @endif

        @if(session('error'))
            <div class="p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-900 text-sm flex items-center gap-3">
                <svg class="w-5 h-5 text-rose-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <div class="font-bold">{{ session('error') }}</div>
            </div>
        @endif

        @if($errors->any())
            <div class="p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-900 text-sm">
                <div class="font-bold mb-1">Perhatian: Terjadi kesalahan input data</div>
                <ul class="list-disc list-inside text-xs space-y-1 text-rose-800">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form Pemesanan / Transaksi Laundry -->
        <form id="transactionForm" action="{{ route('customer.checkout') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Section 1: Informasi Pelanggan -->
            <div class="bg-white rounded-2xl border border-[#F1E4E8] overflow-hidden shadow-none">
                <div class="px-6 py-4 bg-[#FFF1F6]/50 border-b border-[#F1E4E8] flex items-center justify-between">
                    <div class="flex items-center gap-2.5">
                        <span class="w-6 h-6 rounded-lg bg-[#FA699E] text-white font-bold text-xs flex items-center justify-center">1</span>
                        <div>
                            <h2 class="text-sm font-bold text-[#1E293B] tracking-tight">Data Pelanggan</h2>
                            <p class="text-[11px] text-slate-500">Identitas pemesan untuk pencatatan nota dan konfirmasi status pengerjaan</p>
                        </div>
                    </div>
                    <span class="text-[11px] font-bold text-[#FA699E] bg-white px-2.5 py-0.5 rounded-full border border-[#F1E4E8]">
                        Wajib Diisi
                    </span>
                </div>

                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <!-- Nama Lengkap -->
                        <div>
                            <label class="block font-bold text-xs text-slate-700 mb-1.5 uppercase tracking-wider">
                                Nama Lengkap Pelanggan <span class="text-rose-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <input 
                                    type="text" 
                                    name="customer_name" 
                                    value="{{ Auth::check() ? Auth::user()->name : old('customer_name') }}" 
                                    required 
                                    placeholder="Masukkan nama pemesan..." 
                                    class="w-full pl-10 pr-3.5 py-2.5 bg-white border border-[#F1E4E8] rounded-xl text-sm text-[#1E293B] placeholder-slate-400 focus:outline-none focus:border-[#FA699E] focus:ring-2 focus:ring-[#FFF1F6] transition"
                                >
                            </div>
                            <span class="text-[11px] text-slate-400 mt-1 block">Nama yang tertera pada nota transaksi</span>
                        </div>

                        <!-- Nomor Telepon / WhatsApp -->
                        <div>
                            <label class="block font-bold text-xs text-slate-700 mb-1.5 uppercase tracking-wider">
                                Nomor Telepon / WhatsApp
                            </label>
                            <div class="relative">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg>
                                </div>
                                <input 
                                    type="tel" 
                                    name="phone" 
                                    value="{{ old('phone') }}" 
                                    placeholder="08xxxxxxxxxx" 
                                    class="w-full pl-10 pr-3.5 py-2.5 bg-white border border-[#F1E4E8] rounded-xl text-sm text-[#1E293B] tabular-nums placeholder-slate-400 focus:outline-none focus:border-[#FA699E] focus:ring-2 focus:ring-[#FFF1F6] transition"
                                >
                            </div>
                            <span class="text-[11px] text-slate-400 mt-1 block">Untuk notifikasi WhatsApp saat cucian selesai</span>
                        </div>
                    </div>

                    <!-- Pilihan Status Pembayaran Saat Input -->
                    <div class="mt-5 pt-4 border-t border-[#F1E4E8]">
                        <label class="block font-bold text-xs text-slate-700 mb-2 uppercase tracking-wider">
                            Status Pembayaran Awal
                        </label>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 max-w-md">
                            <label class="flex items-center gap-3 p-3 rounded-xl border border-[#F1E4E8] cursor-pointer hover:border-[#FA699E] hover:bg-[#FFF1F6]/30 transition">
                                <input 
                                    type="radio" 
                                    name="status_bayar" 
                                    value="Belum Lunas" 
                                    checked 
                                    class="text-[#FA699E] focus:ring-[#FA699E] border-slate-300"
                                >
                                <div>
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-rose-50 text-rose-700 border border-rose-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>
                                        Belum Lunas
                                    </span>
                                    <span class="block text-[11px] text-slate-400 mt-0.5">Bayar saat pengambilan cucian</span>
                                </div>
                            </label>

                            <label class="flex items-center gap-3 p-3 rounded-xl border border-[#F1E4E8] cursor-pointer hover:border-[#FA699E] hover:bg-[#FFF1F6]/30 transition">
                                <input 
                                    type="radio" 
                                    name="status_bayar" 
                                    value="Lunas" 
                                    class="text-[#FA699E] focus:ring-[#FA699E] border-slate-300"
                                >
                                <div>
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                        Lunas
                                    </span>
                                    <span class="block text-[11px] text-slate-400 mt-0.5">Sudah dibayar di depan (tunai/transfer)</span>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section 2: Pilih Layanan Laundry & Input Berat -->
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <div class="w-6 h-6 rounded-lg bg-[#FA699E] text-white font-bold text-xs flex items-center justify-center">2</div>
                        <h2 class="text-base font-bold text-[#1E293B]">Pilih Layanan & Masukkan Berat (kg)</h2>
                    </div>
                    <span class="text-xs text-slate-500">Total harga terhitung otomatis secara real-time</span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @forelse($laundry_items as $laundryItem)
                        <div class="laundry-card bg-white rounded-2xl border border-[#F1E4E8] overflow-hidden flex flex-col justify-between hover:border-[#FA699E] transition shadow-none" data-price="{{ $laundryItem->price }}" data-name="{{ $laundryItem->name }}">
                            <div class="p-5">
                                <div class="flex items-center justify-between gap-2 mb-3">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-[#FFF1F6] text-[#FA699E] border border-[#F1E4E8]">
                                        {{ ucfirst($laundryItem->category ?? 'Paket') }}
                                    </span>
                                    <span class="font-extrabold text-[#FA699E] text-sm tabular-nums text-right">
                                        Rp {{ number_format($laundryItem->price, 0, ',', '.') }} <span class="text-xs font-normal text-slate-400">/kg</span>
                                    </span>
                                </div>
                                <h3 class="font-bold text-[#1E293B] text-base leading-snug">{{ $laundryItem->name }}</h3>
                                <p class="text-xs text-slate-500 mt-1 line-clamp-2">{{ $laundryItem->description }}</p>
                            </div>

                            <div class="p-4 bg-slate-50/70 border-t border-[#F1E4E8] space-y-2">
                                <div class="flex items-center justify-between gap-3">
                                    <label class="text-xs font-bold text-slate-700 shrink-0 uppercase tracking-wider">
                                        Berat Cucian:
                                    </label>
                                    <div class="relative w-32">
                                        <input 
                                            type="number" 
                                            name="items[{{ $laundryItem->id }}]" 
                                            data-price="{{ $laundryItem->price }}"
                                            min="0" 
                                            step="any"
                                            value="0" 
                                            class="weight-input w-full pr-8 pl-3 py-1.5 text-right font-bold text-[#1E293B] tabular-nums bg-white border border-[#F1E4E8] rounded-xl text-sm focus:outline-none focus:border-[#FA699E] focus:ring-2 focus:ring-[#FFF1F6] transition"
                                        >
                                        <span class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2.5 text-xs text-slate-400 font-semibold">
                                            kg
                                        </span>
                                    </div>
                                </div>

                                <!-- Subtotal per item layanan -->
                                <div class="flex items-center justify-between text-xs pt-1 border-t border-[#F1E4E8]">
                                    <span class="text-slate-500">Subtotal:</span>
                                    <span class="item-subtotal font-bold text-[#FA699E] tabular-nums">Rp 0</span>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full bg-white p-8 rounded-2xl border border-[#F1E4E8] text-center text-slate-400">
                            Belum ada paket layanan aktif. Hubungi administrator.
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Section 3: Ringkasan Total & Perhitungan Otomatis Real-time -->
            <div class="bg-white p-6 rounded-2xl border border-[#F1E4E8] flex flex-col sm:flex-row items-center justify-between gap-6 shadow-none">
                <div class="w-full sm:w-auto text-center sm:text-left">
                    <span class="text-xs font-bold text-slate-500 uppercase tracking-wider block">
                        Total Estimasi Biaya
                    </span>
                    <div class="flex items-baseline justify-center sm:justify-start gap-2 mt-1">
                        <span id="displayTotalPrice" class="text-3xl font-extrabold text-[#FA699E] tabular-nums">
                            Rp 0
                        </span>
                        <span id="displayTotalWeight" class="text-xs font-semibold text-slate-500 tabular-nums">
                            (0 kg)
                        </span>
                    </div>
                    <span class="text-[11px] text-slate-400 mt-1 block">
                        Kalkulasi real-time sesuai tarif kilogram yang diisi.
                    </span>
                </div>

                <div class="w-full sm:w-auto text-right">
                    @auth
                        <button 
                            type="submit" 
                            id="btnSubmitOrder"
                            class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3.5 bg-[#FA699E] hover:bg-[#E14B82] active:bg-[#c93b6e] text-white font-bold text-sm rounded-xl transition-colors cursor-pointer shadow-none"
                        >
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Konfirmasi & Simpan Transaksi
                        </button>
                    @else
                        <a 
                            href="{{ route('login') }}" 
                            class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3.5 bg-slate-800 hover:bg-slate-900 text-white font-bold text-sm rounded-xl transition-colors shadow-none"
                        >
                            Masuk untuk Menyimpan Transaksi
                        </a>
                    @endauth
                </div>
            </div>
        </form>

        <footer class="pt-6 text-center text-xs text-slate-400">
            &copy; {{ date('Y') }} Klinzy Laundry System &bull; Smart Laundry Management
        </footer>
    </div>

    <!-- Vanilla JavaScript: Real-time Automatic Calculation -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const weightInputs = document.querySelectorAll('.weight-input');
            const displayTotalPrice = document.getElementById('displayTotalPrice');
            const displayTotalWeight = document.getElementById('displayTotalWeight');

            // Formatter ke mata uang Rupiah
            function formatRupiah(amount) {
                return 'Rp ' + Math.round(amount).toLocaleString('id-ID');
            }

            // Fungsi kalkulasi real-time
            function calculateTotal() {
                let grandTotal = 0;
                let totalWeight = 0;

                weightInputs.forEach(input => {
                    const price = parseFloat(input.getAttribute('data-price')) || 0;
                    const weight = parseFloat(input.value) || 0;
                    const subtotal = price * weight;

                    // Update subtotal per card layanan
                    const card = input.closest('.laundry-card');
                    if (card) {
                        const subtotalEl = card.querySelector('.item-subtotal');
                        if (subtotalEl) {
                            subtotalEl.textContent = formatRupiah(subtotal);
                        }

                        // Beri highlight border pada kartu yang diisi
                        if (weight > 0) {
                            card.classList.add('border-[#FA699E]', 'bg-[#FFF1F6]/20');
                            card.classList.remove('border-[#F1E4E8]');
                        } else {
                            card.classList.remove('border-[#FA699E]', 'bg-[#FFF1F6]/20');
                            card.classList.add('border-[#F1E4E8]');
                        }
                    }

                    grandTotal += subtotal;
                    totalWeight += weight;
                });

                // Update tampilan ringkasan
                if (displayTotalPrice) {
                    displayTotalPrice.textContent = formatRupiah(grandTotal);
                }
                if (displayTotalWeight) {
                    displayTotalWeight.textContent = `(${totalWeight % 1 === 0 ? totalWeight : totalWeight.toFixed(1)} kg)`;
                }
            }

            // Pasang event listener untuk input dan change
            weightInputs.forEach(input => {
                input.addEventListener('input', calculateTotal);
                input.addEventListener('change', calculateTotal);
            });

            // Jalankan sekali saat halaman selesai dimuat
            calculateTotal();
        });
    </script>
</body>
</html>
