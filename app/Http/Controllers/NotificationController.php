<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class NotificationController extends Controller
{
    // Obtener todas las notificaciones no leídas
    public function index()
    {
        return response()->json(Auth::user()->unreadNotifications);
    }

    // Marcar una notificación específica como leída
    public function markAsRead($id)
    {
        $user = Auth::user(); // ✅ Definir $user

        if (method_exists($user, 'notifications')) {
            $notification = $user->notifications->find($id);
            if ($notification) {
                $notification->markAsRead();
                return response()->json(['success' => true]);
            }
        }

        return response()->json(['success' => false], 404);
    }

    // Marcar todas las notificaciones como leídas
    public function markAllAsRead()
    {
        $user = Auth::user(); // ✅ Definir $user

        if (method_exists($user, 'unreadNotifications')) {
            foreach ($user->unreadNotifications as $notification) {
                $notification->markAsRead(); // Marcar como leída
            }
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 500);
    }
    public function adminNotifications()
{
    $admin = Auth::user();

    // Asegurar que el usuario autenticado es un administrador
    if ($admin->role !== 'admin') {
        return response()->json(['error' => 'No autorizado'], 403);
    }

    // Obtener notificaciones no leídas
    $notificaciones = $admin->unreadNotifications;

    return view('admin.notificaciones', compact('notificaciones'));
}
public function obtenerNotificaciones()
{
    return response()->json(Auth::user()->unreadNotifications);
}
    
}
