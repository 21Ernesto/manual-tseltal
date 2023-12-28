<?php

namespace App\Http\Controllers;

use App\Models\Capitulos;
use App\Http\Requests\StoreCapitulosRequest;
use App\Http\Requests\UpdateCapitulosRequest;
use App\Models\Palabras;
use Illuminate\Http\Request;


class CapitulosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $capitulos = Capitulos::all();
        return view('welcome', compact('capitulos'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $request->validate([
            'leccion' => 'required|string|max:50',
            'name' => 'required|string|max:255',
        ]);

        Capitulos::create([
            'leccion' => $request->input('leccion'),
            'name' => $request->input('name'),
        ]);

        return redirect()->route('palabras');
    }

    /**
     * Display the specified resource.
     */
    public function show(Capitulos $capitulos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Capitulos $capitulos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCapitulosRequest $request, Capitulos $capitulos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Capitulos $capitulos)
    {
        //
    }

    public function mostrarPalabras($leccion)
    {
        $capitulos = Capitulos::all();
        $ca = Capitulos::where('leccion', $leccion)->firstOrFail();
        $palabras = Palabras::where('capitulo_id', $ca->leccion)->get();

        return view('capitulos_detalle', compact('palabras', 'capitulos', 'ca'));
    }


    public function mostrarCount(){
        $totalpalabras = Palabras::count();
        $totalCapitulos = Capitulos::count();
        $totalPalabrasConAudio = Palabras::whereNotNull('audio')->count();


        return view('admin.dashboard', compact('totalpalabras', 'totalCapitulos', 'totalPalabrasConAudio'));
    }
}
