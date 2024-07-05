@extends('layouts.app')

@section('contenido')
    
    <div class="py-4 d-flex justify-content-end" style="background-color:#dcedc8">

        {{-- <a href="{{ route('admin.departamento.create') }}">
            <button class="btn btn-info">Agregar Nuevo Dpto.</button>
        </a> --}}

        <button type="button" class="btn btn-info btn-sm float-right" data-toggle="modal" data-target="#exampleModal">
            Agregar Nuevo Municipio
        </button>

    </div>

    

    <div class="card">
        {{-- <div class="card-header">
            <a  class="btn btn-md btn-success float-right" href="{{ route('admin.pais.create') }}">Agregar Nuevo País</a>
        </div> --}}

        <div class="card-header" style="background-color:#558b2f ">
            <div class="d-flex justify-content-center text-white">
                <h2>SECCIÓN MUNICIPIO</h2>
            </div>
        </div>
        
        <div class="card-body" style="background-color:  #e6e6e6">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>PROVINCIA</th>
                        <th>MUNICIPIO</th>
                        {{-- <th>ESTADO</th> --}}
                        <th colspan="2">OPCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($municipios as $municipio)
                        <tr>
                            <td>{{ $municipio->id }}</td>
                            <td>{{ $municipio->provincia->nombre }}</td>
                            <td>{{ $municipio->nombre }}</td>
                            {{-- <td>{{ $municipio->estado }}</td> --}}
                            
                            <td width="25px;">
                                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#editarModal{{ $municipio->id }}">
                                    <i class="fas fa-pencil-alt"></i>
                                  </button>
                            </td>

                            <td width="25px;">
                                <form action="{{ route('admin.municipio.destroy', $municipio->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este registro?');">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>

                        <!-- MODAL -->
                        {{-- EDITAR MUNICIPIO --}}
                        <div class="modal fade" id="editarModal{{ $municipio->id }}" tabindex="-1" role="dialog" aria-labelledby="editarModalLabel{{ $municipio->id }}" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                            <div class="modal-dialog modal-dialog-custom" role="document">

                            <div class="modal-content">
                                <div class="modal-header text-white" style="background-color: #558b2f; position: relative;">

                                    <h2 class="modal-title" id="editarModalLabel{{ $municipio->id }}" style="flex-grow: 1; text-align: center;">EDITAR MUNICIPIO</h2>
                                    
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="position: absolute; right: 10px; top: 10px;">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <div class="modal-body">

                                <form action="{{ route('admin.municipio.update', $municipio->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="">
                                        <label for="provincia_id">Provincia:</label>
                                        <select name="provincia_id" id="" class="form-control">
                    
                                            {{-- <option value="" hidden selected>Seleccionar país perteneciente...</option> --}}
                    
                                            @foreach ($provincias as $provincia)
                                                <option value="{{ $provincia->id }}" {{ $municipio->provincia_id == $provincia->id ? 'selected' : '' }}>{{ $provincia->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>


                                    <div class="form-group">
                                        <label for="nombre">Municipio:</label>
                                        <input class="form-control" type="text" name="nombre" id="nombre" value="{{ $municipio->nombre }}" placeholder="Ingrese nombre del Municipio">
                                    </div>

                                    {{-- <div class="form-group">
                                        <label for="estado">Estado:</label>

                                        <select class="form-control" name="estado" id="estado">
                                            <option value="1" <?php if ($municipio->estado == 1) echo 'selected="selected"'; ?>>Activo</option>
                                            <option value="0" <?php if ($municipio->estado == 0) echo 'selected="selected"'; ?>>Inactivo</option>
                                        </select>
                                    </div> --}}
                                        
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
    {{-- CREAR MUNICIPIO --}}
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-custom" role="document">
            <div class="modal-content">

                <!-- Cabecera del modal -->
                <div class="modal-header text-white" style="background-color: #558b2f; position: relative;">

                <h2 class="modal-title" id="exampleModalLabel" style="flex-grow: 1; text-align: center;">AGREGAR MUNICIPIO</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="position: absolute; right: 10px; top: 10px;">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>

                <!-- Contenido del modal -->
                <div class="modal-body">

                    <form action="{{ route('admin.municipio.store') }}" method="POST">
                        @csrf
                        
                        <div class="">
                            <label for="provincia_id">Provincia:</label>
        
                            <select name="provincia_id" id="" class="form-control">
                                <option value="" hidden selected>Seleccionar a la provincia perteneciente...</option>

                                @foreach ($provincias as $provincia)
                                    <option value="{{ $provincia->id }}">{{ $provincia->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="nombre">Municipio:</label>
                            <input class="form-control" type="text" name="nombre" id="nombre" placeholder="Ingrese nombre del municipio...">
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

    <style>
        .modal-dialog-custom {
        max-width: 60%; /* Ajusta el valor según tus necesidades */
      }
    </style>

@endsection