<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Pago;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

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
            return $fechaVencimiento->isToday() || ($fechaVencimiento->isFuture() && $fechaVencimiento->diffInDays($fechaActual) <= 3) || ($fechaVencimiento->isPast() && $fechaVencimiento->diffInDays($fechaActual) <= 10);
        });
        $pagos = $pagos->groupBy('cliente_id')->map(function ($pagosCliente) {
            return $pagosCliente->sortByDesc('created_at')->first();
        });

   

        Log::info('Pagos a enviar recordatorios:', ['pagos' => $pagos]);

        if ($pagos->isEmpty()) {
            $this->info('No hay pagos que necesiten recordatorios.');
            return;
        }

        foreach ($pagos as $pago) {

            $nombresApellidos = $pago->cliente->nombres_apellidos ?? 'Cliente no encontrado';
            $fechaVencimiento = Carbon::parse($pago->fecha_fin)->format('d/m/Y');
            $fechaInicio = Carbon::parse($pago->fecha_inicio);
            $fechaFin = Carbon::parse($pago->fecha_fin)->startOfDay();
            $fechaActual = Carbon::now()->startOfDay();
            $diasVencidos = $fechaFin->diffInDays($fechaActual);
            Log::info('Procesando pago', [
                'cliente' => $nombresApellidos,
                'pago_id' => $pago->id,
                'fecha_inicio' => $fechaInicio->format('d/m/Y'),
                'fecha_fin' => $fechaFin->format('d/m/Y'),
                'dias_vencidos' => $diasVencidos,
            ]);

            try {
                if ($fechaActual->gt($fechaFin)) {
                    $diasVencidos = $fechaFin->diffInDays($fechaActual);
                    $mensaje = "Ya han pasado $diasVencidos días desde que venció tu pago el {$fechaFin->format('d/m/Y')}.";
                } elseif ($fechaActual->lt($fechaFin) && $fechaActual->diffInDays($fechaFin) <= 5) {
                    $mensaje = "Te recordamos que tu pago vence el {$fechaFin->format('d/m/Y')}";
                } else {
                    $mensaje = "Te recordamos que tu pago vence el {$fechaFin->format('d/m/Y')}.";
                }
                Log::info($mensaje);

                Mail::send('emails.recordatorio_pago', [
                    'nombresApellidos' => $nombresApellidos,
                    'fechaVencimiento' => $fechaVencimiento,
                    'mensaje' => $mensaje,
                ], function ($message) use ($pago) {
                    $message->to($pago->cliente->email)
                        ->subject('Recordatorio de Vencimiento de Plan');
                });

                $numeroTelefono = $this->formatearTelefono($pago->cliente->telefono);

                if ($numeroTelefono) {
                    $mensajeWhatsApp = "Hola $nombresApellidos, $mensaje";

                    $response = Http::withToken(env('WHATSAPP_ACCESS_TOKEN'))
                        ->post(env('WHATSAPP_API_URL'), [
                            'messaging_product' => 'whatsapp',
                            'to' => $numeroTelefono,
                            'type' => 'template',
                            'template' => [
                                'name' => 'event',
                                'language' => [
                                    'code' => 'en_US',
                                ],
                                'components' => [
                                    [
                                        'type' => 'body',
                                        'parameters' => [
                                            ['type' => 'text', 'text' => $nombresApellidos],
                                            ['type' => 'text', 'text' => $fechaVencimiento],
                                        ],
                                    ],
                                ],
                            ],
                        ]);


                    if ($response->successful()) {
                        $this->info('Mensaje de WhatsApp enviado correctamente a ' . $nombresApellidos);
                        Log::info('Mensaje de WhatsApp enviado correctamente', ['telefono' => $numeroTelefono]);
                        Log::info($response->json());
                    } else {
                        Log::error('Error al enviar WhatsApp a ' . $nombresApellidos . ': ' . $response->body());
                    }
                } else {
                    Log::error('Número de teléfono no válido para ' . $nombresApellidos);
                }


            } catch (\Exception $e) {
                Log::error('Error al enviar correo o WhatsApp a ' . $nombresApellidos . ' (' . $pago->cliente->email . '): ' . $e->getMessage(), [
                    'cliente' => $nombresApellidos,
                    'email' => $pago->cliente->email,
                    'error' => $e->getMessage()
                ]);
            }
        }

        $this->info('Recordatorios enviados a ' . $pagos->count() . ' clientes.');
    }

    private function formatearTelefono($telefono)
    {
        $codigoPais = '+57';

        $telefono = preg_replace('/\D/', '', $telefono);

        if (strlen($telefono) === 10) {
            return $codigoPais . $telefono;
        }

        Log::error('Número de teléfono no válido: ' . $telefono);
        return null;
    }
}
