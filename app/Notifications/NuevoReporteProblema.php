<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;

class NuevoReporteProblema extends Notification
{
    use Queueable;

    protected $reporte;

    public function __construct($reporte)
    {
        $this->reporte = $reporte;
    }

    public function via($notifiable)
    {
        return ['database', 'broadcast']; // Guardar en BD y enviar en tiempo real
    }

    public function toDatabase($notifiable)
    {
        return [
            'mensaje' => 'Se ha reportado un nuevo problema en un despacho.',
            'reporte_id' => $this->reporte->id,
            'despacho_id' => $this->reporte->despacho_id,
            'producto_id' => $this->reporte->producto_id,
            'empleado_id' => $this->reporte->empleado_id,
            'descripcion' => $this->reporte->descripcion,
            'fecha' => now()->format('Y-m-d H:i:s'),
            'url' => route('reportes.show', $this->reporte->id), // Ruta del reporte
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'mensaje' => 'Se ha reportado un problema en un despacho.',
            'reporte_id' => $this->reporte->id,
            'despacho_id' => $this->reporte->despacho_id,
            'producto' => $this->reporte->producto->nombre,
            'descripcion' => $this->reporte->descripcion,
        ]);
    }
}
