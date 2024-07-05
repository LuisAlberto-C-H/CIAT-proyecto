@extends('layouts.app')

@section('contenido')

<div class="py-4 d-flex justify-content-end"> 
</div>

<div class="card">

    <div class="card-header" style="background-color:#558b2f ">
        <div class="d-flex justify-content-center text-white">
            <h2>EDITAR CLIENTE</h2>
        </div>
    </div>

    <div class="card-body" style="background-color:  #e6e6e6">

        <form action="{{ route('admin.cliente.update', $cliente->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6 ">
                    <div class="form-group">
                        
                        <label for="persona_id">Buscar completo Nombre:</label>
                        <div class="input-container">
                            <input type="text" id="persona" name="persona" class="form-control" value="{{ $cliente->persona->nombre }} {{ $cliente->persona->apellido }}" autocomplete="off" placeholder="Buscar Nombre...">
                            <i class="fas fa-search"></i>
                        </div>

                        <input type="hidden" id="persona_id" name="persona_id" value="{{ $cliente->persona_id }}">
                        <div id="resultados_persona" class="list-group"></div>
                    </div>
                </div>

                <div class="col-md-6 ">
                    <div class="form-group">
                        <label for="propiedad">Buscar Propiedad:</label>
                        <div class="input-container">
                            <input type="text" id="propiedad" name="propiedad" class="form-control" value="{{ $cliente->propiedad->nombre ?? 'sin/propiedad' }}" autocomplete="off" placeholder="Buscar Propiedad...">
                            <i class="fas fa-search"></i>
                        </div>
    
                        <input type="hidden" id="propiedad_id" name="propiedad_id" value="{{ $cliente->propiedad_id }}">
                        <div id="resultados" class="list-group"></div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="institucion">Institucion</label>
                        <input type="text" name="institucion" id="institucion" class="form-control" value="{{ $cliente->institucion }}" placeholder="Ingrese nombre de Inst/ó dejar vacío">
                    </div>
                </div>

                <div class="col-md-6">

                    <div class="form-group">
                        <label for="cedula">NIT/CI:</label>
                        <input type="number" name="nit" id="nit" class="form-control" value="{{ $cliente->nit }}"placeholder="Ingrese número de NIT o CI" min="0">
                    </div>
                </div>
            </div>

            <div class=" mt-4 form-group" >
                <button type="submit" class="btn btn-primary w-25 float-right">
                    Actualizar
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('css')
    @parent
    {{-- <link rel="stylesheet" href="https://example.com/custom-style.css"> --}}
    <style>
        .input-container {
            position: relative;
            width: 100%;
        }
    
        .input-container input {
            width: 100%;
            padding-left: 40px; /* Espacio para el icono */
        }
    
        .input-container .fa-search {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: #aaa;
        }
    
        .list-group {
            margin-top: 10px;
            border: 1px solid #ccc;
            max-height: 200px;
            overflow-y: auto;
        }
    
        .list-group-item {
            cursor: pointer;
            padding: 10px;
        }
    
        .list-group-item:hover {
            background-color: #f0f0f0;
        }
    </style>
@stop

@section('js')
    @parent
    {{-- <script src="https://example.com/custom-script.js"></script> --}}
    
    <script>
        document.getElementById('propiedad').addEventListener('keyup', function() {
            let term = this.value.trim();
        
            if (term.length > 2) {
                fetch(`/admin/buscar-propiedades?term=${term}`)
                    .then(response => response.json())
                    .then(data => {
                        let resultados = document.getElementById('resultados');
                        resultados.innerHTML = '';
                        data.forEach(item => {
                            let div = document.createElement('div');
                            div.classList.add('list-group-item');
                            div.textContent = item.nombre;
                            div.setAttribute('data-id', item.id);
                            div.addEventListener('click', function() {
                                document.getElementById('propiedad').value = this.textContent;
                                document.getElementById('propiedad_id').value = this.getAttribute('data-id');
                                resultados.innerHTML = '';
                            });
                            resultados.appendChild(div);
                        });
                    });
            }
        });
    </script>

    <script>
        document.getElementById('persona').addEventListener('keyup', function() {
            let term = this.value.trim();
        
            if (term.length > 2) {
                fetch(`/admin/buscar-personas?term=${term}`)
                    .then(response => response.json())
                    .then(data => {
                        let resultados = document.getElementById('resultados_persona');
                        resultados.innerHTML = '';
                        data.forEach(item => {
                            let div = document.createElement('div');
                            div.classList.add('list-group-item');
                            div.textContent = `${item.nombre} ${item.apellido}`;
                            div.setAttribute('data-id', item.id);
                            div.addEventListener('click', function() {
                                document.getElementById('persona').value = this.textContent;
                                document.getElementById('persona_id').value = this.getAttribute('data-id');
                                resultados.innerHTML = '';
                            });
                            resultados.appendChild(div);
                        });
                    });
            }
        });
    </script>
@stop