<button {{ $attributes->merge(['type' => 'submit', 'class' => 'glass-btn bg-red-400 hover:bg-red-500 inline-flex items-center justify-center px-6 py-3 font-black text-sm text-white uppercase tracking-widest transition-transform hover:-translate-y-1 focus:outline-none focus:ring-0 disabled:opacity-50 disabled:cursor-not-allowed']) }}>
    {{ $slot }}
</button>