@extends('adminlte::page')

@section('title', 'Clases')

@section('content_header')
    <h1>Listado de Clases</h1>
@stop

@section('content')
    <div class="container_mantenimiento mt-5">
        <div class="row">
            <div class="col-sm-12">
                <a href="{{ route('clases.create_clases') }}" class="btn btn-success mb-2 float-right">
                    <i class="fas fa-plus"></i> Nuevo Registro
                </a>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                Listado de Clases
            </div>
            <div class="card-body">
                <br>
                <table id="clases_table" class="table table-striped table-sm" style="width:100%">
                    <thead>
                        <tr>
                            <th class="text-center">ID</th>
                            <th class="text-center">Descripción</th>
                            <th class="text-center">Instructor</th>
                            <th class="text-center">Horario</th>
                            <th class="text-center">Ejercicios en Clases</th>
                            <th class="text-center">Editar</th>
                            <th class="text-center">Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($clases as $clase)
                            <tr>
                                <td class="text-center">{{ $clase->id }}</td>
                                <td class="text-center">{{ $clase->descripcion }}</td>
                                <td class="text-center">{{ $clase->usuario->name }}</td>
                                <td class="text-center">{{ $clase->horario->horario }}</td>
                                <td class="text-center">
                                    <a href="{{ route('clases.index_ejercicios_clases', ['clase_id' => $clase->id]) }}" class="btn btn-secondary mb-2">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                                
                                
                                
                                <td class="text-center">
                                    <a class="btn btn-warning" href="">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </td>

                                <td class="text-center">
                                    <form action="" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>

                                </td>

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
        integrity="sha384-s5vD7lwB0nHDuVweBBjKvFZyCVik4kW+OzWn1lI9Qq2ULjoRrAExE/xq7zWCGzF/" crossorigin="anonymous">
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
            $('#clases_table').DataTable({
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
