<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use Illuminate\Http\Request;


class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = Cliente::where('estado', 1)->get();
        return view('admin.cliente.index',compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        return view('admin.cliente.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validar = $request->validate([
            'persona_id' => 'required|exists:persona,id',
            'propiedad_id' => 'nullable|exists:propiedad,id',
            'institucion' => 'nullable|string|max:255',
            'nit' => 'required|string|max:255',
        ]);

        // Crear una nueva instancia del modelo y guardar los datos
        $cliente = new Cliente() ;
        $cliente->persona_id = $validar['persona_id'];
        $cliente->propiedad_id = $validar['propiedad_id'];
        $cliente->institucion = $validar['institucion'];
        $cliente->nit = $validar['nit'];
        $cliente->save();

        // Redirigir a una página o mostrar un mensaje de éxito
        return redirect()->route('admin.cliente.index')->with('success', 'Cliente creado correctamente.');

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
    public function edit(Cliente $cliente)
    {
        
        return view('admin.cliente.edit', compact('cliente'));
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
        // $validar = $request->validate([
        // 'persona_id' => 'required',
        // 'propiedad_id' => 'required',
        // 'institucion' => 'required|string|max:255',
        // 'nit' => 'required|string|max:255',
        // ]);

        /// ------- AL BORRAR EL CONTENIDO DEL INPUT QUE NO MARQUE NINGUN VALOR, QUE DESACTIVE EL QUE VIENE POR DFECTO DEL REGISTRO---- REHACER EL INPUT BUSCAR EDITAR, AL IGUAL EN CREATE
        
        $request->validate([  
                'persona_id' => 'required|exists:persona,id',
                'propiedad_id' => 'nullable|required|exists:propiedad,id',
                'institucion' => 'nullable|required|string|max:100',
                'nit' => 'required|string|max:30',
        ]);
        // $cliente = Cliente::findOrFail($id);
        // $cliente->update($validar);
            
        $cliente = Cliente::findOrFail($id);
        $datos = $request->only(['persona_id', 'propiedad_id',
                                'institucion', 'nit'
                                ]);
        $cliente->update($datos);
        return redirect()->route('admin.cliente.index')->with('success', 'Cliente actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $cliente = Cliente::findOrFail($id);
            $cliente->estado = 0;
            // Guardar los cambios en la base de datos
            $cliente->save();
            return redirect()->route('admin.cliente.index')->with('success', 'Cliente Eliminado exitosamente');
        } 
        catch (\Exception $e) {
            return redirect()->route('admin.cliente.index')->with('error', 'Hubo un problema al eliminar el cliente');
        }
    }

}
