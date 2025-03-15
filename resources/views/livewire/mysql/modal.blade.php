<div>


    @if ($show)
        <div id="crud-modal" tabindex="-1"
            class="overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full flex"
            aria-modal="true" role="dialog">
            <div class="relative p-4 w-full max-w-4xl max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                    <!-- Modal header -->
                    <div
                        class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                            Recibo de pago:
                            {{ $data['primera-quincena']->personal->nomper . ' ' . $data['primera-quincena']->personal->apeper }}
                        </h3>
                        <button wire:click='$set("show", false)' type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-toggle="crud-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"></path>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->



                    <!-- Breadcrumb -->
                    <nav class="flex px-5 py-3 text-gray-700 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-800 dark:border-gray-700"
                        aria-label="Breadcrumb">
                        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                            <li class="inline-flex items-center">
                                <a class="text-xs">

                                    {{ $data['primera-quincena']->personal->nomper }}
                                </a>
                            </li>
                            <li>
                                <div class="flex items-center">
                                    <svg class="rtl:rotate-180 block w-3 h-3 mx-1 text-gray-400 " aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 9 4-4-4-4" />
                                    </svg>
                                    <a href="#"
                                        class="ms-1 text-xs font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">V-{{ $data['primera-quincena']->personal->cedper }}</a>
                                </div>
                            </li>
                            <li aria-current="page">
                                <div class="flex items-center">
                                    <svg class="rtl:rotate-180  w-3 h-3 mx-1 text-gray-400" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 9 4-4-4-4" />
                                    </svg>
                                    <span
                                        class="ms-1 text-xs font-medium text-gray-500 md:ms-2 dark:text-gray-400">{{ $data['primera-quincena']->personal->descar ?? 'Desconocido' }}</span>
                                </div>
                            </li>
                        </ol>
                    </nav>

                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        {{-- Unidad de ubicación --}}
                        <table class="w-full text-sm text-center rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs w-full text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>

                                    <th scope="col" class="px-6 py-3">
                                        {{ $data['primera-quincena']->personal->desuniadm }}
                                    </th>
                                </tr>
                            </thead>
                        </table>
                        {{-- Tabla con los datos principales --}}
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>

                                    <th scope="col" class="px-6 py-3">
                                        Cuenta de banco
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Sueldo
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Sueldo integral
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Fecha ingreso
                                    </th>



                                </tr>
                            </thead>
                            <tbody>

                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">

                                    <td class="px-6 py-4">
                                        {{ $data['primera-quincena']->personal->codcueban }}
                                    </td>
                                    <td class="px-6 py-4">
                                        Bs.{{ number_format($data['primera-quincena']->personal->sueper, 2, '.', ',') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        Bs.{{ number_format($data['primera-quincena']->personal->sueintper, 2, '.', ',') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ date('d/m/Y', strtotime($data['primera-quincena']->personal->fecingper)) }}
                                    </td>


                                </tr>

                            </tbody>
                        </table>
                        {{-- Separador --}}

                        <div class="inline-flex items-center justify-center w-full">
                            <hr class="w-full h-px my-6 bg-gray-200 border-0 dark:bg-gray-700">
                            <span
                                class="absolute px-3 font-medium text-gray-900 -translate-x-1/2 bg-white left-1/2 dark:text-white dark:bg-gray-900">{{ $data['primera-quincena']->periodo->fechasper }}</span>
                        </div>


                        {{-- Deducciones y asignaciones --}}
                        <div class="md:grid md:grid-cols-2  sm:flex sm:flex-col ">
                            {{-- Asignaciones --}}
                            @livewire('mysql.asignaciones.asignaciones', ['data' => $data['primera-quincena']])
                            {{-- Deducciones --}}
                            @livewire('mysql.deducciones.deducciones', ['data' => $data['primera-quincena']])
                        </div>


                        @if ($data['segunda-quincena'])
                            {{-- Separador --}}

                            <div class="inline-flex items-center justify-center w-full">
                                <hr class="w-full h-px my-6 bg-gray-200 border-0 dark:bg-gray-700">
                                <span
                                    class="absolute px-3 font-medium text-gray-900 -translate-x-1/2 bg-white left-1/2 dark:text-white dark:bg-gray-900">{{ $data['segunda-quincena']->periodo->fechasper }}</span>
                            </div>
                            <div class="md:grid md:grid-cols-2  sm:flex sm:flex-col ">
                                {{-- Asignaciones --}}
                                @livewire('mysql.asignaciones.asignaciones', ['data' => $data['segunda-quincena']])
                                {{-- Deducciones --}}
                                @livewire('mysql.deducciones.deducciones', ['data' => $data['segunda-quincena']])
                            </div>
                        @endif

                        <div class=" flex flex-col justify-center p-4 gap-4 border md:flex-row w-full">
                            
                            <div class="flex flex-col md:flex-row gap-4">

                                <p> <span class="font-light"> Total ingresos:</span> {{$data['total_asignaciones']}} Bs.s </p> <span class="hidden md:flex"> |</span>
                                <p> <span class="font-light"> Total deducciones:</span> {{$data['total_deducciones']}} Bs.s </p>  <span class="hidden md:flex"> |</span>
                            </div>
                            <div class="flex flex-col justify-center">
                                <p> <span class="text-blue-700 font-semibold"> Neto a cobrar:</span> {{$data['total_asignaciones'] + $data['total_deducciones'] }} Bs.s</p> 

                            </div>
                        </div>
                    </div>
                    <div class="flex items-center justify-between p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                        <div class="flex items-center justify-start border ">
                            <button wire:click='prueba' data-modal-hide="static-modal" type="button"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Imprimir</button>
                            <button data-modal-hide="static-modal" type="button"
                                class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Cancelar</button>
                        </div>
                        
                    </div>


                </div>

            </div>
            <div class="bg-gray-900/50 dark:bg-gray-900/80 fixed inset-0 -z-10"></div>
        </div>
    @endif








</div>
