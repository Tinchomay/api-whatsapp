<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Bitacora') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if (session()->has('mensaje'))
                        <div x-data="{show: true}" x-init="setTimeout(() => show = false, 3000)" x-show="show">
                            <div id="alert" class="uppercase border border-green-300 bg-green-100 text-green-600 font-bold p-2 my-3 text-center rounded-lg text-sm">
                                {{ session('mensaje') }}
                            </div>
                        </div>
                    @endif
                    <livewire:mostrar-autos>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
