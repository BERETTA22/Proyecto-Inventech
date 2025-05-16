<?php

namespace App\Http\Controllers;

use App\Models\Chef;
use Illuminate\Http\Request;

class ChefController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $chef = Chef::all();
        return view('Chef.index', compact('chef'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Chef.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $chef= new Chef();

        $chef -> Nombre = $request -> nombre;
        $chef -> Años_experiencia = $request -> experiencia;
        $chef -> Nacionalidad = $request -> nacionalidad;
        $chef -> Especialidad = $request -> especialidad;
        $chef -> Restaurante = $request -> restaurante;

        $chef -> save();

        return redirect()->route('chef.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

    $chef = Chef::findOrFail($id); // Busca el chef por su ID o lanza un error si no se encuentra
    return view('Chef.edit', compact('chef')); // Retorna la vista con los datos del chef
}


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
       

    // Valida los datos
    $request->validate([
        'nombre' => 'required|string|max:255',
        'experiencia' => 'required|integer|min:0',
        'nacionalidad' => 'required|string|max:255',
        'especialidad' => 'required|string|max:255',
        'restaurante' => 'required|string|max:255',
    ]);

    // Encuentra el chef y actualiza los datos
    $chef = Chef::findOrFail($id);
    $chef->Nombre = $request->nombre;
    $chef->Años_experiencia = $request->experiencia;
    $chef->Nacionalidad = $request->nacionalidad;
    $chef->Especialidad = $request->especialidad;
    $chef->Restaurante = $request->restaurante;

    $chef->save(); // Guarda los cambios

    return redirect()->route('chef.index')->with('success', 'Chef actualizado correctamente.');
}

    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
    
    $chef = Chef::findOrFail($id); // Encuentra el chef por su ID
    $chef->delete(); // Elimina el chef
    return redirect()->route('chef.index')->with('success', 'Chef eliminado correctamente.');
}

    
}
