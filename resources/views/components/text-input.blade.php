@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'glass-input w-full px-4 py-3 font-bold transition-all focus:ring-0']) !!}>