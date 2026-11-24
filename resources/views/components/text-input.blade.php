@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'w-full px-3.5 py-2.5 bg-white border border-[#F1E4E8] rounded-xl text-sm text-[#1E293B] placeholder-slate-400 focus:outline-none focus:border-[#FA699E] focus:ring-2 focus:ring-[#FFF1F6] transition duration-150 ease-in-out shadow-none disabled:bg-slate-50 disabled:text-slate-400']) }}>
