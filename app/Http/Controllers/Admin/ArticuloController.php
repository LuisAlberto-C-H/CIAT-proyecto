<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Articulo;
use App\Models\Tipo_analisis;
use Illuminate\Http\Request;

class ArticuloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $articulos = Articulo::all();
        $tipo_analisis = Tipo_analisis::where('estado', 1)->get();
        return view('admin.articulo.index', compact('articulos', 'tipo_analisis'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'tipo_analisis_id' => 'required',
            'nombre' => 'required',
            'precio' => 'required'
        ],
        [   
            'tipo_analisis_id.required' => 'El campo Tipo de análisis es obligatorio',
            'nombre.required' => 'El campo nombre de artículo es obligatorio.'
        ]);

        // Verificar si ya existe un registro con el mismo nombre y estado 1
        $existeArticulo = Articulo::where('nombre', $request->nombre)->where('estado', 1)->first();

        if ($existeArticulo) {
            return redirect()->route('admin.articulo.index')->withErrors(['nombre' => 'El nombre del artículo ya existe.']);
        }

        // Si no existe o el estado es 0, crear un nuevo registro
        Articulo::create($request->only(['nombre', 'precio', 'tipo_analisis_id']));

        return redirect()->route('admin.articulo.index')->with('message', 'El Artículo fue creado exitosamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
