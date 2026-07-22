<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gray-950">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
            <div class="flex items-center gap-2.5">
                <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-indigo-600">
                    <x-icon name="car" class="w-6 h-6 text-white" />
                </div>
                <div class="leading-tight">
                    <p class="text-base font-semibold text-gray-100">Fraternité Services</p>
                    <p class="text-xs text-gray-500">Vente &amp; Location Auto</p>
                </div>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-6 bg-gray-900 border border-gray-800 shadow-xl overflow-hidden sm:rounded-xl">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
