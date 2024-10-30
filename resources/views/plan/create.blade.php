@extends('adminlte::page')

@section('title', 'Registrar Plan')

@section('content_header')
    <h1>Registrar Plan</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            Formulario de Registro de Plan
        </div>
        <div class="card-body">
            <form action="{{ route('plan.store_plan') }}" method="POST">
                @csrf

                <div class="row justify-content-center"> <!-- Centering the form inputs -->
                    <div class="form-group col-md-3">  <!-- Adjusted width -->
                        <label for="nombre">Nombre del Plan:</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>

                    <div class="form-group col-md-3">  <!-- Adjusted width -->
                        <label for="precio">Precio:</label>
                        <input type="number" class="form-control" id="precio" name="precio" step="0.01" required>
                    </div>

                    <div class="form-group col-md-3">  <!-- Adjusted width -->
                        <label for="duracion_dias">Duración (días):</label>
                        <input type="number" class="form-control" id="duracion_dias" name="duracion_dias" required>
                    </div>
                </div>

                <div class="row justify-content-center mt-3"> <!-- Added margin-top for spacing -->
                    <button type="submit" class="btn btn-success mx-2">Guardar</button>
                    {{-- <a href="{{ route('planes.index') }}" class="btn btn-primary mx-2">Volver</a> --}}
                </div>
            </form>
        </div>
    </div>
@stop
