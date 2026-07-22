@props(['label', 'value', 'icon', 'accent' => 'indigo'])

@php
$accents = [
    'indigo' => 'bg-indigo-600/15 text-indigo-400',
    'emerald' => 'bg-emerald-600/15 text-emerald-400',
    'amber' => 'bg-amber-600/15 text-amber-400',
    'sky' => 'bg-sky-600/15 text-sky-400',
];
@endphp

<div class="rounded-xl border border-gray-800 bg-gray-900 p-5">
    <div class="flex items-center justify-between">
        <p class="text-sm text-gray-500">{{ $label }}</p>
        <div class="flex h-9 w-9 items-center justify-center rounded-lg {{ $accents[$accent] }}">
            <x-icon :name="$icon" class="w-5 h-5" />
        </div>
    </div>
    <p class="mt-3 text-2xl font-semibold text-gray-100">{{ $value }}</p>
</div>
