@php
    Use Carbon\Carbon;
@endphp
<div>
    <h1 class="text-center text-2xl font-bold mb-4">Datos de los autos</h1>
    <div class="flex w-full justify-between px-4">
        <div class="px-2 mb-3">
            <label for="search" class="block text-gray-700 font-bold">Buscar documento</label>
            <input wire:model.live='search' type="text" class="mt-1 block w-full p-2 border border-gray-300 rounded shadow text-blue-600" id="search">
        </div>
        <div class="flex items-center">
            <a href="{{ route('createDocument') }}" class="flex gap-2 bg-blue-600 text-white px-2 py-1 rounded-lg hover:scale-105 transition">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                Agregar Documento
            </a>
        </div>
    </div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <div x-data="{ activeTab: 0 }" class="p-4">
            <div class="flex space-x-4 mb-4">
                <button
                    @click="activeTab = 0"
                    :class="{'bg-blue-500 text-white': activeTab === 0}"
                    class="px-4 py-2 border rounded"
                >
                    Datos Generales
                </button>
                <button
                    @click="activeTab = 1"
                    :class="{'bg-blue-500 text-white': activeTab === 1}"
                    class="px-4 py-2 border rounded"
                >
                    Estado Denuncia
                </button>
                <button
                    @click="activeTab = 2"
                    :class="{'bg-blue-500 text-white': activeTab === 2}"
                    class="px-4 py-2 border rounded"
                >
                    Orden Captura
                </button>
                <button
                    @click="activeTab = 3"
                    :class="{'bg-blue-500 text-white': activeTab === 3}"
                    class="px-4 py-2 border rounded"
                >
                    Requisitos recepcion del vehiculo
                </button>
                <button
                    @click="activeTab = 4"
                    :class="{'bg-blue-500 text-white': activeTab === 4}"
                    class="px-4 py-2 border rounded"
                >
                    Informe a Físcalia
                </button>
            </div>
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-sm text-gray-700 bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-1 py-3">
                            Editar
                        </th>
                        <th scope="col" class="px-1 py-3">
                            Documento
                        </th>
                        <th scope="col" class="px-1 py-3" x-show="activeTab === 0">
                            Nombre
                        </th>
                        <th scope="col" class="px-1 py-3" x-show="activeTab === 0">
                            Tipo
                        </th>
                        <th scope="col" class="px-1 py-3" x-show="activeTab === 0">
                            Marca
                        </th>
                        <th scope="col" class="px-1 py-3" x-show="activeTab === 0">
                            Placas
                        </th>
                        <th scope="col" class="px-1 py-3" x-show="activeTab === 1">
                            Estatus
                        </th>
                        <th scope="col" class="px-1 py-3" x-show="activeTab === 1">
                            Instructor
                        </th>
                        <th scope="col" class="px-1 py-3" x-show="activeTab === 1">
                            Celular
                        </th>
                        <th scope="col" class="px-1 py-3" x-show="activeTab === 1">
                            Fiscalia
                        </th>
                        {{-- 2 --}}
                        <th scope="col" class="px-1 py-3" x-show="activeTab === 2">
                            Comunicación a SUNARP
                        </th>
                        <th scope="col" class="px-1 py-3" x-show="activeTab === 2">
                            Estado de Orden de Captura Activo
                        </th>
                        {{-- 3 --}}
                        <th scope="col" class="px-1 py-3" x-show="activeTab === 3">
                            Peritaje de Ley
                        </th>
                        <th scope="col" class="px-1 py-3" x-show="activeTab === 3">
                            Supensión de captura
                        </th>
                        <th scope="col" class="px-1 py-3" x-show="activeTab === 3">
                            Comunicación a SUNARP desafectación
                        </th>
                        {{-- 4 --}}
                        <th scope="col" class="px-1 py-3" x-show="activeTab === 4">
                            Numero Informe
                        </th>
                        <th scope="col" class="px-1 py-3" x-show="activeTab === 4">
                            Fecha de Registro
                        </th>
                        <th scope="col" class="px-1 py-3" x-show="activeTab === 4">
                            Oficio
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($autos as $auto)
                        <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 text-sm">
                            <td class="px-1 gap-1">
                                <a href="{{ route('editDocument', $auto) }}" class="inline-flex gap-2 items-center hover:scale-105 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 text-blue-600">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                    </svg>
                                    <p class="font-medium text-blue-600 dark:text-blue-500">Editar</p>
                                </a>
                            </td>
                            <th scope="row" class="px-1 py-4 font-medium text-gray-900 dark:text-white">
                                {{ $auto->numde }}
                            </th>
                            <td class="px-1 py-4" x-show="activeTab === 0">
                                {{ $auto->naciu }}
                            </td>
                            <td class="px-1 py-4" x-show="activeTab === 0">
                                {{ $auto->tiden }}
                            </td>
                            <td class="px-1 py-4" x-show="activeTab === 0">
                                {{ $auto->vemar }}
                            </td>
                            <td class="px-1 py-4" x-show="activeTab === 0">
                                {{ $auto->vepla }}
                            </td>
                            <td class="px-1 py-4" x-show="activeTab === 1">
                                {{ $auto->estde }}
                            </td>
                            <td class="px-1 py-4" x-show="activeTab === 1">
                                {{ $auto->resIns }}
                            </td>
                            <td class="px-1 py-4 "x-show="activeTab === 1">
                                {{ $auto->insce }}
                            </td>
                            <td class="px-1 py-4" x-show="activeTab === 1">
                                {{ $auto->nafis }}
                            </td>
                            <td class="px-1 py-4" x-show="activeTab === 2">
                                {{ $auto->comsu }}
                            </td>
                            <td class="px-1 py-4" x-show="activeTab === 2">
                                {{ $auto->estoc }}
                            </td>
                            <td class="px-1 py-4" x-show="activeTab === 3">
                                {{ $auto->indpe }}
                            </td>
                            <td class="px-1 py-4" x-show="activeTab === 3">
                                {{ $auto->indsu }}
                            </td>
                            <td class="px-1 py-4" x-show="activeTab === 3">
                                {{ $auto->comsd }}
                            </td>
                            <td class="px-1 py-4" x-show="activeTab === 4">
                                {{ $auto->ninfi }}
                            </td>
                            <td class="px-1 py-4" x-show="activeTab === 4">
                                {{ Carbon::parse($auto->dareg)->format('d-m-Y') }}
                            </td>
                            <td class="px-1 py-4" x-show="activeTab === 4">
                                {{ $auto->numof }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
    @if(count($autos->links()->elements[0]) > 1)
        <div class="mt-12">
            {{ $autos->links() }}
        </div>
    @endif
</div>
