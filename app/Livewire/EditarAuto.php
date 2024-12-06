<?php

namespace App\Livewire;

use Livewire\Component;

class EditarAuto extends Component
{
    public $auto;
    public $numde;
    public $naciu;
    public $tiden;
    public $vemar;
    public $vepla;
    public $estde;
    public $resIns;
    public $insce;
    public $nafis;
    public $comsu;
    public $estoc;
    public $indpe;
    public $indsu;
    public $comsd;
    public $ninfi;
    public $dareg;
    public $numof;
    public $activeTab = 0;

    public function mount($auto)
    {
        $this->auto = $auto;
        $this->numde = $auto['numde'] ?? null;
        $this->naciu = $auto['naciu'] ?? null;
        $this->tiden = $auto['tiden'] ?? null;
        $this->vemar = $auto['vemar'] ?? null;
        $this->vepla = $auto['vepla'] ?? null;
        $this->estde = $auto['estde'] ?? null;
        $this->resIns = $auto['resIns'] ?? null;
        $this->insce = $auto['insce'] ?? null;
        $this->nafis = $auto['nafis'] ?? null;
        $this->comsu = $auto['comsu'] ?? null;
        $this->estoc = $auto['estoc'] ?? null;
        $this->indpe = $auto['indpe'] ?? null;
        $this->indsu = $auto['indsu'] ?? null;
        $this->comsd = $auto['comsd'] ?? null;
        $this->ninfi = $auto['ninfi'] ?? null;
        $this->dareg = $auto['dareg'] ?? null;
        $this->numof = $auto['numof'] ?? null;
    }

    protected $rules = [
        'numde' => ['required', 'string', 'max:255'],
        'naciu' => ['required', 'string', 'max:255'],
        'tiden' => ['required', 'string', 'max:255'],
        'vemar' => ['required', 'string', 'max:255'],
        'vepla' => ['required', 'string', 'max:255'],
        'estde' => ['required', 'string', 'max:255'],
        'resIns' => ['required', 'string', 'max:255'],
        'insce' => ['required', 'string', 'max:15'],
        'nafis' => ['required', 'string', 'max:255'],
        'comsu' => ['required', 'string', 'max:255'],
        'estoc' => ['required', 'string', 'max:255'],
        'indpe' => ['required', 'string', 'max:255'],
        'indsu' => ['required', 'string', 'max:255'],
        'comsd' => ['required', 'string', 'max:255'],
        'ninfi' => ['required', 'string', 'max:255'],
        'dareg' => ['required', 'date'],
        'numof' => ['required', 'string', 'max:255'],
    ];

    public function render()
    {
        return view('livewire.editar-auto');
    }
    public function activeTab4()
    {
        $this->activeTab = 4;
        $this->render();
    }
    public function activeTab3()
    {
        $this->activeTab = 3;
        $this->render();
    }
    public function activeTab2()
    {
        $this->activeTab = 2;
        $this->render();
    }
    public function activeTab1()
    {
        $this->activeTab = 1;
        $this->render();
    }
    public function activeTab0()
    {
        $this->activeTab = 0;
        $this->render();
    }

    public function edit()
    {
        $this->validate();

        $this->auto->estde = $this->estde;
        $this->auto->resIns = $this->resIns;
        $this->auto->insce = $this->insce;
        $this->auto->nafis = $this->nafis;
        $this->auto->comsu = $this->comsu;
        $this->auto->estoc = $this->estoc;
        $this->auto->indpe = $this->indpe;
        $this->auto->indsu = $this->indsu;
        $this->auto->comsd = $this->comsd;
        $this->auto->ninfi = $this->ninfi;
        $this->auto->dareg = $this->dareg;
        $this->auto->numof = $this->numof;

        $this->auto->save();

        session()->flash('mensaje', '¡Auto actualizado correctamente!');
        return redirect()->route('dashboard');
    }
}
