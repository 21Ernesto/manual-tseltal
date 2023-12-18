@extends('layouts.user')

@section('main')
    <nav class="bg-white border-gray-200 dark:border-gray-600 dark:bg-gray-900 rounded-b-lg">
        <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl p-4">
            <a href="" class="flex items-center space-x-3 rtl:space-x-reverse">
                <span class="self-center ms-3 text-2xl font-semibold whitespace-nowrap dark:text-white">Manual de tseltal de
                    Guaquitepec</span>
            </a>
            @if (Route::has('login'))
                <div class="text-end">
                    @auth
                        <a href="{{ url('/dashboard') }}"
                            class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
                    @else
                    @endauth
                </div>
            @endif
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


    <div class="py-2">
        <div class="sm:px-6 lg:px-8">
            <div class="relative overflow-x-auto">
                <div class="flex">
                    <div class="w-1/2 mb-4">
                        <input type="text" id="search_palabras" placeholder="Buscar..."
                            class="border p-2 rounded focus:outline-none focus:ring-0 select-none"
                            oninput="search_palabras()">

                    </div>
                    <div class="w-1/2 mb-4 text-end">
                        <h1 class="text-3xl font-semibold mb-3 animate-pulse text-custom_app">{{ $ca->name }}</h1>
                    </div>
                </div>

                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Ortografía
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Traducción
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Observación
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Audio
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($palabras as $palabra)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $palabra->ortografia }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $palabra->traduccion }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $palabra->observacion }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center mt-3">
                                            <audio src="{{ asset('audios/' . $palabra->audio) }}"
                                                id="player{{ $palabra->id }}" type="audio/mpeg" preload="auto"></audio>

                                            <button onclick="playAudio('{{ $palabra->id }}')"
                                                class="bg-custom_app w-10 h-10 p-2 rounded ml-2 focus:outline-none">
                                                <i class="fas fa-play text-white"></i>

                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <script>
        function playAudio(id) {
            var audio = document.getElementById('player' + id);

            // Pausa todos los demás audios antes de reproducir uno nuevo
            var allAudios = document.querySelectorAll('audio');
            allAudios.forEach(function(otherAudio) {
                if (otherAudio !== audio && !otherAudio.paused) {
                    otherAudio.pause();
                }
            });

            if (audio.paused) {
                audio.play();
            } else {
                audio.pause();
            }
        }
    </script>
@endsection
