<?php

namespace App\Http\Controllers;
use App\Models\EjerciciosClases;
use App\Models\Ejercicio;
use App\Models\Clases;
use App\Models\Usuario;
use App\Models\Horario;
use App\Models\Categoria;


use Yajra\DataTables\Facades\DataTables;

use Illuminate\Http\Request;

class EjerciciosClasesController extends Controller
{
    public function index(Request $request)
    {
        $ejercicios = EjerciciosClases::with('clase','ejercicio')
        ->where('clase_id', $request->clase_id)
        ->get();
       


        
        if ($request->ajax()) {
            return DataTables::of($ejercicios)
                ->make(true);
        }
        return view('ejercicios_clases.index', [
            
            'ejercicios' => $ejercicios,
          
        ]);
    }
    
    public function create()
    {
        $ejercicio = Ejercicio::all(); // Obtener todos los ejercicios
        $clases = Clases::all(); // Obtener todas las clases
        $ejercicios = new EjerciciosClases(); // Crear una instancia vacía de EjerciciosClases

        return view('ejercicios_clases.create', [
            'ejercicios' => $ejercicios, // Pasar la instancia vacía a la vista
            'ejercicio' => $ejercicio, // Pasar todos los ejercicios a la vista
            'clases' => $clases // Pasar todas las clases a la vista
        ]);
    }
    public function store(Request $request)
    {
        $ejercicio = new EjerciciosClases();
        $ejercicio->clase_id = $request->input('clase_id');
        $ejercicio->ejercicio_id = $request->input('ejercicio_id');
        $ejercicio->tipo_de_entrenamiento = $request->input('tipo_de_entrenamiento');
        
        $ejercicio->save();

        return redirect()->route('clases.index_ejercicios_clases')
            ->with('success', 'Ejercicio registrado exitosamente.');
    }
}
