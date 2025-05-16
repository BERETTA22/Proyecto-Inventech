<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;

class DespachoAsignado extends Notification
{
    use Queueable;

    protected $despacho;

    public function __construct($despacho)
    {
        $this->despacho = $despacho;
    }

    public function via($notifiable)
    {
        return ['database', 'broadcast']; // Guardar en base de datos
    }

    public function toDatabase($notifiable)
    {
        return [
            'despacho_id' => $this->despacho->id,
            'mensaje' => 'Se te ha asignado un nuevo despacho.',
            'fecha' => now()->format('Y-m-d H:i:s'),
            'url' => route('empleados.despachos.detalle', $this->despacho->id),
        ];
    }
    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'mensaje' => '¡Te han asignado un pedido!',
            'despacho_id' => $this->despacho->id,
        ]);
    }
}
