<?php

namespace App\Http\Controllers;
use App\Models\Ejercicio;
use App\Models\Categoria;

use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;

class EjercicioController extends Controller
{
    public function index(Request $request)
    {
        $ejercicio = Ejercicio::all();

        if ($request->ajax()) {
            return DataTables::of($ejercicio)
                ->make(true);
        }


        return view('ejercicios.index', [
            'ejercicio' => $ejercicio,
        ]);
    }
    public function create()
    {
        $categoria = Categoria::all();

        $ejercicios = new Ejercicio();
        return view('ejercicios/create', [
            'ejercicios' => $ejercicios,
            'categoria' => $categoria

        ]);
    }
    public function store(Request $request)
    {

        $ejercicio = new Ejercicio();
        $ejercicio->nombre = $request->input('nombre');
        $ejercicio->descripcion = $request->input('descripcion');
        $ejercicio->grupo_muscular = $request->input('grupo_muscular');

        $ejercicio->save();

        return redirect()->route('ejercicio.index_ejercicio')
            ->with('success', 'Ejercicio registrado exitosamente.');
    }

}
