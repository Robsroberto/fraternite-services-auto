@props(['statut'])

@php
$map = [
    'disponible' => ['label' => 'Disponible', 'class' => 'bg-emerald-600/15 text-emerald-400 border-emerald-800/50'],
    'vendu' => ['label' => 'Vendu', 'class' => 'bg-gray-600/20 text-gray-400 border-gray-700'],
    'loue' => ['label' => 'Loué', 'class' => 'bg-sky-600/15 text-sky-400 border-sky-800/50'],
    'maintenance' => ['label' => 'En maintenance', 'class' => 'bg-amber-600/15 text-amber-400 border-amber-800/50'],
    'indisponible' => ['label' => 'Indisponible', 'class' => 'bg-red-600/15 text-red-400 border-red-800/50'],

    'en_attente' => ['label' => 'En attente', 'class' => 'bg-amber-600/15 text-amber-400 border-amber-800/50'],
    'payee' => ['label' => 'Payée', 'class' => 'bg-emerald-600/15 text-emerald-400 border-emerald-800/50'],
    'annulee' => ['label' => 'Annulée', 'class' => 'bg-red-600/15 text-red-400 border-red-800/50'],

    'reservee' => ['label' => 'Réservée', 'class' => 'bg-amber-600/15 text-amber-400 border-amber-800/50'],
    'en_cours' => ['label' => 'En cours', 'class' => 'bg-sky-600/15 text-sky-400 border-sky-800/50'],
    'terminee' => ['label' => 'Terminée', 'class' => 'bg-emerald-600/15 text-emerald-400 border-emerald-800/50'],
];
$item = $map[$statut] ?? ['label' => ucfirst($statut), 'class' => 'bg-gray-600/20 text-gray-400 border-gray-700'];
@endphp

<span {{ $attributes->merge(['class' => "inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-medium {$item['class']}"]) }}>
    {{ $item['label'] }}
</span>
