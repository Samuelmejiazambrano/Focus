@extends('adminlte::page')

@section('title', 'Registrar Ejercicio de Clase')

@section('content_header')
    <h1>Registrar Ejercicio de Clase</h1>
@stop

@section('content')
    @php
        date_default_timezone_set('Europe/Madrid');
    @endphp
    <div class="card">
        <div class="card-header">
            Formulario de Ejercicio de Clase
        </div>
        <div class="card-body">
            <div class="container_visita py-5">
                <form action="{{ route('clases.store_ejercicios_clases') }}" method="post">
                    @csrf

                    <div class="form-group">
                        <label for="clase_id">Clase:</label>
                        <select class="form-control" id="clase_id" name="clase_id" required>
                            <option value="" selected disabled>Seleccione una Clase</option>
                            @foreach($clases as $clase)
                                <option value="{{ $clase->id }}">{{ $clase->descripcion }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="ejercicio_id">Ejercicio:</label>
                        <select class="form-control" id="ejercicio_id" name="ejercicio_id" required>
                            <option value="" selected disabled>Seleccione un Ejercicio</option>
                            @foreach($ejercicio as $ejercicios)
                                <option value="{{ $ejercicios->id }}">{{ $ejercicios->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="tipo_de_entrenamiento">Tipo de Entrenamiento:</label>
                        <select class="form-control" id="tipo_de_entrenamiento" name="tipo_de_entrenamiento" required>
                            <option value="" selected disabled>Seleccione</option>
                            <option value="Cardio">Cardio</option>
                            <option value="Fuerza">Fuerza</option>
                            <option value="Flexibilidad">Flexibilidad</option>
                            <option value="Resistencia">Resistencia</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success">Guardar</button>
                    <a href="{{ route('clases.index_ejercicios_clases') }}" class="btn btn-primary">Volver</a>
                </form>
            </div>
        </div>
    </div>
@stop

@section('css')
@stop
