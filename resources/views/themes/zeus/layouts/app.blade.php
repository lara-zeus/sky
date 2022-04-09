<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ __('filament::layout.direction') ?? 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="application-name" content="{{ config('app.name', 'Laravel') }}">

    <!-- Seo Tags -->
    <x-seo::meta/>
    <!-- Seo Tags -->

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700;800&family=KoHo:ital,wght@0,200;0,300;0,500;0,700;1,200;1,300;1,600;1,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('vendor/zeus-sky/app.css') }}">
    @livewireStyles
    @stack('styles')

    <style>
        * {
            font-family: 'KoHo', 'Almarai', sans-serif;
        }

        [x-cloak] {
            display: none !important;
        }

        @if(app()->isLocal())
        .bord {
            border: solid 1px crimson
        }
        @endif
    </style>
</head>
<body class="font-sans antialiased bg-gray-50 font-sans">

@include('zeus-sky::themes.'.config('zeus-sky.theme').'.layouts.nav')

@if(isset($header))
    <header class="bg-gray-100">
        <div class="container mx-auto py-2 px-3">
            <div class="italic font-semibold text-xl text-gray-600">
                {{ $header }}
            </div>
        </div>
    </header>
@endif

<main class="flex max-w-7xl mx-auto">
    <div class="flex-grow">
        {{ $slot }}
    </div>
</main>

<footer class="bg-gray-100 p-6 mt-20">
    <a href="https://larazeus.com" target="_blank" class="text-center font-light block">
        a gift with  ❤️  from @zeus
    </a>
</footer>

<script src="{{ asset('vendor/zeus-sky/app.js') }}" defer></script>

@livewireScripts
@stack('scripts')

</body>
</html>
