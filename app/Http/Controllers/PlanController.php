<?php

namespace App\Http\Controllers;
use App\Models\Plan;


use Illuminate\Http\Request;

class PlanController extends Controller
{

    public function index(Request $request)
    {
        $plan = Plan::all();

        return view('plan.index', [
            
            'plan' => $plan,
          
        ]);
    }
    
    public function createPlan()
    {
        return view('plan.create');
    }
 
    public function edit(Request $request)
    {
        $plan = Plan::find((int) $request->plan);
        return view('plan.update', [
            'plan' => $plan

        ]);
    }
    
    public function update(Request $request)
    {

        $plan = Plan::find((int) $request->plan);

        $plan->nombre = $request->input('nombre');
        $plan->precio = $request->input('precio');
        $plan->duracion_dias = $request->input('duracion_dias');
        $plan->save();
       
        return redirect()->route('plan.index_plan')->with('success', 'Plan actualizado exitosamente');
    }
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'precio' => 'required|numeric|min:0',
            'duracion_dias' => 'required|integer|min:1',
        ]);

        $plan = new Plan();
        $plan->nombre = $request->input('nombre');
        $plan->precio = $request->input('precio');
        $plan->duracion_dias = $request->input('duracion_dias');
        
        $plan->save();

        return redirect()->route('plan.index_plan')->with('success', 'Plan registrado con éxito.');
    }
}
