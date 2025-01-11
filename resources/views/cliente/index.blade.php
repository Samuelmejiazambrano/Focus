@extends('adminlte::page')

@section('title', 'Clientes')

@section('content_header')
    <h1>Listado de Clientes</h1>
@stop

@section('css')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css">

    <link href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
        integrity="sha384-s5vD7lwB0nHDuVweBBjKvFZyCVik4kW+OzWn1lI9Qq2ULjoRrAExE/xq7zWCGzF/" crossorigin="anonymous">
    <style>
        .pago {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .search-input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        th input {
            width: 90px;
            min-width: 80px;
            max-width: 120px;
        }

        .search-input:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
            outline: none;
        }
    </style>
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
                            <th class="text-center">Horario</th>
                            <th class="text-center">Estado</th>
                            <th class="text-center">Plan</th>
                            <th class="text-center">Fecha Fin</th>
                            <th class="text-center">Editar</th>
                            <th class="text-center">Pago</th>
                        </tr>
                        <tr>

                            <th></th>
                            <th></th>
                            <th><input type="text" placeholder="Filtrar por Nombre"></th>
                            <th><input type="text" placeholder="Filtrar por Email"></th>
                            <th><input type="text" placeholder="Filtrar por Teléfono"></th>
                            <th><input type="text" placeholder="Filtrar por Horario"></th>
                            <th></th>
                            <th><input type="text" placeholder="Filtrar por Plan"></th>
                            <th><input type="text" placeholder="Filtrar por Fecha Fin"></th>
                            <th></th>
                            <th></th>
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
                                @if ($clientes->pagos->isNotEmpty())
                                    <td class="text-center">
                                        {{ $clientes->pagos->last()->fecha_fin }}
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

                                <td class="text-center">
                                    <a class="btn" style="background-color: red" data-bs-toggle="modal"
                                        data-bs-target="#pagoModal{{ $clientes->id }}">
                                        <i class="bi bi-cash-stack"></i>
                                    </a>

                                    <div class="modal fade" id="pagoModal{{ $clientes->id }}" tabindex="-1"
                                        aria-labelledby="modalLabel{{ $clientes->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header pago">
                                                    <h3 class="modal-title " id="modalLabel{{ $clientes->id }}">Registro de
                                                        Pagos para {{ $clientes->nombres_apellidos }}</h3>

                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        @foreach ($clientes->pagos->sortByDesc('created_at') as $pago)
                                                            <div class="col-md-4 mb-3">
                                                                <div class="card">
                                                                    <div class="card-body">
                                                                        <h5 class="card-text ">
                                                                            <strong>Pago</strong>
                                                                        </h5>
                                                                        <p class="card-text">
                                                                            <strong>Plan:</strong>{{ $pago->plan->nombre ?? 'NA' }}
                                                                        </p>
                                                                        <p class="card-text">
                                                                            <strong>Precio:</strong>{{ $pago->plan->precio ?? 'NA' }}
                                                                        </p>
                                                                        <p class="card-text"><strong>Fecha Inicio:</strong>
                                                                            {{ $pago->fecha_inicio }}</p>
                                                                        <p class="card-text"><strong>Fecha Fin:</strong>
                                                                            {{ $pago->fecha_fin }}</p>
                                                                        <p class="card-text"><strong>Método de
                                                                                Pago:</strong> {{ $pago->metodo_pago }}</p>
                                                                        <p class="card-text"><strong>Comprobante:</strong>
                                                                            {{ $pago->comprobante_pago ?? 'NA' }}</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>

                                                    <hr>

                                                    <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                                        data-bs-target="#addPagoModal{{ $clientes->id }}">
                                                        Agregar Pago
                                                    </button>
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Cerrar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal fade" id="addPagoModal{{ $clientes->id }}" tabindex="-1"
                                        aria-labelledby="addPagoModalLabel{{ $clientes->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="addPagoModalLabel{{ $clientes->id }}">
                                                        Registrar Pago para {{ $clientes->nombres_apellidos }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form
                                                        action="{{ route('pago.store_pago', ['id_cliente' => $clientes->id]) }}"
                                                        method="POST" id="pagoForm{{ $clientes->id }}">
                                                        @csrf
                                                        <input type="hidden" name="id_cliente"
                                                            value="{{ $clientes->id }}">

                                                        <div class="modal-body">
                                                            <form
                                                                action="{{ route('pago.store_pago', ['id_cliente' => $clientes->id]) }}"
                                                                method="POST" id="pagoForm{{ $clientes->id }}">
                                                                @csrf
                                                                <input type="hidden" name="id_cliente"
                                                                    value="{{ $clientes->id }}">

                                                                <div class="mb-3">
                                                                    <label for="id_plan{{ $clientes->id }}"
                                                                        class="form-label">Plan</label>
                                                                    <select name="id_plan" class="form-control"
                                                                        id="id_plan{{ $clientes->id }}" required>
                                                                        <option value="">Seleccione Plan</option>
                                                                        @foreach ($plan as $planes)
                                                                            <option value="{{ $planes->id }}"
                                                                                data-precio="{{ $planes->precio }}">
                                                                                {{ $planes->nombre }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="precio{{ $clientes->id }}"
                                                                        class="form-label">Precio</label>
                                                                    <input type="text" name="precio"
                                                                        class="form-control"
                                                                        id="precio{{ $clientes->id }}">
                                                                </div>



                                                                <div class="mb-3">
                                                                    <label for="fecha_inicio{{ $clientes->id }}"
                                                                        class="form-label">Fecha de Inicio</label>
                                                                    <input type="date" name="fecha_inicio"
                                                                        class="form-control"
                                                                        id="fecha_inicio{{ $clientes->id }}" required>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="fecha_fin{{ $clientes->id }}"
                                                                        class="form-label">Fecha de Fin</label>
                                                                    <input type="date" name="fecha_fin"
                                                                        class="form-control"
                                                                        id="fecha_fin{{ $clientes->id }}" required>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="metodo_pago{{ $clientes->id }}"
                                                                        class="form-label">Método de Pago</label>
                                                                    <select name="metodo_pago" class="form-control"
                                                                        id="metodo_pago{{ $clientes->id }}" required>
                                                                        <option value="efectivo">Efectivo</option>
                                                                        <option value="tarjeta">Tarjeta</option>
                                                                        <option value="transferencia">Transferencia
                                                                            Bancaria
                                                                        </option>
                                                                        <option value="paypal">PayPal</option>
                                                                    </select>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="comprobante_pago{{ $clientes->id }}"
                                                                        class="form-label">Comprobante de Pago
                                                                        (Opcional)</label>
                                                                    <input type="text" name="comprobante_pago"
                                                                        class="form-control"
                                                                        id="comprobante_pago{{ $clientes->id }}">
                                                                </div>

                                                                <button type="submit" class="btn btn-success">Guardar
                                                                    Pago</button>
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Cerrar</button>
                                                            </form>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
            </div>
            </td>

            </tr>
            @endforeach
            </tbody>
            <tfoot>
            </tfoot>
            </table>
        </div>
    </div>
    </div>
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
            const table = $('#cliente_table').DataTable({
                "language": {
                    "lengthMenu": "Mostrar _MENU_ registros por página",
                    "zeroRecords": "Nada Encontrado - disculpa",
                    "info": "Mostrando la página _PAGE_ de _PAGES_",
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

            const searchColumns = [2, 3, 4, 5, 7, 8];

            $('#cliente_table thead tr:eq(1) th').each(function(i) {
                if (searchColumns.includes(i)) {
                    $(this).html(
                        '<input type="text" class="search-input" placeholder="Buscar en esta columna" />'
                    );
                    $('input', this).on('keyup change', function() {
                        table.column(i).search(this.value).draw();
                    });
                } else {
                    $(this).html('');
                }
            });

            $('#cliente_table tfoot th').each(function() {
                const title = $('#cliente_table thead th').eq($(this).index()).text();
                $(this).html('<input type="text" placeholder="Buscar ' + title + '" />');
            });

            $('#cliente_table tfoot input').on('keyup change', function() {
                table
                    .column($(this).parent().index() + ':visible')
                    .search(this.value)
                    .draw();
            });
        });




        function calcularIMC(clienteId) {
            const peso = parseFloat(document.getElementById(`peso${clienteId}`).value);
            const altura = parseFloat(document.getElementById(`altura${clienteId}`).value) /
                100;
            if (peso && altura) {
                const imc = (peso / (altura * altura)).toFixed(2);
                document.getElementById(`imc${clienteId}`).value = imc;
            } else {
                alert('Por favor, ingrese el peso y la altura.');
            }
        }
        document.addEventListener("DOMContentLoaded", function() {
            const selectPlanes = document.querySelectorAll("select[id^='id_plan']");

            selectPlanes.forEach(selectPlan => {
                selectPlan.addEventListener("change", function() {
                    const selectedOption = selectPlan.options[selectPlan.selectedIndex];
                    const precio = selectedOption.getAttribute("data-precio");
                    const clienteId = selectPlan.id.replace('id_plan', '');
                    const precioInput = document.getElementById(`precio${clienteId}`);

                    if (precioInput) {
                        precioInput.value = precio ? precio : "NA";
                    }
                });
            });
        });
    </script>

@stop
