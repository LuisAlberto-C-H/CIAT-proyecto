@extends('layouts.app')

@section('contenido')

<div class="py-4 d-flex justify-content-end"> 
</div>

<div class="card">
    {{-- #28b463 --}}
    <div class="card-header" style="background-color:#558b2f ">
        <div class="d-flex justify-content-center text-white">
            <h2>Agregar Nueva Propiedad</h2>
        </div>
    </div>

    <div class="card-body" style="background-color:  #e6e6e6">

        <form action="{{ route('admin.propiedad.store') }}" method="POST">
            @csrf
            
            <div class="row">
                <div class="col-6">
                    <label for="municipio_id">Municipio Perteneciente:</label>

                    <select name="municipio_id" id="" class="form-control">
                        <option value="" hidden selected>Seleccionar al municipio perteneciente...</option>
                        @foreach ($municipios as $municipio)
                            <option value="{{ $municipio->id }}">{{ $municipio->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label for="direccion">Dirección de la Propiedad:</label>
                        <input class="form-control" type="text" name="direccion" id="direccion" placeholder="Ingrese la dirección de la propiedad" >
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="nombre">Nombre de la Propiedad:</label>
                        <input class="form-control" type="text" name="nombre" id="nombre" placeholder="Ingrese el nombre de la propiedad" >
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label for="desmonte">Fecha de Desmonte de la Propiedad:</label>
                        <input class="form-control" type="date" name="desmonte" id="desmonte">
                    </div>
                </div>
            
            </div>

            <div class=" mt-4 form-group" >
                <button type="submit" class="btn btn-primary w-25 float-right">
                    <i class="fas fa-solid fa-plus mr-2"></i> Agregar
                </button>
            </div>

        </form>

    </div>
</div>


@endsection