@extends('layouts.user')

@section('main')
    <nav class="bg-white border-gray-200 dark:border-gray-600 dark:bg-gray-900 rounded-b-lg">
        <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl p-4">
            <a href="" class="flex items-center space-x-3 rtl:space-x-reverse">
                <span class="self-center ms-3 text-2xl font-semibold whitespace-nowrap dark:text-white">Manual de tseltal de Guaquitepec</span>
            </a>
        </div>
    </nav>

    <div class="max-w-full mx-auto p-6 lg:p-8">
        <div class="flex rounded-md justify-center items-center" role="group">
            @foreach ($capitulos as $index => $capitulo)
                <a href="{{ route('mostrar_palabras', $capitulo->name) }}"
                    class="px-4 py-2 text-sm font-medium text-black bg-custom_app 
                border border-custom_app
                @if ($index === 0) rounded-l-lg @endif
                @if ($index > 0 && $index < count($capitulos) - 1) border-r @endif
                @if ($index === count($capitulos) - 1) rounded-r-lg @endif
                hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 
                dark:bg-gray-700 dark:border-custom_app dark:text-white dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-blue-500 dark:focus:text-white">
                    {{ $capitulo->name }}
                </a>
            @endforeach

        </div>

        <div class="">
            
        </div>
    </div>
@endsection
