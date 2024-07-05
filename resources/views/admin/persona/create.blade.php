@extends('adminlte::page')

@section('title', 'CIAT')

{{-- @section('content_header')
    <h1>Panel Administrativo</h1>
@stop --}}

@section('content')
    <div class="py-4 d-flex justify-content-end"> 
    </div>
    <div class="card">
        {{-- #28b463 --}}
        <div class="card-header" style="background-color:#558b2f ">
            <div class="d-flex justify-content-center text-white">
                <h2>AGREGAR PERSONA AL DIRECTORIO</h2>
            </div>
        </div>

        <div class="card-body" style="background-color:  #e6e6e6">

            <form action="{{ route('admin.persona.store') }}" method="POST">
                @csrf
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nombre">Nombre:</label>
                            <input class="form-control" type="text" name="nombre" id="nombre" placeholder="Ingrese nombre" >
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="apellido">Apellido:</label>
                            <input class="form-control" type="text" name="apellido" id="apellido" placeholder="Ingrese Apellido" >
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="telefono">Telefono:</label>
                            <input class="form-control" type="text" name="telefono" id="telefono" placeholder="Ingrese Teléfono" >
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="direccion">Dirección:</label>
                            <input class="form-control" type="text" name="direccion" id="direccion" placeholder="Ingrese Dirección" >
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input class="form-control" type="email" name="email" id="email" placeholder="Ingrese Email" >
                        </div>
                    </div>
                    {{-- <div class="col-md-6">
                        <div class="form-group">
                            <label for="nombre">Estado:</label>
                            <select class="form-control" name="estado" id="estado">
                                <option value="true">Activo</option>
                                <option value="false">Inactivo</option>
                            </select>

                            
                        </div>
                    </div> --}}
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary w-25 float-right">
                        <i class="fas fa-solid fa-plus mr-2"></i> Agregar
                    </button>
                </div>
            </form>

        </div>
    </div>

@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    <link rel="stylesheet" href="/css/admin_custom.css">
    <style>
        .content-wrapper {
            background-color: #dcedc8 /* Cambia este color al que prefieras */
        }
    </style>
    
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop

