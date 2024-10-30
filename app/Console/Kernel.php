<?php

namespace App\Console;

use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Console\Scheduling\Schedule;
use App\Models\Cliente;
use App\Mail\RecordatorioPago;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            $clientes = Cliente::where('fecha_proximo_plan', '<=', Carbon::now()->addDays(7))->get();

            foreach ($clientes as $cliente) {
                Mail::to($cliente->email)->send(new RecordatorioPago($cliente));
            }
        })->daily(); // Cambia la frecuencia según sea necesario
    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
    }
}
