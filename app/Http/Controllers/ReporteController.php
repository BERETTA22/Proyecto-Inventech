<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reporte;
use App\Models\User;
use App\Notifications\NuevoReporteProblema;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Exception;

class ReporteController extends Controller
{
    /**
     * Permite a un empleado reportar un problema.
     */
    public function reportarProblema(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'descripcion' => 'required|string|max:500',
            'despacho_id' => 'required|exists:despachos,id',
        ]);

        // Asegurar que el usuario esté autenticado
        abort_if(!Auth::check(), 403, 'Debes iniciar sesión para reportar un problema.');

        try {
            // Crear el reporte
            $reporte = Reporte::create([
                'producto_id' => $request->producto_id,
                'descripcion' => $request->descripcion,
                'despacho_id' => $request->despacho_id,
                'empleado_id' => Auth::id(),
            ]);

            // Obtener el administrador
            $admin = User::where('role_id', 1)->first();

            // Enviar notificación si el administrador existe
            if ($admin) {
                $admin->notify(new NuevoReporteProblema($reporte));
                return redirect()->back()->with('success', 'Reporte enviado correctamente y notificación creada.');
            }

            return redirect()->back()->with('warning', 'Reporte guardado, pero no se encontró un administrador.');

        } catch (Exception $e) {
            Log::error('Error al reportar problema: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Hubo un error al enviar el reporte. Inténtalo de nuevo.');
        }
    }

    /**
     * Muestra un reporte específico.
     */
    public function verReporte($id)
    {
        $reporte = Reporte::with('despacho')->findOrFail($id);
        return view('reportes.ver', compact('reporte'));
    }
}
