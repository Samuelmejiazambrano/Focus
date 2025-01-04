<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\EjercicioController;
use App\Http\Controllers\ClasesController;
use App\Http\Controllers\EjerciciosClasesController;
use App\Http\Controllers\ResultadosClasesController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\PlanController;
use Illuminate\Support\Facades\Mail;





Route::get('/login', [AuthenticatedSessionController::class, 'create'])
    ->name('login');

Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
->name('logout');



Route::get('/welcome', function () {
    return view('welcome');
});
Route::get('/', function () {
    return view('auth.login');
});
Route::middleware(['auth'])->group(function () {



    Route::get('cliente/index-cliente', [ClienteController::class, 'index'])->name('cliente.index_cliente');
    Route::get('cliente/create-cliente', [ClienteController::class, 'create'])->name('cliente.create_cliente');
    Route::post('cliente/store-cliente', [ClienteController::class, 'store'])->name('cliente.store_cliente');
    Route::post('cliente/store-seguimiento', [ClienteController::class, 'storeSeguimiento'])->name('cliente.store_seguimiento');

    Route::get('ejercicio/index-ejercicio', [EjercicioController::class, 'index'])->name('ejercicio.index_ejercicio');
    Route::get('ejercicio/create-ejercicio', [EjercicioController::class, 'create'])->name('ejercicio.create_ejercicio');
    Route::post('ejercicio/store-ejercicio', [EjercicioController::class, 'store'])->name('ejercicio.store_ejercicio');

    Route::get('clases/index-clases', [ClasesController::class, 'index'])->name('clases.index_clases');
    Route::get('clases/create-clases', [ClasesController::class, 'create'])->name('clases.create_clases');
    Route::post('clases/store-clases', [ClasesController::class, 'store'])->name('clases.store_clases');


    Route::get('ejercicios_clases/index-ejercicios_clases', [EjerciciosClasesController::class, 'index'])->name('clases.index_ejercicios_clases');
    Route::get('ejercicios_clases/create-ejercicios_clases', [EjerciciosClasesController::class, 'create'])->name('clases.create_ejercicios_clases');
    Route::post('ejercicios_clases/store-ejercicios_clases', [EjerciciosClasesController::class, 'store'])->name('clases.store_ejercicios_clases');

    Route::get('resultado_clases/index-resultado_clases', [ResultadosClasesController::class, 'index'])->name('resultado.index_resultado_clases');
    Route::get('resultado_clases/create-resultado_clases', [ResultadosClasesController::class, 'create'])->name('resultado.create_resultado_clases');
    Route::post('resultado_clases/store-resultado_clases', [ResultadosClasesController::class, 'store'])->name('resultado.store_resultado_clases');

    Route::post('/clientes/{id}/recordatorio', [ClienteController::class, 'enviarRecordatorioPago'])
        ->name('clientes.recordatorio');
        
        Route::get('cliente/edit-cliente', [ClienteController::class, 'edit'])->name('cliente.edit_cliente');
        Route::put('cliente/update-cliente', [ClienteController::class, 'update'])->name('cliente.update_cliente');


        Route::get('plan/index-plan', [PlanController::class, 'index'])->name('plan.index_plan');
        Route::get('plan/edit-plan', [PlanController::class, 'edit'])->name('plan.edit_plan');
        Route::get('plan/create-plan', [PlanController::class, 'createPlan'])->name('plan.create_plan');
        Route::post('plan/store-plan', [PlanController::class, 'store'])->name('plan.store_plan');
        Route::post('pago/store-pago', [ClienteController::class, 'storePago'])->name('pago.store_pago');

        Route::put('plan/update-plan', [PlanController::class, 'update'])->name('plan.update_plan');

        Route::delete('/plan/{plan}', [PlanController::class, 'delete'])->name('plan.delete');

        
});