<?php

namespace App\Livewire;

use App\Models\Auto;
use Livewire\Component;

class CrearAuto extends Component
{
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
        'numof' => ['required', 'string', 'max:255'], // Oficio
    ];

    public function render()
    {
        return view('livewire.crear-auto');
    }

    public function create()
    {
        $this->validate();

        Auto::create([
            'numde' => $this->numde,
            'naciu' => $this->naciu,
            'tiden' => $this->tiden,
            'vemar' => $this->vemar,
            'vepla' => $this->vepla,
            'estde' => $this->estde,
            'resIns' => $this->resIns,
            'insce' => $this->insce,
            'nafis' => $this->nafis,
            'comsu' => $this->comsu,
            'estoc' => $this->estoc,
            'indpe' => $this->indpe,
            'indsu' => $this->indsu,
            'comsd' => $this->comsd,
            'ninfi' => $this->ninfi,
            'dareg' => $this->dareg,
            'numof' => $this->numof,
        ]);
        session()->flash('mensaje', '¡Auto creado correctamente!');
        return redirect()->route('dashboard');
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
}
