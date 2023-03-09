<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body x-data="{ showsidebar: false, usermenu: false }" class="bg-gray-200 antialiased">
    @include('layouts.navstack')
    <div class="flex overflow-hidden pt-14 sm:pt-12">
        @include('layouts.navigation')
        <div class="h-full w-full relative overflow-y-auto lg:ml-64">
            @if (isset($header))
                <header class="bg-white shadow px-4">
                    <div class="max-w-5xl mx-auto py-4">
                        {{ $header }}
                    </div>
                </header>
            @endif
            <main class="py-4 sm:py-6 lg:py-8 sm:px-4">
                <div class="max-w-5xl mx-auto">
                    {{ $slot }}
                </div>
            </main>
        </div>
    </div>
    @stack('scripts')
</body>

    {{-- <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')
            @if (isset($header))
                <header>
                    <div>
                        {{ $header }}
                    </div>
                </header>
            @endif
            <main class="">
                {{ $slot }}
            </main>
        </div>
        @livewireScripts
    </body> --}}
</html>
