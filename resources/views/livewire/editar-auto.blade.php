<div class=" px-6" class="p-4">
    <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2 hover:scale-105 transition">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-blue-500">
            <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
        </svg>
        <p class="text-blue-500">Ir al inicio</p>
    </a>
    <h1 class="text-center text-2xl font-bold mb-8">Editar documento</h1>
    <div class="flex space-x-2 justify-center" >
        <button
            @if ($activeTab == 0)
                class='bg-blue-500 text-white px-4 py-2 border rounded'
            @else
                class="px-4 py-2 border rounded"
            @endif
            wire:click='activeTab0'
        >
            Datos Generales
        </button>
        <button
            @if ($activeTab == 1)
                class='bg-blue-500 text-white px-4 py-2 border rounded'
            @else
                class="px-4 py-2 border rounded"
            @endif
            wire:click='activeTab1'
        >
            Estado Denuncia
        </button>
        <button
            @if ($activeTab == 2)
                class='bg-blue-500 text-white px-4 py-2 border rounded'
            @else
                class="px-4 py-2 border rounded"
            @endif
            wire:click='activeTab2'
        >
            Orden Captura
        </button>
        <button
            @if ($activeTab == 3)
                class='bg-blue-500 text-white px-4 py-2 border rounded'
            @else
                class="px-4 py-2 border rounded"
            @endif
            wire:click='activeTab3'
        >
            Requisitos recepcion del vehiculo
        </button>
        <button
            @if ($activeTab == 4)
                class='bg-blue-500 text-white px-4 py-2 border rounded'
            @else
                class="px-4 py-2 border rounded"
            @endif
            wire:click='activeTab4'
        >
            Informe a Físcalia
        </button>
    </div>
    <form wire:submit.prevent='edit'>
        @csrf
        <div class=" w-3/4 mx-auto pb-6">
            {{-- datos generales --}}
            <div class="p-4 border rounded-lg shadow-lg mt-10
            @if ($activeTab == 0)
                block
            @else
                hidden
            @endif" >
                <h2 class="text-center mb-4 font-bold">Datos generales</h2>
                <div class="flex w-full gap-4">
                    <div class="w-full">
                        <x-input-label for="numde" :value="__('Documento')" />
                        <x-text-input id="numde" class="block mt-1 w-full bg-gray-300" type="text" wire:model="numde" :value="old('numde')" disabled autofocus />
                        <x-input-error :messages="$errors->get('numde')" class="mt-2" />
                    </div>
                    <div class="w-full">
                        <x-input-label for="naciu" :value="__('Nombre')" />
                        <x-text-input id="naciu" class="block mt-1 w-full bg-gray-300" type="text" wire:model="naciu" :value="old('naciu')" disabled autofocus />
                        <x-input-error :messages="$errors->get('naciu')" class="mt-2" />
                    </div>
                </div>
                <div class="flex w-full gap-4 mt-4">
                    <div class="w-full">
                        <x-input-label for="tiden" :value="__('Tipo de incidente')" />
                        <x-text-input id="tiden" class="block mt-1 w-full bg-gray-300" type="text" wire:model="tiden" :value="old('tiden')" disabled autofocus />
                        <x-input-error :messages="$errors->get('tiden')" class="mt-2" />
                    </div>
                    <div class="w-full">
                        <x-input-label for="vemar" :value="__('Marca')" />
                        <x-text-input id="vemar" class="block mt-1 w-full bg-gray-300" type="text" wire:model="vemar" :value="old('vemar')" disabled autofocus />
                        <x-input-error :messages="$errors->get('vemar')" class="mt-2" />
                    </div>
                    <div class="w-full">
                        <x-input-label for="vepla" :value="__('Placas')" />
                        <x-text-input id="vepla" class="block mt-1 w-full bg-gray-300" type="text" wire:model="vepla" :value="old('vepla')" disabled autofocus />
                        <x-input-error :messages="$errors->get('vepla')" class="mt-2" />
                    </div>
                </div>
            </div>
            {{-- estado denuncia --}}
            <div class="p-4 border rounded-lg shadow-lg mt-10
            @if ($activeTab == 1)
                block
            @else
                hidden
            @endif" >
                <h2 class="text-center font-bold mb-4">Estado de la Denuncia</h2>
                <div class="flex w-full gap-4">
                    <div class="w-full">
                        <x-input-label for="estde" :value="__('Estado')" />
                        <x-text-input id="estde" class="block mt-1 w-full" type="text" wire:model="estde" :value="old('estde')" required autofocus placeholder="Ej. En proceso"/>
                        <x-input-error :messages="$errors->get('estde')" class="mt-2" />
                    </div>
                    <div class="w-full">
                        <x-input-label for="resIns" :value="__('Instructor Responsable')" />
                        <x-text-input id="resIns" class="block mt-1 w-full" type="text" wire:model="resIns" :value="old('resIns')" required autofocus />
                        <x-input-error :messages="$errors->get('resIns')" class="mt-2" />
                    </div>
                </div>
                <div class="flex w-full gap-4 mt-4">
                    <div class="w-full">
                        <x-input-label for="insce" :value="__('Celular')" />
                        <x-text-input id="insce" class="block mt-1 w-full" type="text" wire:model="insce" :value="old('insce')" required autofocus />
                        <x-input-error :messages="$errors->get('insce')" class="mt-2" />
                    </div>
                    <div class="w-full">
                        <x-input-label for="nafis" :value="__('Fiscalia a Cargo')" />
                        <x-text-input id="nafis" class="block mt-1 w-full" type="text" wire:model="nafis" :value="old('nafis')" required autofocus />
                        <x-input-error :messages="$errors->get('nafis')" class="mt-2" />
                    </div>
                </div>
            </div>
            {{-- orden captura --}}
            <div class="p-4 border rounded-lg shadow-lg mt-10
            @if ($activeTab == 2)
                block
            @else
                hidden
            @endif" >
                <h2 class="text-center font-bold mb-4">Orden Captura del vehiculo</h2>
                <div class="w-full">
                    <x-input-label for="comsu" :value="__('Comunicado a SUNARP')" />
                    <x-text-input id="comsu" class="block mt-1 w-full" type="text" wire:model="comsu" :value="old('comsu')" required autofocus placeholder="Ej. En proceso"/>
                    <x-input-error :messages="$errors->get('comsu')" class="mt-2" />
                </div>
                <div class="w-full mt-4">
                    <x-input-label for="estoc" :value="__('Estado de Orden de Captura Activo')" />
                    <x-text-input id="estoc" class="block mt-1 w-full" type="text" wire:model="estoc" :value="old('estoc')" required autofocus />
                    <x-input-error :messages="$errors->get('estoc')" class="mt-2" />
                </div>
            </div>
            {{-- recepcion vehiculo --}}
            <div class="p-4 border rounded-lg shadow-lg mt-10
            @if ($activeTab == 3)
                block
            @else
                hidden
            @endif">
                <h2 class="text-center font-bold mb-4">Requisitos recepción vehiculo</h2>
                <div class="flex w-full gap-4">
                    <div class="w-full">
                        <x-input-label for="indpe" :value="__('Peritaje de Ley')" />
                        <x-text-input id="indpe" class="block mt-1 w-full" type="text" wire:model="indpe" :value="old('indpe')" required autofocus/>
                        <x-input-error :messages="$errors->get('indpe')" class="mt-2" />
                    </div>
                    <div class="w-full">
                        <x-input-label for="indsu" :value="__('Suspensión de Captura')" />
                        <x-text-input id="indsu" class="block mt-1 w-full" type="text" wire:model="indsu" :value="old('indsu')" required autofocus />
                        <x-input-error :messages="$errors->get('indsu')" class="mt-2" />
                    </div>
                </div>
                <div class="w-full mt-4">
                    <x-input-label for="comsd" :value="__('Comunicación a SUNARP desafectación')" />
                    <x-text-input id="comsd" class="block mt-1 w-full" type="text" wire:model="comsd" :value="old('comsd')" required autofocus/>
                    <x-input-error :messages="$errors->get('comsd')" class="mt-2" />
                </div>
            </div>
            {{-- informe a fiscalia --}}
            <div class="p-4 border rounded-lg shadow-lg mt-10 @if ($activeTab == 4)
                block
            @else
                hidden
            @endif">
                <h2 class="text-center font-bold mb-4">Informe a Físcalia</h2>
                <div class="flex w-full gap-4">
                    <div class="w-full">
                        <x-input-label for="ninfi" :value="__('Numero Informe')" />
                        <x-text-input id="ninfi" class="block mt-1 w-full" type="text" wire:model="ninfi" :value="old('ninfi')" required autofocus/>
                        <x-input-error :messages="$errors->get('indpe')" class="mt-2" />
                    </div>
                    <div class="w-full">
                        <x-input-label for="dareg" :value="__('Fecha de Registro')" />
                        <x-text-input id="dareg" class="block mt-1 w-full" type="date" wire:model="dareg" :value="old('dareg')" required autofocus />
                        <x-input-error :messages="$errors->get('indsu')" class="mt-2" />
                    </div>
                </div>
                <div class="w-full mt-4">
                    <x-input-label for="numof" :value="__('Oficio')" />
                    <x-text-input id="numof" class="block mt-1 w-full" type="text" wire:model="numof" :value="old('numof')" required autofocus/>
                    <x-input-error :messages="$errors->get('numof')" class="mt-2" />
                </div>
            </div>
        </div>
        <x-primary-button class=" ms-28">
            {{ __('Editar Registro') }}
        </x-primary-button>
    </form>
</div>
