<?php

namespace App\Http\Controllers;

class ContactoController extends Controller
{
    public function index()
    {
        return view('contacto');
    }

    public function store()
    {
        return redirect()->route('avisos.index')->with('mensaje', 'Tu mensaje fue enviado correctamente.');
    }
}