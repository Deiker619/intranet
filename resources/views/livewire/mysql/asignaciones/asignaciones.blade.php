<div>
    {{-- Asignaciones --}}
    <div class="col-span-1 w-full">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-lime-100 dark:bg-gray-700 dark:text-gray-400">
                <tr>

                    <th scope="col" class="px-6 py-3">
                        Asignaciones
                    </th>
                </tr>
            </thead>
        </table>
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>

                    <th scope="col" class="px-6 py-3">
                        Conceptos
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Asignaciones
                    </th>




                </tr>
            </thead>
            <tbody>

                @foreach ($data->asignaciones as $item)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                        <td class="px-6 py-4">
                            {{ $item->nomcon }}
                        </td>
                        <td class="px-6 py-4">
                            Bs.{{ number_format($item->valsal, 2, '.', ',') }}
                        </td>



                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</div>
