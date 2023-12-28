@extends('layouts.user')

@section('main')
    <nav class="bg-white border-gray-200 dark:border-gray-600 dark:bg-gray-900 rounded-b-lg">
        <div class="p-4 lg:text-start text-center">
            <div>
                <span class="font-bold text-sm">Autor:</span>
                <span class="text-sm">Gilles Polian, Sebastián Aguilar Méndez</span>
            </div>
            <div class="mb-1">
                <span class="font-bold text-sm">Contacto:</span>
                <span class="text-sm">documentaciontseltal@gmail.com</span>
            </div>
            <a href="#" class="block lg:text-xl text-lg font-semibold dark:text-white">
                Manual de tseltal de Guaquitepec
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
            @endforelse
        </div>
    </div>

    <div class="py-2">
        <div class="px-2 lg:px-8">
            <div class="relative overflow-x-auto">
                <div class="flex flex-col sm:flex-row">
                    <div class="w-full sm:w-4/5 mb-4 lg:text-start">
                        <h1 class="text-3xl font-semibold mb-3 animate-pulse text-custom_app"><span
                                class="text-black">Lección {{ $ca->leccion }}:</span> {{ $ca->name }}
                        </h1>
                    </div>
                    <div class="w-full sm:w-1/5 mb-4">
                        <input type="text" id="search_palabras" placeholder="Buscar..." oninput="search_palabras()"
                            class="border w-full p-2 rounded focus:outline-none focus:ring-0 select-none">
                    </div>
                </div>

                <div class="mb-4">
                    <button id="botonReproducir" onclick="reproducirTodos()"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Reproducir Todos
                    </button>

                    <button id="botonPausar" onclick="window.pausarReproduccion()"
                        class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded hidden">
                        Pausar
                    </button>

                    <button id="botonContinuar" onclick="window.reanudarReproduccion()"
                        class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded hidden">
                        Continuar
                    </button>

                    <label id="estadoReproduccion" class="lg:mt-0 mt-2"></label>
                </div>





                <div class="relative overflow-x-auto">
                    <div class="shadow overflow-hidden sm:rounded-lg">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        <span class="lg:text-2xl">Tseltal</span>
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        <span class="lg:text-2xl">Español</span>
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        <span class="lg:text-2xl">Audio</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($palabras as $palabra)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
                                        data-id="{{ $palabra->id }}">
                                        <td class="px-6 py-4">
                                            <span class="lg:text-2xl font-bold">{{ $palabra->ortografia }}</span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="lg:text-2xl">{{ $palabra->traduccion }}</span>
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
    </div>



    <script>
        function playAudio(id) {
            var audio = document.getElementById('player' + id);

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

        window.reproducirTodos = function() {
            var palabras = {!! json_encode($palabras) !!};
            var index = 0;
            var isPaused = false;
            var audioElement;
            var posicionReproduccion = 0;
            var palabraActual; 

            function reproducirSiguiente() {
                if (index < palabras.length && !isPaused) {
                    var palabra = palabras[index];
                    palabraActual = palabra; // Asigna la palabra actual
                    var audioId = "player" + palabra.id;
                    audioElement = document.getElementById(audioId);

                    if (audioElement) {
                        try {
                            audioElement.currentTime = posicionReproduccion;
                            audioElement.play();
                            document.getElementById("estadoReproduccion").innerHTML =
                                "Reproduciendo: <strong>Tseltal:</strong> ➡️ " + palabra.ortografia +
                                "  <strong>Español:</strong> ➡️ " + palabra.traduccion;
                            audioElement.addEventListener("ended", function() {
                                index++;
                                posicionReproduccion = 0;
                                reproducirSiguiente();
                            });

                            // Mostrar el botón de pausar y ocultar el de reproducir
                            var botonPausar = document.getElementById("botonPausar");
                            var botonReproducir = document.getElementById("botonReproducir");

                            botonPausar.classList.remove('hidden');
                            botonReproducir.classList.add('hidden');

                            // Ocultar el botón de continuar
                            var botonContinuar = document.getElementById("botonContinuar");
                            botonContinuar.classList.add('hidden');
                        } catch (error) {
                            console.error("Error al reproducir audio:", error);
                            index++;
                            reproducirSiguiente();
                        }
                    } else {
                        console.warn("Elemento de audio no encontrado:", audioId);
                        index++;
                        reproducirSiguiente();
                    }
                } else {
                    if (!isPaused) {
                        document.getElementById("estadoReproduccion").innerText = "Todos los audios se han reproducido";
                    }
                }
            }

            window.pausarReproduccion = function() {
                if (audioElement) {
                    audioElement.pause();
                    isPaused = true;
                    posicionReproduccion = audioElement.currentTime;
                    document.getElementById("estadoReproduccion").innerText =
                        "Reproducción pausada en la palabra: " + palabraActual.ortografia;

                    var botonContinuar = document.getElementById("botonContinuar");
                    var botonPausar = document.getElementById("botonPausar");

                    botonContinuar.classList.remove('hidden');
                    botonPausar.classList.add('hidden');

                    // Ocultar el botón de reproducir
                    var botonReproducir = document.getElementById("botonReproducir");
                    botonReproducir.classList.add('hidden');
                }
            };

            window.reanudarReproduccion = function() {
                if (audioElement) {
                    audioElement.play();
                    isPaused = false;
                    document.getElementById("estadoReproduccion").innerText = "Reanudando reproducción";

                    // Mostrar el botón de pausar y ocultar el de continuar
                    var botonPausar = document.getElementById("botonPausar");
                    var botonContinuar = document.getElementById("botonContinuar");

                    botonPausar.classList.remove('hidden');
                    botonContinuar.classList.add('hidden');

                    // Ocultar el botón de reproducir
                    var botonReproducir = document.getElementById("botonReproducir");
                    botonReproducir.classList.add('hidden');
                }
            };

            reproducirSiguiente();
        };
    </script>
@endsection
