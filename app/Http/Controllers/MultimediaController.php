<?php

namespace App\Http\Controllers;

use App\Models\Multimedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MultimediaController extends Controller
{
    /**
     * Mostrar todos los archivos.
     */
    public function index()
    {
        $files = Multimedia::all(); // Obtiene todos los registros
        return view('Multimedia.index', compact('files'));
    }

    /**
     * Almacenar un archivo nuevo.
     */
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:jpg,jpeg,png,gif,webp|max:2048', // Tamaño máximo de 2 MB
        ]);
    
        $file = $request->file('file');
    
        $filename = time() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('multimedia', $filename, 'public'); // Guarda el archivo con el nombre original
        
    
        // Crear el registro en la base de datos
        Multimedia::create([
            'nombre_archivo' => $file->getClientOriginalName(), // Nombre original
            'tipo_archivo' => $path, // Guarda solo el path relativo
        ]);
    
        return redirect()->back()->with('success', 'Archivo subido correctamente.');
    }
    

    /**
     * Eliminar un archivo.
     */
    public function destroy($id)
    {
        $file = Multimedia::findOrFail($id); // Encuentra el registro

        // Eliminar el archivo físico
        $path = str_replace('/storage/', 'public/', $file->tipo_archivo); // Ajustar el path
        Storage::delete($path);

        // Eliminar el registro de la base de datos
        $file->delete();

        return redirect()->back()->with('success', 'Archivo eliminado correctamente.');
    }
}
