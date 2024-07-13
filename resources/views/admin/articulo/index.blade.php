@extends('layouts.app')

@section('contenido')
    
    <div class="py-4 d-flex justify-content-end" style="background-color:#dcedc8;">
        <button type="button" class="btn btn-info btn-sm float-right" data-toggle="modal" data-target="#exampleModal">
            Agregar Nuevo Artículo
        </button>
    </div>

    <div class="card">

        <div class="card-header" style="background-color:#558b2f;">
            <div class="d-flex justify-content-center text-white">
                <h2>SECCIÓN ARTÍCULO</h2>
            </div>
        </div>
        
        <div class="card-body" style="background-color:#e6e6e6;">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>NRO.</th>
                        <th>NOMBRE DE ARTÍCULO</th>
                        <th>PRECIO</th>
                        <th>TIPO DE ANÁLISIS</th>
                        <th colspan="2">OPCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $total = count($articulos);
                    @endphp

                    @foreach ($articulos as $index => $articulo)
                        <tr>
                            <td>{{ $total - $index }}</td>
                            <td>{{ $articulo->nombre }}</td>
                            <td>{{ $articulo->precio }}</td>
                            <td>{{ $articulo->tipo_analisis->nombre }}</td>
                            
                            <td width="25px;">
                                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#editarModal{{ $articulo->id }}">
                                    <i class="fas fa-pencil-alt"></i>
                                </button>
                            </td>

                            <td width="25px;">
                                <form action="{{ route('admin.articulo.destroy', $articulo->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este registro?');">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        <!-- MODAL -->
                        {{-- EDITAR ARTICULO --}}
                        <div class="modal fade" id="editarModal{{ $articulo->id }}" tabindex="-1" role="dialog" aria-labelledby="editarModalLabel{{ $articulo->id }}" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                            <div class="modal-dialog modal-dialog-custom" role="document">

                                <div class="modal-content">
                                    <div class="modal-header text-white" style="background-color: #558b2f; position: relative;">

                                        <h2 class="modal-title" id="editarModalLabel{{ $articulo->id }}" style="flex-grow: 1; text-align: center;">EDITAR PAÍS</h2>
                                        
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="position: absolute; right: 10px; top: 10px;">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body pt-4 pb-4" style="padding-left: 35px; padding-right:35px; background-color:#e9ecef;">
                                        <!-- Formulario para Editar el Registro -->
                                        <form action="{{ route('admin.articulo.update', $articulo->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')

                                            <div class="form-group">
                                                <label for="nombre">Artículo:</label>
                                                <input class="form-control @error('nombre') is-invalid @enderror" type="text" name="nombre" value="{{ $articulo->nombre }}" placeholder="Ingrese nombre del artículo" autocomplete="off" style="border: solid 1px #558b2f;">

                                                @error('nombre')
                                                    <p class="invalid-feedback" style="color: red; font-size: 1.0em;">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            
                                            <!-- Pie del modal -->
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

                                                <button type="submit" class="btn btn-primary" style="padding-left:30px; padding-right:30px;">Actualizar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    {{-- CREAR ARTÍCULO --}}
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-custom" role="document">
            <div class="modal-content">

                <!-- Cabecera del modal -->
                <div class="modal-header text-white" style="background-color: #558b2f; position: relative;">

                    <h3 class="modal-title" id="exampleModalLabel" style="flex-grow: 1; text-align: center;">AGREGAR ARTÍCULO</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="position: absolute; right: 10px; top: 10px;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <!-- Contenido del modal -->
                <div class="modal-body pt-4 pb-4" style="padding-left: 35px; padding-right:35px; background-color:#e9ecef;">

                    <form action="{{ route('admin.articulo.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="nombre">Tipo de Análisis perteneciente:</label>
                            
                            <select class="form-control @error('tipo_analisis_id') is-invalid @enderror" name="tipo_analisis_id" id="tipo_analisis_id" style="width: 100%;">
                                <option value="" selected>Seleccione el tipo de análisis perteneciente...</option>
                                @foreach ($tipo_analisis as $tipo)
                                    <option value="{{ $tipo->id }}" {{ old('tipo_analisis_id') == $tipo->id ? 'selected' : '' }}>{{ $tipo->nombre }}</option>
                                @endforeach
                            </select>

                            @error('tipo_analisis_id')
                                <p class="invalid-feedback" style="color: red; font-size: 1.0em;">{{ $message }}</p>
                            @enderror
                        </div>
                    
                        <div class="form-group">
                            <label for="nombre">Nombre del Artículo:</label>
                            <input class="form-control @error('nombre') is-invalid @enderror" type="text" name="nombre" placeholder="Ingrese nombre del artículo" autocomplete="off" style="border: solid 1px #558b2f;" value="{{ old('nombre') }}">

                            @error('nombre')
                                <p class="invalid-feedback" style="color: red; font-size: 1.0em;">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="precio">Precio:</label>
                            <input class="form-control @error('precio') is-invalid @enderror" type="number" min="0" step="1" name="precio" placeholder="Ingrese precio del artículo" autocomplete="off" style="border: solid 1px #558b2f;" value="{{ old('precio') }}">

                            @error('precio')
                                <p class="invalid-feedback" style="color: red; font-size: 1.0em;">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Pie del modal -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary" style="padding-left:30px; padding-right:30px;">Agregar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    

@endsection

@section('css')
    @parent
    {{-- --------SELECT2--------}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    {{-- --------TOAST.MIN.CSS--------}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        /* ANCHURA DEL MODAL */
        .modal-dialog-custom {
        max-width: 60%; /* Ajusta el valor según tus necesidades */
        }

        /* -------INPUT SELECT2 PERSONALIZADO-------- */
        .select2-container .select2-selection--single {
            height: 39px;
            border-color: #558b2f !important; 
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: center;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 38px; /* Alinea la flecha verticalmente */
        }

        /* ---- PLACEHOLDER---- */
        .select2-container .select2-selection--single .select2-selection__placeholder {
            color: #939ba2;
        }

        /* Borde del Select2 en estado de foco (cuando se selecciona) */
        .select2-container--open .select2-selection--single {
            border-color: #558b2f !important;
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
            $('#tipo_analisis_id').select2({
                placeholder: "Seleccione al tipo de análisis perteneciente...",
                // allowClear: true, // Opcional: permite limpiar la selección
                // dropdownParent: $('#gestion_id').parent()
            });
        });
    </script>

    @if(session()->has('message'))
        <script>
            $(document).ready(function() {
                toastr.success("{{ session('message') }}");
            });
        </script>
    @endif

    @if($errors->any())
        <script>
            @foreach ($errors->all() as $error)
                toastr.error('{{ $error }}');
            @endforeach
        </script>
    @endif
@stop