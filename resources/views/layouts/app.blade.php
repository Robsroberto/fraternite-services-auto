<!DOCTYPE html>
<html lang="fr" class="h-full">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ isset($title) ? $title.' - ' : '' }}{{ config('app.name') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="h-full font-sans antialiased bg-gray-950 text-gray-200">
        <div x-data="{ sidebarOpen: false }" class="flex h-full">

            <!-- Overlay mobile -->
            <div x-show="sidebarOpen" x-cloak @click="sidebarOpen = false"
                 class="fixed inset-0 z-30 bg-black/60 lg:hidden"></div>

            <!-- Sidebar -->
            <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
                   class="fixed inset-y-0 left-0 z-40 w-64 transform bg-gray-900 border-r border-gray-800 transition-transform duration-200 ease-in-out lg:static lg:translate-x-0 flex flex-col">
                <div class="flex items-center gap-2.5 px-5 h-16 border-b border-gray-800 shrink-0">
                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-indigo-600">
                        <x-icon name="car" class="w-5 h-5 text-white" />
                    </div>
                    <div class="leading-tight">
                        <p class="text-sm font-semibold text-gray-100">Fraternité Services</p>
                        <p class="text-[11px] text-gray-500">Vente &amp; Location Auto</p>
                    </div>
                </div>

                <nav class="flex-1 overflow-y-auto px-3 py-4 space-y-0.5">
                    @php
                        $navItems = [
                            ['route' => 'dashboard', 'icon' => 'dashboard', 'label' => 'Tableau de bord'],
                            ['route' => 'vehicules.index', 'icon' => 'car', 'label' => 'Véhicules'],
                            ['route' => 'clients.index', 'icon' => 'users', 'label' => 'Clients'],
                            ['route' => 'ventes.index', 'icon' => 'cash', 'label' => 'Ventes'],
                            ['route' => 'locations.index', 'icon' => 'calendar', 'label' => 'Locations'],
                        ];
                    @endphp
                    @foreach ($navItems as $item)
                        <a href="{{ route($item['route']) }}"
                           class="flex items-center gap-3 rounded-md px-3 py-2 text-sm font-medium transition
                                  {{ request()->routeIs(explode('.', $item['route'])[0].'*') ? 'bg-indigo-600/15 text-indigo-400' : 'text-gray-400 hover:bg-gray-800 hover:text-gray-100' }}">
                            <x-icon :name="$item['icon']" class="w-5 h-5 shrink-0" />
                            {{ $item['label'] }}
                        </a>
                    @endforeach
                </nav>

                <div class="border-t border-gray-800 p-3">
                    <div class="flex items-center gap-3 rounded-md px-2 py-2">
                        <div class="flex h-8 w-8 items-center justify-center rounded-full bg-gray-800 text-xs font-semibold text-gray-300 shrink-0">
                            {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                        </div>
                        <div class="min-w-0 flex-1">
                            <p class="truncate text-sm font-medium text-gray-200">{{ Auth::user()->name }}</p>
                            <p class="truncate text-xs text-gray-500">{{ Auth::user()->isAdmin() ? 'Administrateur' : 'Gestionnaire' }}</p>
                        </div>
                    </div>
                    <a href="{{ route('profile.edit') }}" class="mt-1 flex items-center gap-3 rounded-md px-3 py-2 text-sm text-gray-400 hover:bg-gray-800 hover:text-gray-100">
                        <x-icon name="wrench" class="w-4 h-4" /> Paramètres du compte
                    </a>
                    @if (Auth::user()->isAdmin())
                        <a href="{{ route('register') }}" class="flex items-center gap-3 rounded-md px-3 py-2 text-sm text-gray-400 hover:bg-gray-800 hover:text-gray-100">
                            <x-icon name="users" class="w-4 h-4" /> Ajouter un utilisateur
                        </a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center gap-3 rounded-md px-3 py-2 text-sm text-gray-400 hover:bg-gray-800 hover:text-gray-100">
                            <x-icon name="logout" class="w-4 h-4" /> Déconnexion
                        </button>
                    </form>
                </div>
            </aside>

            <!-- Main -->
            <div class="flex flex-1 flex-col min-w-0">
                <header class="flex h-16 shrink-0 items-center justify-between border-b border-gray-800 bg-gray-900/60 px-4 lg:px-8">
                    <div class="flex items-center gap-3">
                        <button @click="sidebarOpen = true" class="lg:hidden text-gray-400 hover:text-gray-100">
                            <x-icon name="menu" class="w-6 h-6" />
                        </button>
                        @isset($header)
                            <div class="text-lg font-semibold text-gray-100">{{ $header }}</div>
                        @endisset
                    </div>
                </header>

                <main class="flex-1 overflow-y-auto">
                    <div class="mx-auto max-w-7xl px-4 py-8 lg:px-8">
                        @if (session('success'))
                            <div class="mb-6 flex items-center gap-2 rounded-lg border border-emerald-800 bg-emerald-950/50 px-4 py-3 text-sm text-emerald-400">
                                <x-icon name="check-circle" class="w-5 h-5 shrink-0" />
                                {{ session('success') }}
                            </div>
                        @endif

                        {{ $slot }}
                    </div>
                </main>
            </div>
        </div>
    </body>
</html>
