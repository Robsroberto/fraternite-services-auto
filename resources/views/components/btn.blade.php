@props(['href' => null, 'variant' => 'primary', 'type' => 'button', 'icon' => null])

@php
$variants = [
    'primary' => 'bg-indigo-600 text-white hover:bg-indigo-500',
    'secondary' => 'bg-gray-800 text-gray-200 hover:bg-gray-700 border border-gray-700',
    'danger' => 'bg-red-600/10 text-red-400 hover:bg-red-600/20 border border-red-900',
];
$classes = 'inline-flex items-center gap-2 rounded-md px-3.5 py-2 text-sm font-medium transition ' . $variants[$variant];
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        @if ($icon)<x-icon :name="$icon" class="w-4 h-4" />@endif
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>
        @if ($icon)<x-icon :name="$icon" class="w-4 h-4" />@endif
        {{ $slot }}
    </button>
@endif
