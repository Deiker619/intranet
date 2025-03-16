<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>



    <div class="py-6">
        <div class=" sm:px-6 lg:px-8">
            
            @livewire('mysql.form-recibo-pago')
      

        </div>
    </div>
    

</x-app-layout>
