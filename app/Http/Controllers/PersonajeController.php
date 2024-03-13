<?php

namespace App\Http\Controllers;

use App\Models\Personaje;
use App\Models\Raza;
use App\Http\Requests\StorePersonajeRequest;
use App\Http\Requests\UpdatePersonajeRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class PersonajeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $personajes = Personaje::all();

        return view('personajes.index', compact('personajes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $razas = Raza::all();

        return view('personajes.create', compact('razas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string',
            'raza_id' => 'required|exists:razas,id',
            'clase' => 'required|string',
            'habilidades' => 'required|string',
            'imagen' => 'required|image|mimes:jpeg,jpg,png,webp,avif',
        ]);

        $validated['user_id'] = auth()->id();

        if($request->hasFile('imagen')) {
            $validated['imagen'] = $request->file('imagen')->store('public/images');
        }

        Personaje::create($validated);

        return redirect()->route('personajes.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Personaje $personaje)
    {
        return view('personajes.show', compact('personaje'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $personaje = Personaje::findOrFail($id);
        $razas = Raza::all();

        return view('personajes.edit', compact('personaje', 'razas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $personaje = Personaje::findOrFail($id);

        $validated = $request->validate([
            'nombre' => 'required|string',
            'raza_id' => 'required|exists:razas,id',
            'clase' => 'required|string',
            'habilidades' => 'required|string',
            'imagen' => 'required|image|mimes:jpeg,jpg,png,webp,avif'
        ]);

        if($request->hasFile('imagen')) {
            Storage::delete($personaje->imagen);
            $validated['imagen'] = $request->file('imagen')->store('public/images');
        }

        $personaje->update($validated);

        return redirect()->route('personajes.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $personaje = Personaje::findOrFail($id);
        Storage::delete($personaje->imagen);
        $personaje->delete();

        return redirect()->route('personajes.index');
    }

    public function misPersonajes() {
        $personajes = Personaje::where('user_id', auth()->id())->get();

        return view('personajes.misPersonajes', compact('personajes'));
    }
}
