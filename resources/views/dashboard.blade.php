<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
             <h1>Personas de la intranet (conexion con Mysql)</h1>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                {{-- <x-welcome /> --}}
                @livewire('mysql.productos') {{-- USuarios de mysql  --}}

            </div>
        </div>
    </div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
             <h1>Personas del SIGESP (conexion con Posgresql)</h1>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                {{-- <x-welcome /> --}}
                @livewire('postgresql.personal') {{-- USuarios de mysql  --}}

            </div>
        </div>
    </div>

</x-app-layout>
