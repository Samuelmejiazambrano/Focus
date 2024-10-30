<?php

namespace App\Http\Controllers;
use App\Models\ResultadosClase;
use App\Models\Clases;
use App\Models\Usuario;
use App\Models\Ejercicio;
use App\Models\Cliente;
use Yajra\DataTables\Facades\DataTables;

use Illuminate\Http\Request;

class ResultadosClasesController extends Controller
{
    public function index(Request $request)
    {
        $resultados = ResultadosClase::with('ejercicio','clase','cliente')->get();
          
        if ($request->ajax()) {
            return DataTables::of($resultados)
                ->make(true);
        }
        return view('resultado_clases.index', compact('resultados'));
    }
    public function create()
    {
        $clases = Clases::all();
        $ejercicio = Ejercicio::all();
        $cliente = Cliente::all();
        $resultado =new ResultadosClase();
        return view('resultado_clases.create', [
            'resultado' => $resultado,
            'clases' => $clases,
            'ejercicio' => $ejercicio,
            'cliente' => $cliente


        ]);
    }
    public function store(Request $request)
    {
       
    
        $resultadoClase = new ResultadosClase();
        $resultadoClase->clase_id = $request->input('clase_id');
        $resultadoClase->cliente_id = $request->input('cliente_id');
        $resultadoClase->ejercicio_id = $request->input('ejercicio_id');
        $resultadoClase->repeticiones = $request->input('repeticiones');
        $resultadoClase->series = $request->input('series');
        $resultadoClase->peso = $request->input('peso');
        
        $resultadoClase->save();
    
        return redirect()->route('resultado.index_resultado_clases')
            ->with('success', 'Resultado de clase registrado exitosamente.');
    }
    
}
