<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    
    <div class="py-6 px-6 rounded">
        @livewire('greeting')
        <section class="bg-white dark:bg-gray-900 ">
            <div class="grid max-w-screen-xl px-4 py-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12 ">
                <div class="mr-auto place-self-center lg:col-span-7 motion-preset-flomoji-🚀 motion-preset-slide-right motion-duration-700 ">
                    <h1 class="max-w-2xl mb-4 text-4xl font-extrabold tracking-tight leading-none md:text-5xl xl:text-6xl dark:text-white ">Genera tus recibos de pago automáticamente</h1>
                    <p class="max-w-2xl mb-6 font-light text-gray-500 lg:mb-8 md:text-lg lg:text-xl dark:text-gray-400">Selecciona un mes, genera tu recibo de pago y enterate de tus asignaciones. </p>
                    <a href="{{route('constancia')}}" class=" hidden md:inline-flex bg-blue-700 items-center justify-center px-5 py-3 mr-3 text-base font-medium text-center text-white rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:focus:ring-primary-900">
                        Quiero generar mi constancia de trabajo
                        <svg class="w-5 h-5 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </a>
                    
                </div>
                <div class=" w-full lg:mt-0 lg:col-span-5 lg:flex ">
                    @livewire('mysql.form-recibo-pago')
                </div>                
            </div>
            <div class=" sm:px-6 lg:px-8">
        </section>
            
            
      

        </div>
    </div>
    

</x-app-layout>
