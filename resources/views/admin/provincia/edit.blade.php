@extends('layouts.app')

@section('contenido')

<div class="py-4 d-flex justify-content-end"> 
</div>

<div class="card">
    {{-- #28b463 --}}
    <div class="card-header" style="background-color:#558b2f ">
        <div class="d-flex justify-content-center text-white">
            <h2>EDITAR PROVINCIA</h2>
        </div>
    </div>

    <div class="card-body" style="background-color:  #e6e6e6">

        <form action="{{ route('admin.provincia.update',$provincia) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="">
                
                <div class="">
                    <label for="departamento_id">Departament:</label>
                    <select name="departamento_id" id="" class="form-control">

                        {{-- <option value="" hidden selected>Seleccionar país perteneciente...</option> --}}

                        @foreach ($departamentos as $departamento)
                            <option value="{{ $departamento->id }}" {{ $provincia->departamento_id == $departamento->id ? 'selected' : '' }}>{{ $departamento->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="">
                    <div class="form-group">
                        <label for="nombre">Nombre:</label>
                        <input class="form-control" type="text" name="nombre" id="nombre" value="{{ $provincia->nombre }}" placeholder="Ingrese el nombre de la Provincia..." >
                    </div>
                </div>

                {{-- <div class="">
                    <div class="form-group">
                        <label for="estado">Estado:</label>

                        <select class="form-control" name="estado" id="estado">
                            <option value= "1" <?php if ($provincia->estado == 1) echo 'selected'; ?>>Activado</option>
                            <option value= "0" <?php if ($provincia->estado == 0) echo 'selected'; ?>>Inactivo</option>
                        </select>
                    </div>
                </div> --}}
            </div>

            <div class=" mt-4 form-group" >
                <button type="submit" class="btn btn-primary w-25 float-right">
                    <i class="mr-2"></i> Actualizar
                </button>
            </div>

        </form>

    </div>
</div>

@endsection