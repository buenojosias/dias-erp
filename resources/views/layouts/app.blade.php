<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @wireUiScripts
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('build/assets/app-70a8abd5.css') }}">
    <script src="{{ asset('build/assets/app-9f34e40c.js') }}" defer></script>
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    @livewireScripts
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
</html>
