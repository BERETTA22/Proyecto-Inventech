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
     * Almacenar uno o varios archivos nuevos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required',
            'file.*' => 'mimes:jpg,jpeg,png,gif,webp,mp4,webm,ogg,mp3,wav|max:10240' // 10 MB por archivo
        ]);

        if ($request->hasFile('file')) {
            foreach ($request->file('file') as $archivo) {
                $filename = time() . '_' . $archivo->getClientOriginalName();
                $path = $archivo->storeAs('multimedia', $filename, 'public');

                Multimedia::create([
                    'nombre_archivo' => $archivo->getClientOriginalName(),
                    'tipo_archivo'   => $path,
                ]);
            }

            return redirect()->back()->with('success', 'Archivos subidos correctamente.');
        }

        return redirect()->back()->with('error', 'No se subió ningún archivo.');
    }

    /**
     * Eliminar un archivo.
     */
    public function destroy($id)
    {
        $file = Multimedia::findOrFail($id);

        // Eliminar archivo físico
        $path = str_replace('/storage/', 'public/', $file->tipo_archivo);
        Storage::delete($path);

        // Eliminar de la base de datos
        $file->delete();

        return redirect()->back()->with('success', 'Archivo eliminado correctamente.');
    }
}
