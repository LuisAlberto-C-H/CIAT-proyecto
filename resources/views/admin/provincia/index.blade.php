@extends('layouts.app')

@section('contenido')

<div class="py-4 d-flex justify-content-end" style="background-color:#dcedc8">
    <a href="{{ route('admin.provincia.create') }}">
        <button class="btn btn-info">Agregar Nueva Provincia</button>
    </a>
</div>

<div class="card">
    {{-- #28b463 --}}

    <div class="card-header" style="background-color:#558b2f ">
        <div class="d-flex justify-content-center text-white">
            <h2>SECCIÓN PROVINCIA</h2>
        </div>
    </div>

    <div class="card-body" style="background-color:  #e6e6e6">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Departamento</th>
                    <th>Provincia</th>
                    {{-- <th>Estado</th> --}}
                    <th colspan="2">OPCIONES</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($provincias as $provincia)
                    <tr>
                        <td>{{ $provincia->id }}</td>
                        <td>{{ $provincia->departamento->nombre }}</td>
                        <td>{{ $provincia->nombre }}</td>
                        {{-- <td>{{ $provincia->estado }}</td> --}}


                        <td width="25px;">
                            <a class="btn btn-sm btn-primary" href="{{ route('admin.provincia.edit', $provincia) }}"><i class="fas fa-pencil-alt"></i></a>
                        </td>

                        <td width="25px;">
                            <form action="{{ route('admin.provincia.destroy', $provincia) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este registro?');">
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

@endsection