<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('laundry_items.index') }}" class="p-2 rounded-xl text-slate-400 hover:text-slate-600 hover:bg-[#FFF1F6] transition-colors">
                <svg class="w-5 h-5 text-[#FA699E]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <div>
                <h1 class="text-xl font-bold text-[#1E293B] tracking-tight">Tambah Paket Layanan Baru</h1>
                <p class="text-xs text-slate-500 mt-0.5">Isi rincian informasi untuk menambahkan paket laundry baru ke sistem Klinzy</p>
            </div>
        </div>
    </x-slot>

    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-2xl border border-[#F1E4E8] overflow-hidden shadow-none">
            <div class="px-6 py-4 border-b border-[#F1E4E8]">
                <h2 class="text-sm font-bold text-[#1E293B] uppercase tracking-wider">Formulir Paket Layanan</h2>
            </div>

            <form action="{{ route('laundry_items.store') }}" method="POST" class="p-6 space-y-5">
                @csrf

                <!-- Nama Layanan -->
                <div>
                    <label class="block font-bold text-xs text-slate-700 mb-1.5 uppercase tracking-wider">Nama Layanan</label>
                    <input 
                        type="text" 
                        name="name" 
                        value="{{ old('name') }}" 
                        placeholder="Contoh: Cuci Kering Reguler" 
                        class="w-full px-4 py-2.5 bg-white border border-[#F1E4E8] rounded-xl text-sm text-[#1E293B] placeholder-slate-400 focus:outline-none focus:border-[#FA699E] focus:ring-2 focus:ring-[#FFF1F6] transition" 
                        required
                    >
                    @error('name')
                        <p class="text-xs text-rose-600 mt-1.5">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Kategori -->
                <div>
                    <label class="block font-bold text-xs text-slate-700 mb-1.5 uppercase tracking-wider">Kategori</label>
                    <select 
                        name="category" 
                        class="w-full px-4 py-2.5 bg-white border border-[#F1E4E8] rounded-xl text-sm text-[#1E293B] focus:outline-none focus:border-[#FA699E] focus:ring-2 focus:ring-[#FFF1F6] transition cursor-pointer" 
                        required
                    >
                        <option value="Cuci" {{ old('category') == 'Cuci' ? 'selected' : '' }}>Cuci</option>
                        <option value="Setrika" {{ old('category') == 'Setrika' ? 'selected' : '' }}>Setrika</option>
                        <option value="Paket" {{ old('category') == 'Paket' ? 'selected' : '' }}>Paket</option>
                    </select>
                    @error('category')
                        <p class="text-xs text-rose-600 mt-1.5">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Harga (Rp) -->
                <div>
                    <label class="block font-bold text-xs text-slate-700 mb-1.5 uppercase tracking-wider">Tarif per Kilogram (Rp)</label>
                    <div class="relative">
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-slate-500 font-bold text-sm">
                            Rp
                        </div>
                        <input 
                            type="number" 
                            name="price" 
                            value="{{ old('price') }}" 
                            placeholder="0" 
                            min="0"
                            class="w-full pl-11 pr-4 py-2.5 bg-white border border-[#F1E4E8] rounded-xl text-sm text-[#1E293B] tabular-nums focus:outline-none focus:border-[#FA699E] focus:ring-2 focus:ring-[#FFF1F6] transition" 
                            required
                        >
                    </div>
                    @error('price')
                        <p class="text-xs text-rose-600 mt-1.5">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Deskripsi -->
                <div>
                    <label class="block font-bold text-xs text-slate-700 mb-1.5 uppercase tracking-wider">Deskripsi Layanan</label>
                    <textarea 
                        name="description" 
                        rows="3" 
                        placeholder="Tuliskan keterangan detail layanan..." 
                        class="w-full px-4 py-2.5 bg-white border border-[#F1E4E8] rounded-xl text-sm text-[#1E293B] placeholder-slate-400 focus:outline-none focus:border-[#FA699E] focus:ring-2 focus:ring-[#FFF1F6] transition" 
                        required
                    >{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-xs text-rose-600 mt-1.5">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tombol Aksi -->
                <div class="pt-4 border-t border-[#F1E4E8] flex items-center justify-end gap-3">
                    <a 
                        href="{{ route('laundry_items.index') }}" 
                        class="px-4 py-2.5 rounded-xl text-xs font-semibold text-slate-600 hover:text-slate-900 hover:bg-slate-100 border border-slate-300 transition-colors"
                    >
                        Batal
                    </a>
                    <button 
                        type="submit" 
                        class="px-5 py-2.5 rounded-xl text-xs font-bold text-white bg-[#FA699E] hover:bg-[#E14B82] active:bg-[#c93b6e] transition-colors cursor-pointer shadow-none"
                    >
                        Simpan Layanan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
