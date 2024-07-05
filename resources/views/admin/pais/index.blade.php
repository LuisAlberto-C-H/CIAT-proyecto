@extends('layouts.app')

@section('contenido')
    
    <div class="py-4 d-flex justify-content-end" style="background-color:#dcedc8">

        {{-- <a href="{{ route('admin.departamento.create') }}">
            <button class="btn btn-info">Agregar Nuevo Dpto.</button>
        </a> --}}

        <button type="button" class="btn btn-info btn-sm float-right" data-toggle="modal" data-target="#exampleModal">
            Agregar Nuevo País
        </button>

    </div>

    

    <div class="card">
        {{-- <div class="card-header">
            <a  class="btn btn-md btn-success float-right" href="{{ route('admin.pais.create') }}">Agregar Nuevo País</a>
        </div> --}}

        <div class="card-header" style="background-color:#558b2f ">
            <div class="d-flex justify-content-center text-white">
                <h2>SECCIÓN PAÍS</h2>
            </div>
        </div>
        
        <div class="card-body" style="background-color:#e6e6e6;">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>NOMBRE</th>
                        {{-- <th>ESTADO</th> --}}
                        <th colspan="2">OPCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($paises as $pais)
                        <tr>
                            <td>{{ $pais->id }}</td>
                            <td>{{ $pais->nombre }}</td>
                            {{-- <td>{{ $pais->estado }}</td> --}}
                            
                            <td width="25px;">
                                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#editarModal{{ $pais->id }}">
                                    <i class="fas fa-pencil-alt"></i>
                                  </button>
                            </td>

                            <td width="25px;">
                                <form action="{{ route('admin.pais.destroy', $pais->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este registro?');">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>

                        <!-- MODAL -->
                        {{-- EDITAR PAIS --}}
                        <div class="modal fade" id="editarModal{{ $pais->id }}" tabindex="-1" role="dialog" aria-labelledby="editarModalLabel{{ $pais->id }}" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                            <div class="modal-dialog modal-dialog-custom" role="document">

                            <div class="modal-content">
                                <div class="modal-header text-white" style="background-color: #558b2f; position: relative;">

                                    <h2 class="modal-title" id="editarModalLabel{{ $pais->id }}" style="flex-grow: 1; text-align: center;">EDITAR PAÍS</h2>
                                    
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="position: absolute; right: 10px; top: 10px;">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                <!-- Formulario para Editar el Registro -->
                                <form action="{{ route('admin.pais.update', $pais->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                        <div class="form-group">
                                            <label for="pais">País:</label>
                                            <input class="form-control" type="text" name="nombre" id="nombre" value="{{ $pais->nombre }}" placeholder="Ingrese Pais">
                                        </div>

                                        {{-- <div class="form-group">
                                            <label for="estado">Estado:</label>

                                            <select class="form-control" name="estado" id="estado">
                                                <option value= "1" <?php if ($pais->estado == 1) 'selected'; ?>>Activado</option>
                                                <option value= "0" <?php if ($pais->estado == 0) 'selected'; ?>>Inactivo</option>
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

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    {{-- CREAR PAIS --}}
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-custom" role="document">
            <div class="modal-content">

                <!-- Cabecera del modal -->
                <div class="modal-header text-white" style="background-color: #558b2f; position: relative;">

                <h3 class="modal-title" id="exampleModalLabel" style="flex-grow: 1; text-align: center;">AGREGAR PAÍS</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="position: absolute; right: 10px; top: 10px;">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>

                <!-- Contenido del modal -->
                <div class="modal-body">

                    <form action="{{ route('admin.pais.store') }}" method="POST">
                        @csrf
                        
                        <div class="form-group">
                            <label for="pais">País:</label>
                            <input class="form-control" type="text" name="nombre" id="nombre" placeholder="Ingrese Pais">
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