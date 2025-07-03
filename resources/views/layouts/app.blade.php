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
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Navigation Links -->
<div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
   @role('usuario')
    <x-nav-link :href="route('books.index')" :active="request()->routeIs('books.index')">
        Libros
    </x-nav-link>
@endrole

@hasanyrole('admin|superadmin')
    <x-nav-link :href="route('books.index')" :active="request()->routeIs('books.*')">
        Libros
    </x-nav-link>

    <x-nav-link :href="route('authors.index')" :active="request()->routeIs('authors.*')">
        Autores
    </x-nav-link>
@endhasanyrole
</div>

            <!-- Page Content -->
            <main>
               @yield('content')
            </main>
        </div>
    </body>
</html>
