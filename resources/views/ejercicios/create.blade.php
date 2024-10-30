@extends('adminlte::page')

@section('title', 'Registrar Ejercicio')

@section('content_header')
    <h1>Registrar Ejercicio</h1>
@stop

@section('content')
    @php
        date_default_timezone_set('Europe/Madrid');
    @endphp
    <div class="card">
        <div class="card-header">
            Formulario de Ejercicio
        </div>
        <div class="card-body">
            <div class="container_visita py-5">
                <form action="{{ route('ejercicio.store_ejercicio') }}" method="post">
                    @csrf

                    <div class="form-group">
                        <label for="nombre">Nombre:</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>
                  
                    <div class="form-group">
                        <label for="descripcion">Descripción:</label>
                        <textarea class="form-control" id="descripcion" name="descripcion"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="grupo_muscular">Grupo Muscular:</label>
                        <select class="form-control" id="grupo_muscular" name="grupo_muscular" required>
                            <option value="" selected disabled>Seleccione</option>
                            <option value="Pecho">Pecho</option>
                            <option value="Espalda">Espalda</option>
                            <option value="Piernas">Piernas</option>
                            <option value="Bíceps">Bíceps</option>
                            <option value="Tríceps">Tríceps</option>
                            <option value="Hombros">Hombros</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success">Guardar</button>
                    <a href="{{ route('ejercicio.index_ejercicio') }}" class="btn btn-primary">Volver</a>
                </form>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet"
        href="{{ Config::get('app.env') == 'local' ? asset('css/otazu_styles.css') : secure_asset('css/otazu_styles.css') }}">
@stop
