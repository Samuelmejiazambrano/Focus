@extends('adminlte::page')

@section('title', 'Registrar Resultado de Clase')

@section('content_header')
    <h1>Registrar Resultado de Clase</h1>
@stop

@section('content')
    @php
        date_default_timezone_set('Europe/Madrid');
    @endphp
    <div class="card">
        <div class="card-header">
            Formulario de Resultado de Clase
        </div>
        <div class="card-body">
            <div class="container_visita py-5">
                <form action="{{ route('resultado.store_resultado_clases') }}" method="post">
                    @csrf

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="clase_id">Clase:</label>
                            <select class="form-control" id="clase_id" name="clase_id" required>
                                <option value="" selected disabled>Seleccione una Clase</option>
                                @foreach($clases as $clase)
                                    <option value="{{ $clase->id }}">{{ $clase->descripcion }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="cliente_id">Cliente:</label>
                            <select class="form-control" id="cliente_id" name="cliente_id" required>
                                <option value="" selected disabled>Seleccione un Cliente</option>
                                @foreach($cliente as $clientes)
                                    <option value="{{ $clientes->id }}">{{ $clientes->nombres_apellidos }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="ejercicio_id">Ejercicio:</label>
                            <select class="form-control" id="ejercicio_id" name="ejercicio_id" required>
                                <option value="" selected disabled>Seleccione un Ejercicio</option>
                                @foreach($ejercicio as $ejercicios)
                                    <option value="{{ $ejercicios->id }}">{{ $ejercicios->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="repeticiones">Repeticiones:</label>
                            <input type="number" class="form-control" id="repeticiones" name="repeticiones" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="series">Series:</label>
                            <input type="number" class="form-control" id="series" name="series" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="peso">Peso:</label>
                            <input type="number" step="0.01" class="form-control" id="peso" name="peso" required>
                        </div>
                    </div>

                    <div class="form-group mt-3">
                        <button type="submit" class="btn btn-success">Guardar</button>
                        <a href="" class="btn btn-primary">Volver</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('css')
@stop
