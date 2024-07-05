@extends('layouts.app')

@section('contenido')
    
    <div class="py-4 d-flex justify-content-end" style="background-color:#dcedc8">
        <button type="button" class="btn btn-info btn-sm float-right" data-toggle="modal" data-target="#crearModal">
            Agregar Nueva Gestion
        </button>
    </div>

    <div class="card">
        <div class="card-header" style="background-color:#558b2f ">
            <div class="d-flex justify-content-center text-white">
                <h2>SECCIÓN GESTIÓN</h2>
            </div>
        </div>
        
        <div class="card-body" style="background-color:  #e6e6e6">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>NRO.</th>
                        <th>NOMBRE</th>
                        {{-- <th>ESTADO</th> --}}
                        <th colspan="2">OPCIONES</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($gestiones as $gestion)
                        <tr>
                            <td>{{ $gestion->contador }}</td>
                            <td>{{ $gestion->nombre }}</td>
                            {{-- <td width="200px;">
                                @if($gestion->estado == 1)
                                    <span class="btn btn-success btn-sm btn-status">Activo</span>
                                @else
                                    <span class="btn btn-danger btn-sm btn-status">Inactivo</span>
                                @endif
                            </td> --}}
                            
                            <td width="25px;">
                                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#editarModal{{ $gestion->id }}">
                                    <i class="fas fa-pencil-alt"></i>
                                </button>
                            </td>

                            <td width="25px;">
                                <form action="{{ route('admin.gestion.destroy', $gestion->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este registro?');">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>

                        <!-- MODAL -->
                        {{-- EDITAR GESTION --}}
                        <div class="modal fade" id="editarModal{{ $gestion->id }}" tabindex="-1" role="dialog" aria-labelledby="editarModalLabel{{ $gestion->id }}" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                            <div class="modal-dialog modal-dialog-custom" role="document">

                                <div class="modal-content">
                                    <div class="modal-header text-white" style="background-color: #558b2f; position: relative;">

                                        <h2 class="modal-title" id="editarModalLabel{{ $gestion->id }}" style="flex-grow: 1; text-align: center;">EDITAR GESTIÓN</h2>
                                        
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="position: absolute; right: 10px; top: 10px;">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Formulario para Editar el Registro -->
                                        <form action="{{ route('admin.gestion.update', $gestion->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')

                                            <div class="form-group">
                                                <label for="gestion">Gestión:</label>
                                                <input class="form-control" type="number" name="nombre" id="nombre" value="{{ $gestion->nombre }}" placeholder="Ingrese Gestión">
                                            </div>

                                            <!-- Pie del modal -->
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

                                                <button type="submit" class="btn btn-primary">Actualizar</button>
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
    {{-- CREAR GESTIÓN --}}
    <div class="modal fade" id="crearModal" tabindex="-1" role="dialog" aria-labelledby="crearModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-custom" role="document">
            <div class="modal-content">

                <!-- Cabecera del modal -->
                <div class="modal-header text-white" style="background-color: #558b2f; position: relative;">

                <h3 class="modal-title" id="crearModalLabel" style="flex-grow: 1; text-align: center;">AGREGAR GESTIÓN</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="position: absolute; right: 10px; top: 10px;">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>

                <!-- Contenido del modal -->
                <div class="modal-body">

                    <form action="{{ route('admin.gestion.store') }}" method="POST">
                        @csrf
                        
                        <div class="form-group">
                            <label for="gestion">Gestión:</label>
                            <input class="form-control" type="number" name="nombre" id="nombre" placeholder="Ingrese Gestión">
                            @error('nombre')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Pie del modal -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Agregar </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    @parent
    <style>
        .modal-dialog-custom {
        max-width: 60%; /* Ajusta el valor según tus necesidades */
        }

        /* .btn-status {
            font-size: 12px;
            padding: 2px 5px;
            font:bold;
            cursor: default;
        } */

    </style>
@stop

@section('js')
    @parent

@stop