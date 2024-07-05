@extends('layouts.app')

@section('contenido')

<div class="py-4 d-flex justify-content-end"> 
</div>

<div class="card">
    {{-- #28b463 --}}
    <div class="card-header" style="background-color:#558b2f ">
        <div class="d-flex justify-content-center text-white">
            <h2>AGREGAR NUEVO DEPARTAMENTO</h2>
        </div>
    </div>

    <div class="card-body" style="background-color:  #e6e6e6">

        <form action="{{ route('admin.departamento.store') }}" method="POST">
            @csrf
            
            <div class="">
                <div class="">
                    <label for="pais_id">Pais:</label>
                    <select name="pais_id" id="" class="form-control">
                        <option value="" hidden selected>Seleccionar país perteneciente...</option>
                        @foreach ($paises as $pais)
                            <option value="{{ $pais->id }}">{{ $pais->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="">
                    <div class="form-group">
                        <label for="nombre">Nombre:</label>
                        <input class="form-control" type="text" name="nombre" id="nombre" placeholder="Ingrese nombre del departamento" >
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