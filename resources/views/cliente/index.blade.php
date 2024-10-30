@extends('adminlte::page')

@section('title', 'Clientes')

@section('content_header')
    <h1>Listado de Cliente</h1>
@stop

@section('content')
    <div class="container_mantenimiento mt-5">
        <div class="row">
            <div class="col-sm-12">
                <a href="{{ route('cliente.create_cliente') }}" class="btn btn-success mb-2 float-right">
                    <i class="fas fa-plus"></i> Nuevo Registro
                </a>

            </div>
        </div>
        <div class="card">
            <div class="card-header">
                Listado de Clientes
            </div>
            <div class="card-body">
                <br>
                <table id="cliente_table" class="table table-striped table-sm" style="width:100%">
                    <thead>
                        <tr>
                            <th class="text-center">Tipo Documento</th>
                            <th class="text-center">Documento</th>
                            <th class="text-center">Nombre</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Teléfono</th>
                            <th class="text-center">Dirección</th>
                            <th class="text-center">Horario</th>
                            <th class="text-center">Estado</th>
                            <th class="text-center">Plan</th>
                            <th class="text-center">Editar</th>
                            {{-- <th class="text-center">Seguimiento</th> --}}
                            <th class="text-center">Pago</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cliente as $clientes)
                            <tr>
                                <td class="text-center">{{ $clientes->tipo_documento }}</td>
                                <td class="text-center">{{ $clientes->documento }}</td>
                                <td class="text-center">{{ $clientes->nombres_apellidos }}</td>
                                <td class="text-center">{{ $clientes->email }}</td>
                                <td class="text-center">{{ $clientes->telefono }}</td>
                                <td class="text-center">{{ $clientes->direccion }}</td>
                                <td class="text-center">{{ $clientes->horarios->horario }}</td>
                                <td class="text-center">
                                    {{ $clientes->estado == 1 ? 'Activo' : 'Inactivo' }}
                                </td>
                                @if ($clientes->pagos->isNotEmpty())
                                <td class="text-center">
                                    {{ $clientes->pagos->last()->plan->nombre ?? 'NA' }}
                                </td>
                            @else
                                <td class="text-center">NA</td>
                            @endif
                            

                                <td class="text-center">
                                    <a class="btn btn-warning"
                                        href="{{ route('cliente.edit_cliente', ['clientes' => $clientes]) }}">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </td>
                                {{-- <td class="text-center">
                                    <a class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#clienteModal{{ $clientes->id }}">
                                        <i class="bi bi-activity"></i>
                                    </a>

                                    <div class="modal fade" id="clienteModal{{ $clientes->id }}" tabindex="-1"
                                        aria-labelledby="modalLabel{{ $clientes->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalLabel{{ $clientes->id }}">Seguimiento
                                                        para Cliente {{ $clientes->nombres_apellidos }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form
                                                        action="{{ route('cliente.store_seguimiento', ['id' => $clientes->id]) }}"
                                                        method="POST" id="seguimientoForm{{ $clientes->id }}">

                                                        @csrf

                                                        <!-- Campo oculto para cliente_id -->
                                                        <input type="hidden" name="cliente_id"
                                                            value="{{ $clientes->id }}">

                                                        <div class="mb-3">
                                                            <label for="peso" class="form-label">Peso (kg)</label>
                                                            <input type="number" name="peso" class="form-control"
                                                                id="peso{{ $clientes->id }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="altura" class="form-label">Altura (cm)</label>
                                                            <input type="number" name="altura" class="form-control"
                                                                id="altura{{ $clientes->id }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="imc" class="form-label">IMC</label>
                                                            <input type="text" name="imc" class="form-control"
                                                                id="imc{{ $clientes->id }}" readonly>
                                                        </div>
                                                        <button type="button" class="btn btn-primary"
                                                            onclick="calcularIMC('{{ $clientes->id }}')">Calcular
                                                            IMC</button>
                                                        <button type="submit" class="btn btn-success">Guardar
                                                            Seguimiento</button>
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Cerrar</button>

                                                    </form>
                                                </div>


                                                </form>

                                            </div>
                                        </div>
                                    </div>

                                </td> --}}
                                <td class="text-center">
                                    <a class="btn" style="background-color: red" data-bs-toggle="modal" data-bs-target="#pagoModal{{ $clientes->id }}">
                                        <i class="bi bi-cash-stack"></i>
                                    </a>
                                
                                    <!-- Modal to Display Payment Records -->
                                    <div class="modal fade" id="pagoModal{{ $clientes->id }}" tabindex="-1" aria-labelledby="modalLabel{{ $clientes->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalLabel{{ $clientes->id }}">Registro de Pagos para {{ $clientes->nombres_apellidos }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- Display payment records as cards -->
                                                    <div class="row">
                                                        @foreach($clientes->pagos as $pago)
                                                            <div class="col-md-4 mb-3">
                                                                <div class="card">
                                                                    <div class="card-body">
                                                                        <p class="card-text"><strong>Plan:</strong>{{ $pago->plan->nombre ?? 'NA' }}</p>
                                                                        <p class="card-text"><strong>Fecha Inicio:</strong> {{ $pago->fecha_inicio }}</p>
                                                                        <p class="card-text"><strong>Fecha Fin:</strong> {{ $pago->fecha_fin }}</p>
                                                                        <p class="card-text"><strong>Método de Pago:</strong> {{ $pago->metodo_pago }}</p>
                                                                        <p class="card-text"><strong>Comprobante:</strong> {{ $pago->comprobante_pago ?? 'NA' }}</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                
                                                    <hr>
                                
                                                  <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addPagoModal{{ $clientes->id }}">
                                                        Agregar Pago
                                                    </button>
                                                    <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Cerrar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                
                                    <div class="modal fade" id="addPagoModal{{ $clientes->id }}" tabindex="-1" aria-labelledby="addPagoModalLabel{{ $clientes->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="addPagoModalLabel{{ $clientes->id }}">Registrar Pago para {{ $clientes->nombres_apellidos }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('pago.store_pago', ['id_cliente' => $clientes->id]) }}" method="POST" id="pagoForm{{ $clientes->id }}">
                                                        @csrf
                                                        <input type="hidden" name="id_cliente" value="{{ $clientes->id }}">
                                
                                                        <div class="mb-3">
                                                            <label for="id_plan{{ $clientes->id }}" class="form-label">Plan</label>
                                                            <select name="id_plan" class="form-control" id="id_plan{{ $clientes->id }}" required>
                                                                <option value=""></option>
                                                                @foreach($plan as $planes)
                                                                    <option value="{{ $planes->id }}">{{ $planes->nombre }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="fecha_inicio{{ $clientes->id }}" class="form-label">Fecha de Inicio</label>
                                                            <input type="date" name="fecha_inicio" class="form-control" id="fecha_inicio{{ $clientes->id }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="fecha_fin{{ $clientes->id }}" class="form-label">Fecha de Fin</label>
                                                            <input type="date" name="fecha_fin" class="form-control" id="fecha_fin{{ $clientes->id }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="metodo_pago{{ $clientes->id }}" class="form-label">Método de Pago</label>
                                                            <select name="metodo_pago" class="form-control" id="metodo_pago{{ $clientes->id }}" required>
                                                                <option value="efectivo">Efectivo</option>
                                                                <option value="tarjeta">Tarjeta</option>
                                                                <option value="transferencia">Transferencia Bancaria</option>
                                                                <option value="paypal">PayPal</option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="comprobante_pago{{ $clientes->id }}" class="form-label">Comprobante de Pago (Opcional)</label>
                                                            <input type="text" name="comprobante_pago" class="form-control" id="comprobante_pago{{ $clientes->id }}">
                                                        </div>
                                
                                                        <button type="submit" class="btn btn-success">Guardar Pago</button>
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css">

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
            $('#cliente_table').DataTable({
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

        function calcularIMC(clienteId) {
            const peso = parseFloat(document.getElementById(`peso${clienteId}`).value);
            const altura = parseFloat(document.getElementById(`altura${clienteId}`).value) /
            100; // Convertir altura a metros
            if (peso && altura) {
                const imc = (peso / (altura * altura)).toFixed(2);
                document.getElementById(`imc${clienteId}`).value = imc;
            } else {
                alert('Por favor, ingrese el peso y la altura.');
            }
        }
    </script>
@stop
