@extends('adminlte::page')

@section('title', 'Registrar Clases')

@section('content_header')
    <h1>Registrar Clases </h1>
@stop

@section('content')
    @php
        date_default_timezone_set('Europe/Madrid');
    @endphp
    <div class="card">
        <div class="card-header">
            Formulario de Clases
        </div>
        <div class="card-body">
            <div class="container_visita py-5">
                <form id="claseForm" action="{{ route('clases.store_clases') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <label for="instructor_id">Instructor:</label>
                            <select class="form-control" id="instructor_id" name="instructor_id" required>
                                <option value="" selected disabled>Seleccione un instructor</option>
                                @foreach ($instructors as $instructores)
                                    <option value="{{ $instructores->id }}">{{ $instructores->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="fecha">Fecha:</label>
                            <input type="date" class="form-control" name="fecha_de_clase" id="fecha_de_clase" required>
                        </div>
                    </div>

                    {{-- <div class="col-md-12">
                        <label class="d-flex flex-column align-items-center" for="horarios">Horarios:</label>
                    
                        <div class="row">
                            <!-- AM Horarios -->
                            <div class="col-md-6">
                                <h5>AM</h5>
                                <div class="row">
                                    @foreach ($horario as $horarios)
                                        @if (strpos($horarios->horario, 'AM') !== false)
                                            <div class="col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="horario{{ $horarios->id }}" name="horarios[]" value="{{ $horarios->id }}">
                                                    <label class="form-check-label" for="horario{{ $horarios->id }}">
                                                        {{ $horarios->horario }}
                                                    </label>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        
                            <!-- PM Horarios -->
                            <div class="col-md-12">
                                <h5>PM</h5>
                                <div class="row">
                                    @foreach ($horario as $horarios)
                                        @if (strpos($horarios->horario, 'PM') !== false)
                                            <div class="col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="horario{{ $horarios->id }}" name="horarios[]" value="{{ $horarios->id }}">
                                                    <label class="form-check-label" for="horario{{ $horarios->id }}">
                                                        {{ $horarios->horario }}
                                                    </label>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        
                    </div> --}}

                    <div class="row">
                        <!-- AM Horarios -->
                        <div class="col-md-6">
                            <h5 class="text-center">AM</h5>
                            <div class="row text-center">
                                @foreach ($horario as $horarios)
                                    @if (strpos($horarios->horario, 'AM') !== false)
                                        <div class="col-md-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"
                                                    id="horario{{ $horarios->id }}" name="horarios[]"
                                                    value="{{ $horarios->id }}">
                                                <label class="form-check-label" for="horario{{ $horarios->id }}">
                                                    {{ $horarios->horario }}
                                                </label>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>

                        <!-- PM Horarios -->
                        <div class="col-md-6">
                            <h5 class="text-center">PM</h5>
                            <div class="row text-center">
                                @foreach ($horario as $horarios)
                                    @if (strpos($horarios->horario, 'PM') !== false)
                                        <div class="col-md-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"
                                                    id="horario{{ $horarios->id }}" name="horarios[]"
                                                    value="{{ $horarios->id }}">
                                                <label class="form-check-label" for="horario{{ $horarios->id }}">
                                                    {{ $horarios->horario }}
                                                </label>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-12">
                            <label for="descripcion">Observaciones:</label>
                            <textarea class="form-control" id="descripcion" name="descripcion"></textarea>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <!-- Campos ocultos para ejercicios dinámicos -->
                            <input type="hidden" id="dynamicEjercicios" name="dynamic_ejercicios">

                            <div class="form-group mt-3">
                                <label for="categoria_id">Categoría:</label>
                                <select class="form-control" id="categoria_id" name="categoria_id">
                                    <option value="" selected disabled>Seleccione una Categoría</option>
                                    @foreach ($categoria as $categorias)
                                        <option value="{{ $categorias->id }}">
                                            {{ $categorias->categoria }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mt-3">
                                <label for="grupo_muscular">Grupo Muscular:</label>
                                <select class="form-control" id="grupo_muscular" name="grupo_muscular">
                                    <option value="" selected disabled>Seleccione un Grupo Muscular</option>
                                    @foreach ($ejercicio as $ejercicios)
                                        <option value="{{ $ejercicios->grupo_muscular }}">
                                            {{ $ejercicios->grupo_muscular }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="ejercicio_id">Ejercicio:</label>
                                <select class="form-control" id="ejercicio_id" name="ejercicio_id">
                                    <option value="" selected disabled>Seleccione un Ejercicio</option>
                                    @foreach ($ejercicio as $ejercicios)
                                        <option value="{{ $ejercicios->id }}">{{ $ejercicios->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <label for="repeticiones">Observaciones:</label>
                                    <textarea class="form-control" id="repeticiones" name="repeticiones"></textarea>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <h5>Ejercicios seleccionados:</h5>
                            <ul id="claseList"></ul>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <button type="button" class="btn btn-secondary" id="addClaseBtn">Agregar</button>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-success">Guardar</button>
                            <a href="{{ route('clases.index_clases') }}" class="btn btn-primary">Volver</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <script>
        document.getElementById('addClaseBtn').addEventListener('click', function() {
            let ejercicio = document.getElementById('ejercicio_id');
            let categoria = document.getElementById('categoria_id');
            let tipo = document.getElementById('grupo_muscular');
            let repeticiones = document.getElementById('repeticiones').value;
            let claseList = document.getElementById('claseList');

            if (categoria.selectedIndex === 0 || ejercicio.selectedIndex === 0 ) {
                alert('Por favor, seleccione una categoría, un ejercicio y especifique las repeticiones.');
                return;
            }

            let existingCategory = document.querySelector(`#claseList [data-category="${categoria.value}"]`);

            if (!existingCategory) {
                let newCategory = document.createElement('li');
                newCategory.innerHTML = `<strong>${categoria.options[categoria.selectedIndex].text}</strong>`;
                newCategory.dataset.category = categoria.value;
                let exerciseList = document.createElement('ul');
                exerciseList.classList.add('exercise-list');

                let exerciseItem = document.createElement('li');
                exerciseItem.innerHTML = `${ejercicio.options[ejercicio.selectedIndex].text} (${repeticiones})`;
                exerciseList.appendChild(exerciseItem);

                newCategory.appendChild(exerciseList);
                claseList.appendChild(newCategory);
            } else {
                let exerciseList = existingCategory.querySelector('ul');
                let exerciseItem = document.createElement('li');
                exerciseItem.innerHTML = `${ejercicio.options[ejercicio.selectedIndex].text} (${repeticiones})`;
                exerciseList.appendChild(exerciseItem);
            }

            ejercicio.selectedIndex = 0;
            categoria.selectedIndex = 0;
            tipo.selectedIndex = 0;
            document.getElementById('repeticiones').value = '';
        });

        document.getElementById('claseForm').addEventListener('submit', function(event) {
    let dynamicEjercicios = [];

    document.querySelectorAll('#claseList li').forEach(function(categoryItem) {
        let categoryElement = categoryItem.querySelector('strong');
        
        if (categoryElement) { // Ensure the category exists
            let categoria = categoryElement.innerText;
            let ejercicios = [];
            
            categoryItem.querySelectorAll('ul li').forEach(function(exerciseItem) {
                ejercicios.push(exerciseItem.innerText);
            });

            dynamicEjercicios.push({
                categoria: categoria,
                ejercicios: ejercicios
            });
        } else {
            console.error('Category element not found.');
        }
    });

    document.getElementById('dynamicEjercicios').value = JSON.stringify(dynamicEjercicios);
});

        
    </script>
@stop
