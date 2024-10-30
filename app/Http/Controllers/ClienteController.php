<?php

namespace App\Http\Controllers;
use App\Models\Cliente;
use App\Models\Horario;
use App\Models\Plan;
use App\Models\Seguimiento;
use App\Models\Pago;

use App\Mail\RecordatorioPago;
use Illuminate\Support\Facades\Mail;

use Yajra\DataTables\Facades\DataTables;


use Illuminate\Http\Request;



class ClienteController extends Controller
{

    public function index(Request $request)
    {
        $cliente = Cliente::with('horarios')->get();
        $plan = Plan::all();
        $pago = Pago::with('plan')->get();

        if ($request->ajax()) {
            return DataTables::of($cliente)
                ->make(true);
        }
        return view('cliente.index', compact('cliente','plan','pago'));
    }
    public function create()
    {
        $Cliente = new Cliente();
        $horario = Horario::all();
        $plan = Plan::all();

        return view('cliente/create', [
            'departmento' => $Cliente,
            'horario' => $horario,
            'plan' => $plan
        ]);
    }
    public function store(Request $request)
    {

        $cliente = new Cliente();
        $cliente->nombres_apellidos = $request->input('nombres_apellidos');
        $cliente->email = $request->input('email');
        $cliente->tipo_documento = $request->input('tipo_documento');
        $cliente->documento = $request->input('documento');
        $cliente->telefono = $request->input('telefono');
        $cliente->direccion = $request->input('direccion');
        $cliente->horario = $request->input('horario');
        $cliente->fecha_nacimiento = $request->input('fecha_nacimiento');
        // $cliente->fecha_inicio = $request->input('fecha_inicio');

        // $cliente->plan = $request->input('plan');

        $cliente->save();

        return redirect()->route('cliente.index_cliente')->with('success', 'Cliente registrado exitosamente.');
    }
    public function storeSeguimiento(Request $request)
    {
        // dd($request);
        $cliente = Cliente::find($request->id);

        if (!$cliente) {
            return redirect()->route('cliente.index_cliente')->with('error', 'Cliente no encontrado.');
        }

        $seguimiento = new Seguimiento([
            'peso' => $request->input('peso'),
            'altura' => $request->input('altura'),
            'imc' => $request->input('imc'),
            'cliente_id' => $cliente->id,
        ]);

        $seguimiento->save();

        return redirect()->route('cliente.index_cliente')->with('success', 'Seguimiento registrado exitosamente.');
    }
    public function enviarRecordatorioPago($clienteId)
    {
        $cliente = Cliente::find($clienteId);

        if ($cliente) {
            Mail::to($cliente->email)->send(new RecordatorioPago($cliente));
        }
    }
    
    public function edit(Request $request)
    {
        $Cliente = new Cliente();
        $horario = Horario::all();
        $plan = Plan::all();
        $cliente = Cliente::find((int) $request->clientes);
        return view('cliente.update', [
            'cliente' => $cliente,
            'horario' => $horario,
            'plan' => $plan

        ]);
    }
    
    public function update(Request $request)
    {

        $cliente = Cliente::find((int) $request->cliente);
    
        $cliente->nombres_apellidos = $request->input('nombres_apellidos');
        $cliente->email = $request->input('email');
        $cliente->tipo_documento = $request->input('tipo_documento');
        $cliente->documento = $request->input('documento');
        $cliente->telefono = $request->input('telefono');
        $cliente->direccion = $request->input('direccion');
        $cliente->horario = $request->input('horario');
        $cliente->fecha_nacimiento = $request->input('fecha_nacimiento');
        $cliente->estado = $request->input('estado');
        $cliente->save();

        return redirect()->route('cliente.index_cliente')->with('success', 'Plan actualizado exitosamente');
    }
    
    public function storePago(Request $request)
    {
        $request->validate([
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date',
            'id_cliente' => 'required|exists:cliente,id',
            'metodo_pago' => 'required|string',
            'id_plan' => 'required|exists:planes,id', 
        ]);

       
            $pago = new Pago();
            $pago->fecha_inicio = $request->input('fecha_inicio');
            $pago->fecha_fin = $request->input('fecha_fin');
            $pago->id_cliente = $request->input('id_cliente');
            $pago->metodo_pago = $request->input('metodo_pago');
            $pago->comprobante_pago = $request->input('comprobante_pago');
            $pago->id_plan = $request->input('id_plan');

            $pago->save();
//   dd($pago);
            return redirect()->back()->with('success', 'El pago ha sido registrado correctamente.');

        
    }
    
    
    

}
