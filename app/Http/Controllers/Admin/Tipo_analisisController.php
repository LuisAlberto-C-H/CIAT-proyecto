<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tipo_analisis;
use Illuminate\Http\Request;


class Tipo_analisisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $tipo_analisis = Tipo_analisis::where('estado', 1)->orderBy('id', 'desc')->get();
        return view('admin.tipo_analisis.index', compact('tipo_analisis'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('admin.tipo_analisis.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'nombre' => 'required|unique:tipo_analisis,nombre'
        // ],
        // [
        //     'nombre.required' => 'El campo Tipo de Análsis es obligatorio.',
        //     'nombre.unique' => 'El nombre del Tipo de Análisis ya existe.'
        // ]);

        // // Si la validación pasa, guarda el nombre en la base de datos
        // Tipo_analisis::create($request->only(['nombre']));

        // return redirect()->route('admin.tipo_analisis.index')->with('message', 'El Tipo de Análisis fue creado exitosamente.');
        // Validar que el nombre no esté vacío
        $request->validate([
            'nombre' => 'required'
        ],
        [
            'nombre.required' => 'El campo Tipo de Análisis es obligatorio.',
        ]);

        // Verificar si ya existe un registro con el mismo nombre y estado 1
        $existingTipoAnalisis = Tipo_analisis::where('nombre', $request->nombre)->where('estado', 1)->first();

        if ($existingTipoAnalisis) {
            return redirect()->route('admin.tipo_analisis.index')->withErrors(['nombre' => 'El nombre del Tipo de Análisis ya existe.']);
        }

        // Si no existe o el estado es 0, crear un nuevo registro
        Tipo_analisis::create($request->only(['nombre']));

        return redirect()->route('admin.tipo_analisis.index')->with('message', 'El Tipo de Análisis fue creado exitosamente.');
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
        $request->validate([
            'nombre' => 'required|unique:tipo_analisis,nombre,' . $id
        ],
        [
            'nombre.required' => 'El campo Tipo de Análisis es obligatorio.',
            'nombre.unique' => 'El nombre del Tipo de Análisis ya existe.'
        ]);
    
        // Encuentra el registro por su id y actualiza los datos
        $tipo_analisis = Tipo_analisis::findOrFail($id);
        $tipo_analisis->update($request->only(['nombre']));
    
        // Redirige a la página de índice con un mensaje de éxito
        return redirect()->route('admin.tipo_analisis.index')->with('message', 'El Tipo de Análisis fue actualizado exitosamente.');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tipo_analisis = Tipo_analisis::findOrFail($id);
        $tipo_analisis->estado = 0;
        $tipo_analisis->save();
    
        return redirect()->route('admin.tipo_analisis.index')
                        ->with('message', 'El Tipo de Análisis fue eliminado exiosamente.');
    
    }
}
