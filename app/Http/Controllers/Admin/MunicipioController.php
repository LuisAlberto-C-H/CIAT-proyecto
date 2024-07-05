<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Departamento;
use App\Models\Municipio;
use App\Models\Provincia;
use Illuminate\Http\Request;

class MunicipioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $municipios = Municipio::all();
        $provincias = Provincia::all();
        return view('admin.municipio.index', compact('municipios','provincias'));

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
            'provincia_id' => 'required',
            'nombre' => 'required',
        ]);

        Municipio::create($request->all());
        return redirect()->route('admin.municipio.index');
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
            'provincia_id' => 'required|exists:provincia,id',
            'nombre' => 'required|string|max:255',
            // 'estado' => 'required|boolean'
        ]);
        $municipio = Municipio::findOrFail($id);
        // $municipio->estado = $request->input('estado') ? 1 : 0;
        // $municipio->save();
        
        $datos = $request->only(['provincia_id', 'nombre']);

        $municipio->update($datos);

        return redirect()->route('admin.municipio.index')->with('success', 'Municipio actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $municipio = Municipio::findOrFail($id);
        $municipio->delete();
        return redirect()->route('admin.municipio.index');
    }
}
