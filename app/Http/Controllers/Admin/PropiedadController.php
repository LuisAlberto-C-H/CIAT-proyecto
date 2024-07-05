<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Municipio;
use App\Models\Propiedad;
use Illuminate\Http\Request;

class PropiedadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $propiedades = Propiedad::all();
        return view('admin.propiedad.index', compact('propiedades'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $municipios = Municipio::all();
        return view('admin.propiedad.create', compact('municipios'));
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
            'municipio_id' => 'required',
            'nombre' => 'required',
            'direccion' => 'required',
            'desmonte' => 'required'
        ]);
    
        Propiedad::create($request->all());
        return redirect()->route('admin.propiedad.index');
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
    public function edit( $id)
    {
        $propiedad = Propiedad::findOrFail($id);
        $municipios = Municipio::all();
        return view('admin.propiedad.edit',compact('propiedad','municipios'));
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
            'municipio_id' => 'required|exists:municipio,id',
            'nombre' => 'required|string|max:255',
            'direccion' => 'required',
            'desmonte' => 'required',
            // 'estado' => 'required|boolean'
        ]);
        $propiedad = Propiedad::findOrFail($id);
        // $propiedad->estado = $request->input('estado') ? 1 : 0;
        // $propiedad->save();
        
        $datos = $request->only(['municipio_id', 'nombre',
                                'direccion', 'desmonte']);

        $propiedad->update($datos);

        return redirect()->route('admin.propiedad.index')->with('success', 'Propiedad actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $propiedad = Propiedad::findOrFail($id);
        $propiedad->delete();
        return redirect()->route('admin.propiedad.index');
    }

    public function buscar(Request $request)
    {
        $term = $request->input('term');
        $propiedades = Propiedad::where('nombre', 'LIKE', '%' . $term . '%')->get();

        return response()->json($propiedades);
    }
    


}
