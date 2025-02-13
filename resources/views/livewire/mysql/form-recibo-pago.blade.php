<div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
    <form class="max-w-xl md:mx-auto bg-white p-8 rounded-md m-8 md:m-4">
     
            <div class="mb-5 ">
                <label for="cedula" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    Cedula</label>
                <input type="text" id="cedula"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="name@flowbite.com" required />
            </div>
        

        <div class="grid grid-cols-2 gap-2">
            <div class="mb-5">
                <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Desde</label>
    
                <select id="countries" wire:change="setPeriodo($event.target.value)"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value=""></option>
                    @foreach ($periodos as $item)
                        <option value="{{$item->fecdesper}}"> {{$item->fecdesper}}</option>
                    @endforeach
                    
                </select>
            </div>
           
            <div class="mb-5">
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Hasta
                    </label>
                <input type="email" id="email" wire:model="fechasper" readonly
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="name@flowbite.com" required />
            </div>

        </div>



        <button  wire:click='dataSigesp()'
            class="text-white  bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full  px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Generar
            recibo de pago</button>
    </form>

    @livewire('mysql.modal')
</div>
