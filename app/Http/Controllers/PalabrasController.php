<?php

namespace App\Http\Controllers;

use App\Models\Palabras;
use App\Http\Requests\StorePalabrasRequest;
use App\Http\Requests\UpdatePalabrasRequest;
use App\Imports\PalabrasImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PalabrasController extends Controller
{

    public function index()
    {
        // $palabras = Palabras::paginate(8);
        $palabras = Palabras::all();
        return view('admin.palabras.index', compact('palabras'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePalabrasRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Palabras $palabras)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Palabras $palabras)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePalabrasRequest $request, Palabras $palabras)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Palabras $palabras)
    {
        //
    }


    public function importPalabras(Request $request)
    {
        $file = $request->file('excelFile');

        try {
            // Truncar la tabla antes de la importación
            Palabras::truncate();

            Excel::import(new PalabrasImport, $file);

            return redirect()->route('dashboard');
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }


    public function importarAudio(Request $request)
    {
        $request->validate([
            'audioFiles.*' => 'required|mimes:mp3,wav',
        ]);
    
        foreach ($request->file('audioFiles') as $file) {
            $originalName = $file->getClientOriginalName();
    
            $path = $file->move(public_path('audios'), $originalName);
        }
    
        return redirect()->back()->with('success', 'Archivos de audio importados correctamente.');
    }
    
}
