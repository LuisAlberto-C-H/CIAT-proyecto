<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Departamento;
use App\Models\Provincia;
use Illuminate\Http\Request;

class ProvinciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $provincias = Provincia::all();
        return view('admin.provincia.index', compact('provincias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departamentos = Departamento::all();
        return view('admin.provincia.create', compact('departamentos'));
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
            'departamento_id' => 'required',
            'nombre' => 'required',
        ]);
    
        Provincia::create($request->all());
        return redirect()->route('admin.provincia.index');
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
    public function edit(Provincia $provincia)
    {
        $departamentos = Departamento::all();
        return view('admin.provincia.edit',compact('provincia','departamentos'));
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
            'departamento_id' => 'required|exists:departamento,id',
            'nombre' => 'required|string|max:255',
            // 'estado' => 'required|boolean'
        ]);
        $provincia = Provincia::findOrFail($id);
        // $provincia->estado = $request->input('estado') ? 1 : 0;
        // $provincia->save();
        
        $datos = $request->only(['departamento_id', 'nombre']);

        $provincia->update($datos);

        return redirect()->route('admin.provincia.index')->with('success', 'Provincia actualizada correctamente.');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $provincia = Provincia::findOrFail($id);
        $provincia->delete();
        return redirect()->route('admin.provincia.index');
    }
}
