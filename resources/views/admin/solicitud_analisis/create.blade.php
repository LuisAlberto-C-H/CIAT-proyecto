@extends('layouts.app')

@section('contenido')

<div class="py-4 d-flex justify-content-end"> 
</div>

<div class="card ml-5 mr-5 mt-2">

    <div class="card-header" style="background-color:#558b2f ">
        <div class="d-flex justify-content-center text-white">
            <h2>AGREGAR NUEVA SOLICITUD DE ANÁLISIS</h2>
        </div>
    </div>

    <div class="card-body px-5" style="background-color: #e6e6e6; padding-bottom: 56px;">

        <div class="pb-3">
            <a class="flecha-atras" style="font-size: 20px;" href="{{ route('admin.solicitud_analisis.index') }}">
                <span>&#8592;</span>Regresar
            </a>
        </div>
        
        <form action="{{ route('admin.solicitud_analisis.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="cliente">Buscar Nombre del Cliente:</label>                        
                        <div class="input-container">
                            <input type="text" id="cliente" name="cliente" class="form-control" autocomplete="off" placeholder="Buscar Nombre del cliente..." value="{{ old('cliente') }}">
                            <i class="fas fa-search"></i>
                            <div id="resultados_cliente" class="list-group" style="position: absolute; z-index: 1000; background: white; width: 100%; display: none;"></div>
                        </div>
                        @error('cliente_id')
                            <p style="color: red; font-size: 1.0em;">{{ $message }}</p>
                        @enderror

                        <input type="hidden" id="cliente_id" name="cliente_id" value="{{ old('cliente_id') }}">
                    </div>
                </div>

                <div class="col-md-3">
                    <label for="gestion_id">Gestión:</label>
                    <select class="form-control" name="gestion_id" id="gestion_id" style="width: 100%;">
                        <option value="" selected>Seleccione una gestión...</option>
                        @foreach ($gestiones as $gestion)
                            <option value="{{ $gestion->id }}"  {{ old('gestion_id') == $gestion->id ? 'selected' : '' }}>{{ $gestion->nombre }}</option>
                        @endforeach
                    </select>
                    @error('gestion_id')
                        <p style="color: red; font-size: 1.0em;">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="fecha_muestreo">Fecha de muestreo</label>
                        <input type="date" name="fecha_muestreo" id="fecha_muestreo" class="form-control" value="{{ old('fecha_muestreo') }}">
                        @error('fecha_muestreo')
                            <p style="color: red; font-size: 1.0em;">{{ $message }}</p>
                        @enderror
                    </div>
                </div> 
            </div>
            <hr>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="glosario">Descripción/Solicitud de Análisis</label>
                        <div class="input-container">
                            <textarea name="glosario" id="glosario" cols="50" rows="2" class="form-control capitalize-first-word" placeholder="Ingrese descripción de la solicitud a realizar...">{{ old('glosario') }}</textarea>
                            @error('glosario')
                                <p style="color: red; font-size: 1.0em;">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="lugar_muestreo">Lugar de Muestreo:</label>
                        <input type="text" name="lugar_muestreo" class="form-control capitalize-first-word" placeholder="Describa la Zona del terreno de donde se obtuvo la muestra..." value="{{ old('lugar_muestreo') }}">
                        @error('lugar_muestreo')
                            <p style="color: red; font-size: 1.0em;">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="cultivo_anterior">Cultivo Anterior</label>
                        <input type="text" name="cultivo_anterior" class="form-control capitalize-first-word" placeholder="Ingrese el cultivo anterior realizado..." value="{{ old('cultivo_anterior') }}">
                        @error('cultivo_anterior')
                            <p style="color: red; font-size: 1.0em;">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="cultivo_actual">Cultivo Actual</label>
                        <input type="text" name="cultivo_actual" class="form-control capitalize-first-word" placeholder="Ingrese el cultivo actual realizado..." value="{{ old('cultivo_actual') }}">
                        @error('cultivo_actual')
                            <p style="color: red; font-size: 1.0em;">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                
            </div>
            <hr>
            <div class="form-group" style="margin-top:30px;" >
                <button type="submit" class="btn btn-primary w-25 float-right">
                    <i class="fas fa-solid fa-plus mr-2"></i> Agregar
                </button>
            </div>
        </form>
    </div>
</div>

<div class="pb-5"></div>
@endsection

