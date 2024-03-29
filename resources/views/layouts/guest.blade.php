<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Manual de tseltal de Guaquitepec') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="icon" type="image/png" href="{{ asset('image/logo.png') }}" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
            <div>
                <a>
                    <h1 class="font-black text-2xl mb-4 text-center">Manual de tseltal de Guaquitepec</h1>
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
            <div class="fixed w-full bottom-0 text-center p-4 bg-white dark:bg-gray-800 mt-10">
                @php
                    $companyName = 'DIM3NSOFT';
                    $companyUrl = 'https://dim3nsoft.com.mx/';
                @endphp
            
                <x-info-company :companyName="$companyName" :companyUrl="$companyUrl" />
            </div>
        </div>
        
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    </body>
</html>
