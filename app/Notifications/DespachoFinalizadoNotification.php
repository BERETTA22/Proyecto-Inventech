<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;
use App\Models\Despacho;

class DespachoFinalizadoNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $despacho;

    public function __construct(Despacho $despacho)
    {
        $this->despacho = $despacho;
    }

    public function via($notifiable)
    {
        return ['database', 'broadcast']; 
    }

    public function toDatabase($notifiable)
    {
        return [
            'mensaje' => "El despacho #{$this->despacho->id} ha sido finalizado.",
            'despacho_id' => $this->despacho->id,
            'url' => route('despachos.show', $this->despacho),
            'empleado_id' => $this->despacho->empleado_id,
            'fecha' => now()->format('Y-m-d H:i:s'),
        ];
    }
    public function toBroadcast($notifiable)
{
    return new BroadcastMessage([
        'mensaje' => "El despacho #{$this->despacho->id} ha sido finalizado.",
        'despacho_id' => $this->despacho->id,
        'url' => route('despachos.show', $this->despacho),
        'empleado_id' => $this->despacho->empleado_id,
        'fecha' => now()->format('Y-m-d H:i:s'),
    ]);
}
}