@section('css')
    @parent
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    {{-- --------TOAST.MIN.CSS--------}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <style>
        .input-container {
            position: relative;
            width: 100%;
        }
    
        .input-container input {
            width: 100%;
            padding-left: 40px; /* Espacio para el icono */
        }
    
        .input-container .fa-search {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: #aaa;
        }
    
        .list-group {
            margin-top: 10px;
            /* border: 1px solid #ccc; */
            border: 1.5px solid #aaa;
            max-height: 200px;
            overflow-y: auto;
        }
    
        .list-group-item {
            cursor: pointer;
            padding: 7px 10px 7px 18px;
            border: none;
        }
    
        .list-group-item:hover {
            /* background-color: #f0f0f0; */
            background-color: #5897fb;
            color: white;
        }

        /* -------INPUT SELECT2 PERSONALIZADO-------- */
        .select2-container .select2-selection--single {
            height: 38px; 
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: center;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 38px; /* Alinea la flecha verticalmente */
        }

        /*---------TEXT AREA--------*/
        textarea {
            /* width: 100%; */
            resize: none; /* Esto evita que el usuario cambie el tamaño del textarea */
        }

        /*-------- HR------------*/
        hr {
            border: none;
            border-top: 2px dotted #888;
            height: 0px;
        }

        /* ---------- BUSCADOR SIN COINCIDENCIAS------- */
        .no-coincidencias {
            color: #999; /* Color más claro */
        }

        .no-coincidencias .query {
            color: red; /* Color rojo para el texto ingresado */
        }

        /* ----------FLECHCA VOLVER ATRÁS------ */
        .flecha-atras {
            font-size: 24px;
            text-decoration: none;
            color: #007BFF; /* Color de la flecha */
            /* transition: text-decoration 0.3s ease; Transición suave para el subrayado */            
        }
        .flecha-atras:hover {
            color: #0056b3; /* Color de la flecha al pasar el mouse */
            text-decoration: underline; /* Subrayado al pasar el mouse */
        }
    </style>
@stop

@section('js')
    @parent
    {{-----------jquery--------}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    {{-----------Select2--------}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    {{-- ------TOAST.JS------- --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    <script>
        $(document).ready(function() {
            $('#gestion_id').select2({
                placeholder: "Seleccione la gestión...",
                // allowClear: true, // Opcional: permite limpiar la selección
                // dropdownParent: $('#gestion_id').parent()
            });
        });
    </script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let queryInput = document.getElementById('cliente');
    let resultados = document.getElementById('resultados_cliente');

    queryInput.addEventListener('keyup', function() {
        let query = this.value.trim();

        if (query.length > 2) {
            fetch(`/admin/buscar-cliente?query=${query}`) // Reemplaza por la ruta correcta en tu aplicación
                .then(response => response.json())
                .then(data => {
                    resultados.innerHTML = ''; // Limpiar resultados anteriores

                    if (data.length > 0) {
                        data.forEach(cliente => {
                            let item = document.createElement('div');
                            item.classList.add('list-group-item', 'list-group-item-action');
                            item.textContent = `${cliente.persona.nombre} ${cliente.persona.apellido} - ${cliente.propiedad_nombre}`;
                            item.addEventListener('click', function(e) {
                                e.preventDefault();
                                document.getElementById('cliente').value = `${cliente.persona.nombre} ${cliente.persona.apellido} - ${cliente.propiedad_nombre}`;
                                document.getElementById('cliente_id').value = cliente.id;
                                resultados.style.display = 'none';
                            });
                            resultados.appendChild(item);
                        });
                        resultados.style.display = 'block';
                    } else {
                        let item = document.createElement('div');
                        item.classList.add('list-group-item', 'no-coincidencias');
                        item.innerHTML = `No existen coincidencias para... "<span class="query">${query}</span>"`;
                        resultados.appendChild(item);
                        resultados.style.display = 'block';
                    }
                });
        } else {
            resultados.style.display = 'none';
            resultados.innerHTML = ''; // Limpiar resultados cuando la longitud de la consulta sea menor a 3 caracteres
        }
    });

    // Ocultar resultados al hacer clic fuera del input o de la lista de resultados
    document.addEventListener('click', function(e) {
        if (!resultados.contains(e.target)) {
            resultados.style.display = 'none';
            resultados.innerHTML = '';
        }
    });
});
</script>

<script>
    // Función para convertir solo la primera letra de la primera palabra en mayúscula
    function capitalizeFirstWord(string) {
        var firstWord = string.split(' ')[0];
        return firstWord.charAt(0).toUpperCase() + firstWord.slice(1) + string.slice(firstWord.length);
    }

    // Selecciona todos los inputs con la clase 'capitalize-first-word' y añade el evento
    document.querySelectorAll('.capitalize-first-word').forEach(function(input) {
        input.addEventListener('input', function(e) {
            e.target.value = capitalizeFirstWord(e.target.value);
        });
    });
</script>

{{-- <script>
    document.getElementById('gestionForm').addEventListener('submit', function(event) {
        let gestionSelect = document.getElementById('gestion_id');
        if (gestionSelect.value === '') {
            alert('Por favor, seleccione una gestión.');
            event.preventDefault(); // Evita el envío del formulario
        }
    });
</script> --}}

{{-- @if(Session::has('message'))
    <script>
        toastr.success("{{ Session::get('message') }}");
    </script>
@endif --}}
@if(session()->has('message'))
    <script>
        toastr.success("{{ session('message') }}");
    </script>
@endif

@stop