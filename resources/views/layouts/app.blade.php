@extends('adminlte::page')

@section('title', 'CIAT')

{{-- @section('content_header')
    <h1>Panel Administrativo</h1>
@stop --}}

@section('content')
    @yield('contenido')
@stop

@section('css')
    {{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> --}}
    
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
    
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
    <style>
        .content-wrapper {
            background-color: #dcedc8 /* Cambia este color al que prefieras */
        }

        /* --------Personalizar Toast-------*/
        /* Personaliza el ancho del toast */
        #toast-container > .toast {
            width: 400px; /* Puedes ajustar este valor según tus necesidades */
        }

        /* Personaliza el tamaño de la fuente */
        #toast-container > .toast-success {
            font-size: 18px; /* Puedes ajustar este valor según tus necesidades */
        }

        /* Personaliza la duración del toast */
        #toast-container > .toast-success .toast-message {
            font-size: 18px; /* Aumenta el tamaño del texto */
            word-wrap: break-word;
            white-space: normal;
        }

    </style>
@stop

@section('js')
    {{-- --------JQuery----------}}
    {{-- <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script> --}}
    {{-----------Select2--------}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}

    <script> console.log("Hi hol, I'm using the Laravel-AdminLTE package!"); </script>
@stop

