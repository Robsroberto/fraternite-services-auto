<x-app-layout>
    <x-slot name="header">Clients</x-slot>

    <x-page-header title="Fichier clients" subtitle="{{ $clients->total() }} client(s) enregistré(s)">
        <x-slot name="actions">
            <x-btn :href="route('clients.create')" icon="plus">Ajouter un client</x-btn>
        </x-slot>
    </x-page-header>

    <form method="GET" class="mb-5">
        <div class="relative max-w-md">
            <x-icon name="search" class="pointer-events-none absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-gray-500" />
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Rechercher un client..."
                   class="w-full rounded-md border-gray-700 bg-gray-900 pl-9 text-sm text-gray-200 placeholder-gray-500 focus:border-indigo-500 focus:ring-indigo-500">
        </div>
    </form>

    <div class="overflow-hidden rounded-xl border border-gray-800 bg-gray-900">
        <table class="min-w-full divide-y divide-gray-800">
            <thead class="bg-gray-900/50">
                <tr class="text-left text-xs font-medium uppercase tracking-wide text-gray-500">
                    <th class="px-5 py-3">Client</th>
                    <th class="px-5 py-3">Téléphone</th>
                    <th class="px-5 py-3">Email</th>
                    <th class="px-5 py-3">Ventes</th>
                    <th class="px-5 py-3">Locations</th>
                    <th class="px-5 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-800">
                @forelse ($clients as $client)
                    <tr class="hover:bg-gray-800/40">
                        <td class="px-5 py-3 text-sm font-medium text-gray-200">{{ $client->nom_complet }}</td>
                        <td class="px-5 py-3 text-sm text-gray-400">{{ $client->telephone }}</td>
                        <td class="px-5 py-3 text-sm text-gray-400">{{ $client->email ?? '-' }}</td>
                        <td class="px-5 py-3 text-sm text-gray-400">{{ $client->ventes_count }}</td>
                        <td class="px-5 py-3 text-sm text-gray-400">{{ $client->locations_count }}</td>
                        <td class="px-5 py-3">
                            <div class="flex items-center justify-end gap-1">
                                <a href="{{ route('clients.show', $client) }}" class="rounded-md p-1.5 text-gray-500 hover:bg-gray-800 hover:text-gray-200" title="Voir"><x-icon name="eye" class="w-4 h-4" /></a>
                                <a href="{{ route('clients.edit', $client) }}" class="rounded-md p-1.5 text-gray-500 hover:bg-gray-800 hover:text-gray-200" title="Modifier"><x-icon name="pencil" class="w-4 h-4" /></a>
                                <form method="POST" action="{{ route('clients.destroy', $client) }}" onsubmit="return confirm('Supprimer ce client ?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="rounded-md p-1.5 text-gray-500 hover:bg-red-950 hover:text-red-400" title="Supprimer"><x-icon name="trash" class="w-4 h-4" /></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-5 py-12 text-center text-sm text-gray-500">
                            Aucun client enregistré. <a href="{{ route('clients.create') }}" class="text-indigo-400 hover:underline">Ajouter le premier client</a>.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $clients->links() }}</div>
</x-app-layout>
