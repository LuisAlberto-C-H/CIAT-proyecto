<?php

use App\Http\Controllers\Admin\ArticuloController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\PersonaController;
use App\Http\Controllers\Admin\ClienteController;
use App\Http\Controllers\Admin\DepartamentoController;
use App\Http\Controllers\Admin\GestionController;
use App\Http\Controllers\Admin\MunicipioController;
use App\Http\Controllers\Admin\PaisController;
use App\Http\Controllers\Admin\PropiedadController;
use App\Http\Controllers\Admin\ProvinciaController;
use App\Http\Controllers\Admin\Solicitud_analisisController;
use App\Http\Controllers\Admin\Tipo_analisisController;

// Route::get('', function () {
//     return "Hola a todos adminis";
// });

Route::get('', [HomeController::class, 'index']);

Route::resource('personas', PersonaController::class)->names('admin.persona');
Route::resource('clientes', ClienteController::class)->names('admin.cliente');
Route::resource('paises', PaisController::class)->names('admin.pais');
Route::resource('departamentos', DepartamentoController::class )->names('admin.departamento');
Route::resource('provincias', ProvinciaController::class )->names('admin.provincia');
Route::resource('municipios', MunicipioController::class)->names('admin.municipio');
Route::resource('propiedades', PropiedadController::class)->names('admin.propiedad');

Route::get('/buscar-propiedades', [PropiedadController::class, 'buscar']);
Route::get('/buscar-personas', [PersonaController::class, 'buscar']);

Route::resource('gestiones', GestionController::class)->names('admin.gestion');
Route::resource('solicitud_analisis', Solicitud_analisisController::class)->names('admin.solicitud_analisis');

Route::get('/buscar-cliente', [Solicitud_analisisController::class, 'buscarCliente'])->name('buscar.clientes');
Route::resource('tipo_analisis', Tipo_analisisController::class)->names('admin.tipo_analisis');
Route::resource('articulos', ArticuloController::class)->names('admin.articulo');
