<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    
    <div class="py-12">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 gap-4 sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 flex items-center">
                    <i class="fas fa-tag text-gray-500 text-7xl"></i>
                    <div class="ms-4">
                        <span class="block text">Palabras</span>
                        <span class="font-bold text-2xl">{{ $totalpalabras }}</span>
                    </div>
                </div>
            </div>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 flex items-center">
                    <i class="fas fa-tag text-gray-500 text-7xl"></i>
                    <div class="ms-4">
                        <span class="block text">Capitulos</span>
                        <span class="font-bold text-2xl">{{ $totalCapitulos }}</span>
                    </div>
                </div>
            </div>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 flex items-center">
                    <i class="fas fa-tag text-gray-500 text-7xl"></i>
                    <div class="ms-4">
                        <span class="block text">Audios</span>
                        <span class="font-bold text-2xl">{{ $totalPalabrasConAudio }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>    
    
</x-app-layout>
