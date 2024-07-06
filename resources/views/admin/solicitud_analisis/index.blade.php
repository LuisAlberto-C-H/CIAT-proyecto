@extends('layouts.app')

@section('contenido')

<div class="py-4 d-flex justify-content-end" style="background-color:#dcedc8">
    <a href="{{ route('admin.solicitud_analisis.create') }}">
        <button class="btn btn-info">Agregar Nueva Solicitud de Análisis</button>
    </a>
</div>

<div class="card">

    <div class="card-header" style="background-color:#558b2f">
        <div class="d-flex justify-content-center text-white">
            <h2>SECCIÓN SOLICITUD DE ANÁLISIS</h2>
        </div>
    </div>

    <div class="card-body" style="background-color:#e6e6e6">

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>NRO.</th>
                    <th>CLIENTE</th>
                    <th>GESTION</th>
                    <th>DETALLE</th>
                    <th>FECHA DE MUESTREO</th>
                    <th>CULTIVO ANTERIOR</th>
                    <th>CULTIVO ACTUAL</th>
                    <th>LUGAR MUESTREO</th>
                    <th colspan="2">OPCIONES</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($solicitudes_analisis as $solicitud)
                    <tr>
                        <td>{{ $solicitud->id }}</td>
                        <td>{{ $solicitud->cliente->persona->nombre}} {{ $solicitud->cliente->persona->apellido}}</td>
                        <td>{{ $solicitud->gestion->nombre }}</td>
                        <td>{{ $solicitud->glosario }}</td>
                        <td>{{ $solicitud->fecha_muestreo }}</td>
                        <td>{{ $solicitud->cultivo_anterior }}</td>
                        <td>{{ $solicitud->cultivo_actual }}</td>
                        <td>{{ $solicitud->lugar_muestreo }}</td>
                        {{-- <td>{{ $cliente->persona->nombre }} {{ $cliente->persona->apellido }}</td>
                        <td>{{ optional($cliente->propiedad)->nombre ?? 'Sin/ Propiedad' }}</td>
                        <td>{{ $cliente->institucion ?? 'Sin/Institución' }}</td>
                        <td>{{ $cliente->nit }}</td> --}}

                        <td width="25px;">
                            <a class="btn btn-sm btn-primary" href="{{ route('admin.solicitud_analisis.edit', $solicitud) }}"><i class="fas fa-pencil-alt"></i></a>
                        </td>

                        <td width="25px;">
                            <form action="{{ route('admin.solicitud_analisis.destroy', $solicitud) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este registro?');">
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
    {{-- --------TOAST.MIN.CSS--------}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
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
@stop