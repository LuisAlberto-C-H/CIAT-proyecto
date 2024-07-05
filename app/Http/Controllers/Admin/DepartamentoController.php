<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Departamento;
use App\Models\Pais;
use Illuminate\Http\Request;

class DepartamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $departamentos = Departamento::all();
        return view('admin.departamento.index', compact('departamentos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $paises = Pais::all();
        return view('admin.departamento.create', compact('paises'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   $request->validate([
        'nombre' => 'required',
        'pais_id' => 'required',
        // 'estado' => 'required|boolean'
    ]);

        // $data = $request->only(['nombre', 'pais_id']);
        // $data['estado'] = $request->input('estado') ? 1 : 0;
        Departamento::create($request->all());

        return redirect()->route('admin.departamento.index');
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
    public function edit(Departamento $departamento)
    {   
        $paises = Pais::all();
        return view('admin.departamento.edit',compact('departamento','paises'));
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
            'pais_id' => 'required|exists:pais,id',
            'nombre' => 'required|string|max:255',
            // 'estado' => 'required|boolean'
        ]);
        $departamento = Departamento::findOrFail($id);
        // $departamento->estado = $request->input('estado') ? 1 : 0;
        // $departamento->save();
        
        $datos = $request->only(['pais_id', 'nombre', 'estado']);

        $departamento->update($datos);

        return redirect()->route('admin.departamento.index')->with('success', 'Departamento actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $departamento = Departamento::findOrFail($id);
        $departamento->delete();
        return redirect()->route('admin.departamento.index');
    }
}
