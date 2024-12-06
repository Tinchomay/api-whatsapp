<?php

namespace App\Http\Controllers;

use App\Models\Auto;
use Illuminate\Http\Request;

class BitacoraController extends Controller
{
    //

    public function index()
    {
        return view('bitacora.index');
    }

    public function create()
    {
        return view('documentos.create');
    }

    public function edit(Auto $auto)
    {
        return view('documentos.edit', [
            'auto' => $auto
        ]);
    }
}
