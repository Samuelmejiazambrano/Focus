@extends('adminlte::page')

@section('title', 'Registrar Cliente')

@section('content_header')
    <h1>Registrar Cliente</h1>
@stop

@section('content')
    @php
        date_default_timezone_set('Europe/Madrid');
    @endphp
    <div class="card">
        <div class="card-header">
            Formulario de Cliente
        </div>
        <div class="card-body">
            <div class="container_visita py-5">
                <form action="{{ route('cliente.store_cliente') }}" method="post">
                    @csrf

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="tipo_documento">Tipo de Documento:</label>
                            <select name="tipo_documento" id="tipo_documento" class="form-control" required>
                                <option value="" selected disabled>Seleccione</option>
                                <option value="Cedula de ciudadania">Cedula de ciudadania</option>
                                <option value="PPT">PPT</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="documento">Documento:</label>
                            <input type="text" class="form-control" id="documento" name="documento" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="nombres_apellidos">Nombres y Apellidos:</label>
                            <input type="text" class="form-control" id="nombres_apellidos" name="nombres_apellidos" required>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="telefono">Teléfono:</label>
                            <input type="text" class="form-control" id="telefono" name="telefono" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="direccion">Dirección:</label>
                            <input type="text" class="form-control" id="direccion" name="direccion" required>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="tipo_sangre">Tipo de Sangre:</label>
                            <input type="text" class="form-control" id="tipo_sangre" name="tipo_sangre" >
                        </div>
                        <div class="form-group col-md-4">
                            <label for="prestador_servicios_salud">Prestador de Servicios de Salud:</label>
                            <input type="text" class="form-control" id="prestador_servicios_salud" name="prestador_servicios_salud" >
                        </div>
                        <div class="form-group col-md-4">
                            <label for="alergico_medicamento_sustancia">¿Eres Alérgico?</label>
                            <select class="form-control" id="alergico_medicamento_sustancia" name="alergico_medicamento_sustancia" >
                                <option value="" selected disabled>Seleccione</option>
                                <option value="No">No</option>
                                <option value="Sí">Sí</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="observaciones">Observaciones:</label>
                            <input type="textarea" class="form-control" id="observaciones" style="height: 50px;" name="observaciones" >
                        </div>
                      
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
                            <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="horario">Horario:</label>
                            <select class="form-control" id="horario" name="horario" required>
                                <option value="" selected disabled>Seleccione una Horario</option>
                                @foreach ($horario as $horarios)
                                    <option value="{{ $horarios->id }}">{{ $horarios->horario }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-success">Guardar</button>
                    <a href="{{ route('cliente.index_cliente') }}" class="btn btn-primary">Volver</a>
                    
                </form>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet"
        href="{{ Config::get('app.env') == 'local' ? asset('css/otazu_styles.css') : secure_asset('css/otazu_styles.css') }}">
@stop
