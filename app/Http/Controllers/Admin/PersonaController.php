<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Persona;
use Illuminate\Http\Request;

class PersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $personas = Persona::all();
        // return $persona;
        return view('admin.persona.index', compact('personas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.persona.create');
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
            'nombre' => 'required',
            'apellido' => 'required',
            'telefono' => 'required',
            'direccion' => 'required',
            'email' => 'required|email',
        ]);

        Persona::create($request->all());
        return redirect()->route('admin.persona.index')->with('success', 'Persona creada correctamente');
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
    public function edit(Persona $persona)
    {
        return view('admin.persona.edit', compact('persona'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Persona $persona)
    {
        $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'telefono' => 'required',
            'direccion' => 'required',
            'email' => 'required|email',
            // 'estado' => 'required|boolean',
        ]);

        // $persona->estado = $request->input('estado') ? 1 : 0; // Asegúrate de que es 0 o 1
        // $persona->save();

        $persona->update($request->all());
        return redirect()->route('admin.persona.index'); //agregamos una session WIDTH('info')
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Persona $persona)
    {
        $persona->delete();
        return redirect()->route('admin.persona.index');
    }

    // public function buscar(Request $request)
    // {
    //     $term = $request->input('term');
    //     $personas = Persona::where('nombre', 'LIKE', '%' . $term . '%')->get();

    //     return response()->json($personas);
    // }
    public function buscar(Request $request)
    {
        $term = $request->input('term');
        $personas = Persona::where('nombre', 'LIKE', '%' . $term . '%')
            ->orWhere('apellido', 'LIKE', '%' . $term . '%')
            ->get();

        return response()->json($personas);
    }


}
