@extends('layouts.user')

@section('main')
    <nav class="bg-white border-gray-200 dark:border-gray-600 dark:bg-gray-900 rounded-b-lg">
        <div class="p-4 text-center">
            <div>
                <a href="{{ route('capitulos') }}" class="lg:text-xl text-lg font-semibold dark:text-white">
                    Manual de tseltal de Guaquitepec
                </a>
            </div>
            <div>
                <span class="font-bold text-sm">Autores:</span>
                <span class="text-sm">Gilles Polian, Sebastián Aguilar Méndez</span>
            </div>
            <div class="mb-1">
                <span class="font-bold text-sm">Contacto:</span>
                <span class="text-sm">documentaciontseltal@gmail.com</span>
            </div>
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

        <div class="py-16 px-7 text-center">
            <p>Bienvenidas, bienvenidos a esta página donde se presentan los audios que
                acompañan el libro impreso Ya jnop
                tseltal: Manual y gramática pedagógica del tseltal (Polian y Aguilar Méndez 2024). Se trata de un manual de
                aprendizaje del idioma maya tseltal, tal como se habla en el pueblo de Guaquitepec, municipio de Chilón,
                Chiapas, México. Su objetivo es alcanzar un nivel intermedio, suficiente para sostener conversaciones
                simples en tseltal y comprender las estructuras básicas del idioma. Sus 20 lecciones más los anexos,
                presentan de forma progresiva expresiones usuales, el vocabulario y las reglas gramaticales esenciales. Cada
                lección termina con ejercicios de revisión con sus respuestas.
            </p>

            <p class="mt-7">
                Si usted quiere conseguir un ejemplar impreso o desea más información, contáctenos por favor en el siguiente
                correo: <span class="text-blue-500">documentaciontseltal@gmail.com</span>
            </p>

            <p class="mt-7">
                Le invitamos a conocer nuestros otros trabajos sobre el idioma tseltal en la siguiente página:
                <a href="https://tseltal.aldelim.org/."><span class="text-blue-500">Ir diccionario Tseltal</span></a>
            </p>
        </div>

    </div>
@endsection
