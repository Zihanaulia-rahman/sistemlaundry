@props(['active'])

@php
$classes = ($active ?? false)
            ? 'flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-bold bg-[#FFF1F6] text-[#FA699E] border border-[#F1E4E8] transition-colors'
            : 'flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium text-slate-600 hover:text-[#1E293B] hover:bg-[#FFF1F6]/60 transition-colors';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
