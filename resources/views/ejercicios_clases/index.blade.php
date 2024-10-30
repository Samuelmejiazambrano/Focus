@extends('adminlte::page')

@section('title', 'Ejercicios')

@section('content_header')
    <h1>Listado de Ejercicios en clase</h1>
@stop

@section('content')
    <div class="container_mantenimiento mt-5">
    
        <div class="card">
            <div class="card-header">
                Listado de Ejercicios
            </div>
            <div class="card-body">
                <br>
                <table id="ejercicio_table" class="table table-striped table-sm" style="width:100%">
                    <thead>
                        <tr>
                            <th class="text-center">ID</th>
                            <th class="text-center">Categoría</th>
                            <th class="text-center">Clase</th>
                            <th class="text-center">Ejercicio Muscular</th>
                            <th class="text-center">Repeticiones</th>
                            

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ejercicios as $ejercicio)
                            <tr>
                                <td class="text-center">{{ $ejercicio->id }}</td>
                                <td class="text-center">{{ $ejercicio->tipo_de_entrenamiento }}</td>
                                <td class="text-center">{{ $ejercicio->clase->id}}</td>
                                <td class="text-center">{{ $ejercicio->ejercicio->nombre }}</td>
                                <td class="text-center">{{ $ejercicio->repeticiones }}</td>

                             
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-s5vD7lwB0nHDuVweBBjKvFZyCVik4kW+OzWn1lI9Qq2ULjoRrAExE/xq7zWCGzF/" crossorigin="anonymous">
@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap4.min.js"></script>
    
    <script>
        $(document).ready(function() {
            $('#ejercicio_table').DataTable({
                "language": {
                    "lengthMenu": "Mostrar _MENU_ registros por página",
                    "zeroRecords": "Nada Encontrado - disculpa",
                    "info": "Mostrando la página _PAGE_ de _PAGES_ ",
                    "infoEmpty": "No hay registros",
                    "infoFiltered": "(filtrado de _MAX_ registros totales)",
                    "search": "Buscar:",
                    "paginate": {
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                },
                "responsive": true,
                "searching": true,
                "pageLength": 25,
                "order": [],
                "columnDefs": [{
                    "targets": 'no-sort',
                    "orderable": false
                }]
            });
        });
    </script>
@stop
