<?php

namespace App\Livewire;

use App\Models\Auto;
use Livewire\Component;
use Livewire\WithPagination;

class MostrarAutos extends Component
{
    use WithPagination;

    public $search = '';

    public function render()
    {
        $autos = Auto::where('numde', 'LIKE', "%{$this->search}%")->orderBy('dareg', 'DESC')->paginate(20);
        return view('livewire.mostrar-autos', [
            'autos' => $autos
        ]);
    }
}
