<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center h-full">
            <div class="w-1/2">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Palabras') }}
                </h2>
            </div>
            <div class="w-1/2 text-right">
                <button
                    class="bg-custom_app text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline-blue active:bg-blue-800 dark:active:custom_app"
                    onclick="openModal('capitulos')">
                    Nuevo capitulo
                </button>
                <button class="bg-custom_app text-white font-bold py-2 px-4 rounded" onclick="openModal('importModal')">
                    Importar desde Excel
                </button>
                <button class="bg-custom_app text-white font-bold py-2 px-4 rounded" onclick="openModal('importAudio')">
                    Importar audios
                </button>

            </div>
        </div>
    </x-slot>


    <div class="py-12">
        <div class="gap-4 sm:px-6 lg:px-8">
            <div class="mb-4">
                <input type="text" id="search_palabras" placeholder="Buscar..." class="border p-2 rounded w-60"
                    oninput="search_palabras()">
            </div>
            <div class="relative overflow-x-auto w-full">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">Ortografía</th>
                            <th scope="col" class="px-6 py-3">Traducción</th>
                            <th scope="col" class="px-6 py-3">Audio</th>
                            <th scope="col" class="px-6 py-3">Capítulo</th>
                            <th scope="col" class="px-6 py-3">Observación</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($palabras as $palabra)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $palabra->ortografia }}</th>
                                <td class="px-6 py-4">{{ $palabra->traduccion }}</td>
                                <td class="px-6 py-4">{{ $palabra->audio }}</td>
                                <td class="px-6 py-4">{{ $palabra->capitulo_id }}</td>
                                <td class="px-6 py-4">{{ $palabra->observacion }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>


    <div class="fixed z-10 inset-0 overflow-y-auto hidden" id="capitulos">
        <div class="flex items-center justify-center min-h-screen w-full p-4">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>

            <div
                class="bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">
                <form action="{{ route('capitulos.store') }}" method="POST">
                    @csrf

                    <div class="bg-gray-200 dark:bg-gray-700 px-4 py-2">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Nuevo capitulo</h3>
                    </div>

                    <div class="p-4">
                        <div class="mb-4">
                            <label for="leccion"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Lección:</label>
                            <input type="text" required name="leccion" id="leccion" placeholder="Ej.: 1"
                                class="mt-1 p-2 w-full border rounded-md focus:ring-2 focus:ring-blue-500">

                        </div>
                        <div class="mb-4">
                            <label for="name"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nombre</label>
                            <input type="text" required name="name" id="name"
                                placeholder="Ej.: Guía de Pronunciación" class="mt-1 p-2 w-full border rounded-md">
                        </div>

                        <div class="flex justify-end">
                            <button type="button"
                                class="inline-flex justify-center px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-100 bg-gray-200 dark:bg-gray-600 border border-gray-300 dark:border-gray-700 rounded-md hover:bg-gray-300 dark:hover:bg-gray-700 focus:outline-none focus-visible:ring focus-visible:ring-gray-500 dark:focus-visible:ring-gray-300"
                                onclick="closeModal('capitulos')">Cancelar</button>
                            <button type="submit"
                                class="ml-3 inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-custom_app  border border-transparent rounded-md hover:custom_app  focus:outline-none focus-visible:ring  ">Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="fixed z-10 inset-0 overflow-y-auto hidden" id="importModal">
        <div class="flex items-center justify-center min-h-screen w-full p-4">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>

            <div
                class="bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">
                <form action="{{ route('importar.palabras') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="bg-gray-200 dark:bg-gray-700 px-4 py-2">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Importar desde Excel</h3>
                    </div>

                    <div class="p-4">
                        <div class="mb-4">
                            <label for="excelFile"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Seleccione un
                                archivoExcel</label>
                            <input type="file" name="excelFile" id="excelFile" accept=".xls, .xlsx"
                                class="mt-1 p-2 w-full border rounded-md">
                        </div>

                        <div class="flex justify-end">
                            <button type="button"
                                class="inline-flex justify-center px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-100 bg-gray-200 dark:bg-gray-600 border border-gray-300 dark:border-gray-700 rounded-md hover:bg-gray-300 dark:hover:bg-gray-700 focus:outline-none focus-visible:ring focus-visible:ring-gray-500 dark:focus-visible:ring-gray-300"
                                onclick="closeModal('importModal')">Cancelar</button>
                            <button type="submit"
                                class="ml-3 inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-custom_app  border border-transparent rounded-md hover:custom_app  focus:outline-none focus-visible:ring  ">Importar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="fixed z-10 inset-0 overflow-y-auto hidden" id="importAudio">
        <div class="flex items-center justify-center min-h-screen w-full p-4">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>

            <div
                class="bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">
                <form action="{{ route('importarAudio') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="bg-gray-200 dark:bg-gray-700 px-4 py-2">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Importar Audios
                        </h3>
                    </div>

                    <div class="p-4">

                        <div class="mb-4">
                            <label for="audioFiles"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Seleccione los
                                audios</label>
                            <input type="file" name="audioFiles[]" id="audioFiles" accept=".mp3, .wav" multiple
                                class="mt-1 p-2 w-full border rounded-md">
                        </div>

                        <div class="flex justify-end">
                            <button type="button"
                                class="inline-flex justify-center px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-100 bg-gray-200 dark:bg-gray-600 border border-gray-300 dark:border-gray-700 rounded-md hover:bg-gray-300 dark:hover:bg-gray-700 focus:outline-none focus-visible:ring focus-visible:ring-gray-500 dark:focus-visible:ring-gray-300"
                                onclick="closeModal('importAudio')">Cancelar</button>
                            <button type="submit"
                                class="ml-3 inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-custom_app  border border-transparent rounded-md hover:custom_app  focus:outline-none focus-visible:ring  ">Importar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script>
        function openModal(modalId) {
            var modal = document.getElementById(modalId);
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeModal(modalId) {
            var modal = document.getElementById(modalId);
            modal.classList.remove('flex');
            modal.classList.add('hidden');
        }
    </script>


    <script></script>


</x-app-layout>
