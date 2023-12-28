@extends('layouts.user')

@section('main')
    <nav class="bg-white border-gray-200 dark:border-gray-600 dark:bg-gray-900 rounded-b-lg">
        <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl p-4">
            <a href="" class="flex items-center space-x-3 rtl:space-x-reverse">
                <span class="text-xl font-semibold whitespace-nowrap dark:text-white">Manual de tseltal de Guaquitepec</span>
            </a>
        </div>
    </nav>

    <div class="w-full mx-auto p-4 md:p-6 lg:p-8">
        <div class="text-center mb-2">
            <h1 class="text-2xl font-bold">Lecciones</h1>
        </div>
        <div class="container mx-auto flex flex-wrap justify-center">
            @forelse($capitulos as $index => $capitulo)
                <a type="button" href="{{ route('mostrar_palabras', $capitulo->leccion) }}"
                    class="lg:px-3 lg:py-2 lg:text-lg font-medium text-gray-900 border  bg-custom_app
                       px-2 py-1 text-sm md:text-base">
                    {{ $capitulo->leccion }}
                </a>
            @empty
                <!-- Si no hay elementos en el bucle, puedes mostrar un mensaje de "vacío" aquí -->
            @endforelse
        </div>
    </div>
@endsection
