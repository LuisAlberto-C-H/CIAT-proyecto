@extends('adminlte::page')

@section('title', 'CIAT')

{{-- @section('content_header')
    <h1>Panel Administrativo</h1>
@stop --}}

@section('content')
    
    <div class="py-4 d-flex justify-content-end" style="background-color:#dcedc8">
        <a href="{{ route('admin.persona.create') }}">
            <button class="btn btn-info">Agregar Nueva Persona</button>
        </a>
    </div>

    <div class="card">
        {{-- <div class="card-header">
            <a class="btn btn-md btn-success float-right" href="{{ route('admin.persona.create') }}">Agregar Persona</a>
        </div> --}}

        <div class="card-header" style="background-color:#558b2f">
            <div class="d-flex justify-content-center text-white">
                <h2>SECCIÓN DIRECTORIO</h2>
            </div>
        </div>
        
        <div class="card-body" style="background-color:#e6e6e6;">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>NOMBRE</th>
                        <th>APELLIDO</th>
                        <th>TELÉFONO</th>
                        <th>DIRECCIÓN</th>
                        <th>EMAIL</th>
                        {{-- <th>ESTADO</th> --}}
                        <th colspan="2">OPCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($personas as $persona)
                        <tr>
                            <td>{{ $persona->id }}</td>
                            <td>{{ $persona->nombre }}</td>
                            <td>{{ $persona->apellido }}</td>
                            <td>{{ $persona->telefono }}</td>
                            <td>{{ $persona->direccion }}</td>
                            <td>{{ $persona->email }}</td>
                            {{-- <td>{{ $persona->estado }}</td> --}}
                            <td>
                                <a class="btn btn-sm btn-primary" href="{{ route('admin.persona.edit', $persona) }}"><i class="fas fa-pencil-alt"></i></a>
                            </td>
                            <td>
                                <form action="{{ route('admin.persona.destroy', $persona) }}" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@stop

@section('css')
    <style>
        .content-wrapper {
            background-color: #dcedc8 /* Cambia este color al que prefieras */
        }
    </style>
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop

