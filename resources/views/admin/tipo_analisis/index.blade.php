@extends('layouts.app')

@section('contenido')
    
    <div class="py-4 d-flex justify-content-end" style="background-color:#dcedc8">
        <button type="button" class="btn btn-info btn-sm float-right" data-toggle="modal" data-target="#exampleModal">
            Agregar Nuevo Tipo de Analisis
        </button>
    </div>

    <div class="card">

        <div class="card-header" style="background-color:#558b2f ">
            <div class="d-flex justify-content-center text-white">
                <h2>SECCIÓN TIPO DE ANÁLISIS</h2>
            </div>
        </div>
        
        <div class="card-body" style="background-color:#e6e6e6;">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nro.</th>
                        <th>NOMBRE</th>
                        {{-- <th>ESTADO</th> --}}
                        <th colspan="2">OPCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $total = count($tipo_analisis);
                    @endphp

                    @foreach ($tipo_analisis as $index => $tipo)
                        <tr>
                            <td>{{ $total - $index }}</td>
                            <td>{{ $tipo->nombre }}</td>
                            
                            <td width="25px;">
                                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#editarModal{{ $tipo->id }}">
                                    <i class="fas fa-pencil-alt"></i>
                                  </button>
                            </td>

                            <td width="25px;">
                                <form action="{{ route('admin.tipo_analisis.destroy', $tipo->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este registro?');">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        <!-- MODAL -->
                        {{-- EDITAR Tipo de Analisis --}}
                        <div class="modal fade" id="editarModal{{ $tipo->id }}" tabindex="-1" role="dialog" aria-labelledby="editarModalLabel{{ $tipo->id }}" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                            <div class="modal-dialog modal-dialog-custom" role="document">

                                <div class="modal-content">
                                    <div class="modal-header text-white" style="background-color: #558b2f; position: relative;">

                                        <h2 class="modal-title" id="editarModalLabel{{ $tipo->id }}" style="flex-grow: 1; text-align: center;">EDITAR PAÍS</h2>
                                        
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="position: absolute; right: 10px; top: 10px;">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body pt-4 pb-4" style="padding-left: 35px; padding-right:35px; background-color:#e9ecef;">
                                        <!-- Formulario para Editar el Registro -->
                                        <form action="{{ route('admin.tipo_analisis.update', $tipo->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')

                                            <div class="form-group">
                                                <label for="nombre">Tipo de Análisis:</label>
                                                <input class="form-control @error('nombre') is-invalid @enderror" type="text" name="nombre" value="{{ $tipo->nombre }}" placeholder="Ingrese nombre del tipo de Análisis" autocomplete="off" style="border: solid 1px #558b2f">

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
    {{-- CREAR TIPO DE ANALISIS --}}
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-custom" role="document">
            <div class="modal-content">

                <!-- Cabecera del modal -->
                <div class="modal-header text-white" style="background-color: #558b2f; position: relative;">

                <h3 class="modal-title" id="exampleModalLabel" style="flex-grow: 1; text-align: center;">AGREGAR TIPO DE ANÁLISIS</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="position: absolute; right: 10px; top: 10px;">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>

                <!-- Contenido del modal -->
                <div class="modal-body pt-4 pb-4" style="padding-left: 35px; padding-right:35px; background-color:#e9ecef;">

                    <form action="{{ route('admin.tipo_analisis.store') }}" method="POST">
                        @csrf
                        
                        <div class="form-group">
                            <label for="nombre">Tipo de Análisis:</label>
                            {{-- <input class="form-control" type="text" name="nombre" id="nombre" placeholder="Ingrese nombre del tipo de Análisis" autocomplete="off" style="border: solid 1px #558b2f">

                            @error('nombre')
                            <p style="color: red; font-size: 1.0em;">{{ $message }}</p>
                            @enderror --}}
                            <input class="form-control @error('nombre') is-invalid @enderror" type="text" name="nombre" placeholder="Ingrese nombre del tipo de Análisis" autocomplete="off" style="border: solid 1px #558b2f">

                            @error('nombre')
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
    {{-- --------TOAST.MIN.CSS--------}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <style>
        .modal-dialog-custom {
        max-width: 60%; /* Ajusta el valor según tus necesidades */
    }
    </style>
    
@stop
    
@section('js')
    @parent
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    {{-- ------TOAST.JS------- --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

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