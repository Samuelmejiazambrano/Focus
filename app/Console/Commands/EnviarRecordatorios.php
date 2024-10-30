<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Pago;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class EnviarRecordatorios extends Command
{
    protected $signature = 'enviar:recordatorios';
    protected $description = 'Enviar recordatorios de pago a clientes que se vencen en los próximos 3 días';

    public function handle()
    {
        $fechaActual = Carbon::now();
    
        $pagos = Pago::with('cliente')
            ->whereNotNull('fecha_inicio')
            ->get()
            ->filter(function ($pago) use ($fechaActual) {
                $fechaVencimiento = Carbon::parse($pago->fecha_fin);
                return $fechaVencimiento->isToday() || ($fechaVencimiento->isFuture() && $fechaVencimiento->diffInDays($fechaActual) <= 3);
            });
        
        Log::info('Pagos a enviar recordatorios:', ['pagos' => $pagos]);

        if ($pagos->isEmpty()) {
            $this->info('No hay pagos que necesiten recordatorios.');
            return;
        }
        
        foreach ($pagos as $pago) {
            $nombresApellidos = $pago->cliente->nombres_apellidos ?? 'Cliente no encontrado';
            $fechaVencimiento = Carbon::parse($pago->fecha_fin)->format('d/m/Y');

            try {
                Mail::send('emails.recordatorio_pago', [
                    'nombresApellidos' => $nombresApellidos,
                    'fechaVencimiento' => $fechaVencimiento,
                ], function ($message) use ($pago) {
                    $message->to($pago->cliente->email)
                            ->subject('Recordatorio de Vencimiento de Plan');
                });
                
                $this->info('Recordatorio enviado a ' . $nombresApellidos . ' (' . $pago->cliente->email . ')');
                Log::info('Correo de recordatorio enviado correctamente', ['cliente' => $nombresApellidos]);

            } catch (\Exception $e) {
                Log::error('Error al enviar correo a ' . $nombresApellidos . ' (' . $pago->cliente->email . '): ' . $e->getMessage(), [
                    'cliente' => $nombresApellidos,
                    'email' => $pago->cliente->email,
                    'error' => $e->getMessage()
                ]);
            }
        }
        
        $this->info('Recordatorios enviados a ' . $pagos->count() . ' clientes.');
    }
}
