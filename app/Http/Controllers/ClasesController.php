<?php

namespace App\Http\Controllers;
use App\Models\Clases;
use App\Models\Usuario;
use App\Models\Ejercicio;
use App\Models\EjerciciosClases;
use App\Models\Horario;
use App\Models\Categoria;






use Yajra\DataTables\Facades\DataTables;

use Illuminate\Http\Request;

class ClasesController extends Controller
{
    public function index(Request $request)
    {
        $clases = Clases::with('usuario','horario')->get();          
        if ($request->ajax()) {
            return DataTables::of($clases)
                ->make(true);
        }
        return view('clases.index', compact('clases'));
    }
public function create()
    {
        $Clases = new Clases();

        $instructors = Usuario::all();
        $ejercicio = Ejercicio::with('categoria')->get();
        $horario = Horario::all();
        $categoria = Categoria::all();

    //    dd($ejercicio);

        return view('clases.create', [
            'Clases' => $Clases,
            'instructors' => $instructors,
            'ejercicio' => $ejercicio,
            'horario' => $horario,
            'categoria' => $categoria
        ]);
    }


    
    public function store(Request $request)
    {
        $horariosSeleccionados = $request->input('horarios');
        $dynamicEjerciciosJson = $request->input('dynamic_ejercicios');
        
        $dynamicEjercicios = json_decode($dynamicEjerciciosJson, true);
    
        if (json_last_error() !== JSON_ERROR_NONE) {
            return redirect()->back()->withErrors(['dynamic_ejercicios' => 'Error en la decodificación JSON']);
        }
        
        foreach ($horariosSeleccionados as $horario) {
            $clase = new Clases();
            $clase->instructor_id = $request->input('instructor_id');
            $clase->fecha_de_clase = $request->input('fecha_de_clase');
            $clase->horario_id = $horario;
            $clase->descripcion = $request->input('descripcion') ?? '';
            $clase->save();
    
            foreach ($dynamicEjercicios as $category) {
                $categoria = $category['categoria'];
                $ejercicios = $category['ejercicios'];
    
                foreach ($ejercicios as $ejercicio) {
                    preg_match('/^(.*?) \((\d+)\)$/', $ejercicio, $matches);
                    if (count($matches) === 3) {
                        $nombreEjercicio = $matches[1];
                        $repeticiones = $matches[2];
                        $ejercicioRecord = Ejercicio::where('nombre', $nombreEjercicio)->first();
    
                        if ($ejercicioRecord) {
                            $claseEjercicio = new EjerciciosClases();
                            $claseEjercicio->clase_id = $clase->id;
                            $claseEjercicio->ejercicio_id = $ejercicioRecord->id;
                            $claseEjercicio->tipo_de_entrenamiento = $categoria; 
                            $claseEjercicio->repeticiones = $repeticiones;
                            $claseEjercicio->save();
                        } else {
                            Log::warning('Ejercicio no encontrado: ' . $nombreEjercicio);
                        }
                    } else {
                        Log::error('Formato de ejercicio inesperado: ' . $ejercicio);
                    }
                }
            }
        }
    
        return redirect()->route('clases.index_clases')->with('success', 'Clase registrada correctamente.');
    }
    
    

    }
    
    

