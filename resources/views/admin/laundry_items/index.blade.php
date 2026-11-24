<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-xl font-bold text-[#1E293B] tracking-tight">Master Data Layanan</h1>
                <p class="text-xs text-slate-500 mt-0.5">Kelola daftar layanan paket laundry Klinzy, kategori, dan tarif harga per kilogram</p>
            </div>
            <div>
                <a href="{{ route('laundry_items.create') }}" class="inline-flex items-center gap-1.5 px-4 py-2 bg-[#FA699E] hover:bg-[#E14B82] text-white text-xs font-bold rounded-xl transition-colors shadow-none">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Layanan
                </a>
            </div>
        </div>
    </x-slot>

    <!-- Modal Konfirmasi Hapus Menggunakan AlpineJS -->
    <div 
        class="space-y-6" 
        x-data="{ 
            deleteModalOpen: false, 
            deleteActionUrl: '', 
            deleteItemName: '',
            confirmDelete(url, name) {
                this.deleteActionUrl = url;
                this.deleteItemName = name;
                this.deleteModalOpen = true;
            }
        }"
    >
        @if(session('success'))
            <div class="p-4 rounded-xl bg-[#FFF1F6] border border-[#F1E4E8] text-[#FA699E] text-sm flex items-center gap-2.5">
                <svg class="w-5 h-5 text-[#FA699E] shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="font-bold text-slate-800">{{ session('success') }}</span>
            </div>
        @endif

        <div class="bg-white rounded-2xl border border-[#F1E4E8] overflow-hidden shadow-none">
            <div class="px-6 py-4 border-b border-[#F1E4E8] flex items-center justify-between">
                <h2 class="text-sm font-bold text-[#1E293B] uppercase tracking-wider">
                    Daftar Paket Layanan Tersedia
                </h2>
                <span class="text-xs text-slate-500 font-semibold">
                    Total {{ $laundry_items->total() }} paket
                </span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-slate-50 text-slate-600 text-[11px] font-semibold uppercase tracking-wider border-b border-[#F1E4E8]">
                        <tr>
                            <th class="px-4 py-3.5 text-center w-14"># ID</th>
                            <th class="px-4 py-3.5">Nama Layanan</th>
                            <th class="px-4 py-3.5">Kategori</th>
                            <th class="px-4 py-3.5">Deskripsi</th>
                            <th class="px-4 py-3.5 text-right">Tarif / kg</th>
                            <th class="px-4 py-3.5 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#F1E4E8] text-sm">
                        @forelse($laundry_items as $laundryItem)
                            <tr class="hover:bg-slate-50/75 transition-colors">
                                <!-- ID -->
                                <td class="px-4 py-4 text-center font-bold text-slate-400 tabular-nums text-xs">
                                    #{{ $laundryItem->id }}
                                </td>

                                <!-- Nama Layanan -->
                                <td class="px-4 py-4 font-bold text-[#1E293B]">
                                    {{ $laundryItem->name }}
                                </td>

                                <!-- Kategori Badge -->
                                <td class="px-4 py-4">
                                    @php
                                        $cat = strtolower($laundryItem->category);
                                    @endphp
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold {{ $cat === 'cuci' ? 'bg-[#FFF1F6] text-[#FA699E] border border-[#F1E4E8]' : 'bg-slate-100 text-slate-700 border border-slate-200' }}">
                                        {{ ucfirst($laundryItem->category) }}
                                    </span>
                                </td>

                                <!-- Deskripsi -->
                                <td class="px-4 py-4 text-xs text-slate-500 max-w-xs truncate">
                                    {{ $laundryItem->description }}
                                </td>

                                <!-- Tarif (Rata Kanan & Tabular-nums) -->
                                <td class="px-4 py-4 text-right font-extrabold text-[#FA699E] tabular-nums text-sm">
                                    Rp {{ number_format($laundryItem->price, 0, ',', '.') }}
                                </td>

                                <!-- Aksi dengan Modal Konfirmasi Hapus -->
                                <td class="px-4 py-4 text-center">
                                    <div class="inline-flex items-center gap-2">
                                        <a 
                                            href="{{ route('laundry_items.edit', $laundryItem->id) }}" 
                                            class="inline-flex items-center px-3 py-1.5 rounded-xl text-xs font-semibold text-slate-700 bg-white border border-[#F1E4E8] hover:bg-[#FFF1F6] hover:text-[#FA699E] hover:border-[#F1E4E8] transition-colors"
                                            title="Ubah Layanan"
                                        >
                                            Edit
                                        </a>

                                        <!-- Tombol Pemicu Dialog Konfirmasi Hapus -->
                                        <button 
                                            type="button" 
                                            @click="confirmDelete('{{ route('laundry_items.destroy', $laundryItem->id) }}', '{{ addslashes($laundryItem->name) }}')"
                                            class="inline-flex items-center px-3 py-1.5 rounded-xl text-xs font-semibold text-rose-700 bg-white border border-[#F1E4E8] hover:bg-rose-50 hover:border-rose-200 transition-colors cursor-pointer"
                                            title="Hapus Layanan"
                                        >
                                            Hapus
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center text-slate-400">
                                    Belum ada data paket layanan laundry yang tersedia.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($laundry_items->hasPages())
                <div class="px-6 py-4 border-t border-[#F1E4E8] bg-slate-50">
                    {{ $laundry_items->links() }}
                </div>
            @endif
        </div>

        <!-- Backdrop & Dialog Konfirmasi Hapus Minimalis -->
        <div 
            x-show="deleteModalOpen" 
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-50 overflow-y-auto bg-slate-900/40 backdrop-blur-xs flex items-center justify-center p-4"
            style="display: none;"
        >
            <div 
                @click.away="deleteModalOpen = false" 
                class="bg-white rounded-2xl border border-[#F1E4E8] max-w-md w-full p-6 shadow-xl space-y-4"
            >
                <div class="flex items-start gap-3.5">
                    <div class="w-10 h-10 rounded-2xl bg-rose-50 border border-rose-200 text-rose-600 flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-base font-bold text-[#1E293B] leading-tight">Konfirmasi Hapus Layanan</h3>
                        <p class="text-xs text-slate-500 mt-1 leading-relaxed">
                            Apakah Anda yakin ingin menghapus layanan <strong class="text-[#1E293B]" x-text="deleteItemName"></strong>? Data yang dihapus tidak dapat dipulihkan.
                        </p>
                    </div>
                </div>

                <div class="pt-3 border-t border-[#F1E4E8] flex items-center justify-end gap-2.5">
                    <button 
                        type="button" 
                        @click="deleteModalOpen = false" 
                        class="px-4 py-2 rounded-xl text-xs font-semibold text-slate-600 hover:text-slate-900 hover:bg-slate-100 border border-slate-300 transition-colors"
                    >
                        Batal
                    </button>
                    <form :action="deleteActionUrl" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button 
                            type="submit" 
                            class="px-4 py-2 rounded-xl text-xs font-bold text-white bg-rose-600 hover:bg-rose-700 transition-colors cursor-pointer"
                        >
                            Ya, Hapus Data
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
