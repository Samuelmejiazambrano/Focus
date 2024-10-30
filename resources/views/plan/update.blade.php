@extends('adminlte::page')

@section('title', 'Editar Plan')

@section('content_header')
    <h1>Editar Plan</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            Editar Plan
        </div>
        <div class="card-body">
            <form action="{{ route('plan.update_plan', ["plan"=>$plan]) }}" method="POST"> 
                @csrf
                @method('PUT')
            
                <div class="row justify-content-center"> 
                    <div class="form-group col-md-3">  
                        <label for="nombre">Nombre del Plan:</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre', $plan->nombre) }}" required>
                    </div>
            
                    <div class="form-group col-md-3">  
                        <label for="precio">Precio:</label>
                        <input type="number" class="form-control" id="precio" name="precio" step="0.01" value="{{ old('precio', $plan->precio) }}" required>
                    </div>
            
                    <div class="form-group col-md-3">  
                        <label for="duracion_dias">Duración (días):</label>
                        <input type="number" class="form-control" id="duracion_dias" name="duracion_dias" value="{{ old('duracion_dias', $plan->duracion_dias) }}" required>
                    </div>
                </div>
            
                <div class="row justify-content-center mt-3">
                    <button type="submit" class="btn btn-success mx-2">Guardar</button>
                    <a href="{{ route('plan.index_plan') }}" class="btn btn-primary mx-2">Volver</a>
                </div>
            </form>
            
        </div>
    </div>
@stop
