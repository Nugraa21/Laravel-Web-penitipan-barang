@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-black text-xs uppercase tracking-widest text-black mb-1']) }}>
    {{ $value ?? $slot }}
</label>