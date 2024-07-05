@extends('layouts.app')

@section('contenido')

<div class="py-4 d-flex justify-content-end" style="background-color:#dcedc8">
    <a href="{{ route('admin.cliente.create') }}">
        <button class="btn btn-info">Agregar Nuevo Cliente</button>
    </a>
</div>

<div class="card">

    <div class="card-header" style="background-color:#558b2f">
        <div class="d-flex justify-content-center text-white">
            <h2>SECCIÓN CLIENTES</h2>
        </div>
    </div>

    <div class="card-body" style="background-color:#e6e6e6">

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>NRO.</th>
                    <th>CLIENTE</th>
                    <th>PROPIEDAD</th>
                    <th>INSTITUCIÓN</th>
                    <th>NIT</th>
                    <th colspan="2">OPCIONES</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($clientes as $cliente)
                    <tr>
                        <td>{{ $cliente->id }}</td>
                        <td>{{ $cliente->persona->nombre }} {{ $cliente->persona->apellido }}</td>
                        <td>{{ optional($cliente->propiedad)->nombre ?? 'Sin/ Propiedad' }}</td>
                        <td>{{ $cliente->institucion ?? 'Sin/Institución' }}</td>
                        <td>{{ $cliente->nit }}</td>

                        <td width="25px;">
                            <a class="btn btn-sm btn-primary" href="{{ route('admin.cliente.edit', $cliente) }}"><i class="fas fa-pencil-alt"></i></a>
                        </td>

                        <td width="25px;">
                            <form action="{{ route('admin.cliente.destroy', $cliente) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este registro?');">
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

@section('css')
    @parent
    
@stop

@section('js')
    @parent

@stop