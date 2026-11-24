<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center px-4 py-2.5 bg-[#FA699E] hover:bg-[#E14B82] active:bg-[#BF3367] border border-transparent rounded-xl font-semibold text-sm text-white focus:outline-none focus:ring-2 focus:ring-[#FA699E] focus:ring-offset-2 transition duration-150 ease-in-out cursor-pointer shadow-none']) }}>
    {{ $slot }}
</button>
