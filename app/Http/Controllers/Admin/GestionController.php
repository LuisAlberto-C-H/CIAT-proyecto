<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gestion;
use Illuminate\Http\Request;
// use Illuminate\Validation\Rule;

class GestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $gestiones = Gestion::where('estado', 1)->orderBy('id', 'desc')->get();

        // Contador inicializado con el número total de registros
        $contador = $gestiones->count();

        // Agregar un contador descendente para mostrar el número consecutivo en orden descendente
        foreach ($gestiones as $gestion) {
            $gestion->contador = $contador;
            $contador--;
        }

        return view('admin.gestion.index', compact('gestiones'));
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
        // $request->validate([
        //     'nombre' => [
        //         'required',
        //         'integer',
        //         Rule::unique('gestion', 'nombre')->where(function ($query) {
        //             return $query->where('estado', 0);
        //         }),
        //     ],
        // ]);
        
        // $datos = $request->only(['nombre']);
        // Gestion::create($datos);

        // return redirect()->route('admin.gestion.index')->with('success', 'La Gestión fue creada exitosamente.');
        // return $request;

        // Validar los datos de entrada
        $request->validate([
            'nombre' => 'required|integer',
            // Otras validaciones para otros campos
        ]);

        // Verificar si existe un registro con el mismo nombre y estado = 1
        $registroExistente = Gestion::where('nombre', $request->nombre)
                                     ->where('estado', 1)
                                     ->first();

        if ($registroExistente) {
            // return response()->json(['message' => 'El registro con ese nombre ya existe'], 400);
            return redirect()->route('admin.gestion.index')->with(['message' => 'El registro con ese nombre ya existe'], 400);
        }

        // Verificar si existe un registro con el mismo nombre y estado = 0
        $registroConEstadoCero = Gestion::where('nombre', $request->nombre)
                                         ->where('estado', 0)
                                         ->first();

        if ($registroConEstadoCero) {
            // Crear un nuevo registro con estado = 1
            $nuevoRegistro = new Gestion();
            $nuevoRegistro->nombre = $request->nombre;
            // $nuevoRegistro->estado = 1;
            // Asignar otros campos si es necesario
            $nuevoRegistro->save();

            // return response()->json(['message' => 'Registro creado con estado 1 porque existía con estado 0.'], 201);
            return redirect()->route('admin.gestion.index')->with(['message' => 'Registro creado con estado 1 porque existía con estado 0.'], 201);
        }

        // Crear un nuevo registro normalmente
        $nuevoRegistro = new Gestion();
        $nuevoRegistro->nombre = $request->nombre;
        // $nuevoRegistro->estado = 1;
        // Asignar otros campos si es necesario
        $nuevoRegistro->save();

        // return response()->json(['message' => 'Registro creado exitosamente.'], 201);
        return redirect()->route('admin.gestion.index')->with(['message' => 'Registro creado exitosamente.'], 201);
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
        // $validarDatos = $request->validate([
        //     'nombre' => 'required|integer|unique:gestion,nombre,' . $id,
        // ]);
        
        // $gestion = Gestion::findOrFail($id);
        // $gestion->update($validarDatos);
        // return redirect()->route('admin.gestion.index');

        // Validar los datos de entrada
        $request->validate([
            'nombre' => 'required|integer',
            // Otras validaciones para otros campos
        ]);

        // Obtener el registro a actualizar
        $gestion = Gestion::findOrFail($id);

        // Verificar si existe otro registro con el mismo nombre y estado = 1
        $registroExistente = Gestion::where('nombre', $request->nombre)
                                     ->where('estado', 1)
                                     ->where('id', '!=', $id) // Excluir el registro actual
                                     ->first();

        if ($registroExistente) {
            return redirect()->route('admin.gestion.index')->with(['message' => 'El registro con ese nombre ya existe'], 400);
        }

        // Verificar si existe otro registro con el mismo nombre y estado = 0
        $registroConEstadoCero = Gestion::where('nombre', $request->nombre)
                                         ->where('estado', 0)
                                         ->where('id', '!=', $id) // Excluir el registro actual
                                         ->first();

        if ($registroConEstadoCero) {
            // Actualizar el registro actual y establecer estado = 1
            $gestion->nombre = $request->nombre;
            // $gestion->estado = 1; // Si necesitas cambiar el estado a 1
            // Asignar otros campos si es necesario
            $gestion->save();

            return redirect()->route('admin.gestion.index')->with(['message' => 'Registro actualizado con estado 1 porque existía con estado 0.'], 200);
        }

        // Actualizar el registro normalmente
        $gestion->nombre = $request->nombre;
        // Asignar otros campos si es necesario
        $gestion->save();

        return redirect()->route('admin.gestion.index')->with(['message' => 'Registro actualizado exitosamente.'], 200);
    
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
            $gestion = Gestion::findOrFail($id);
            $gestion->estado = 0;
            // Guardar los cambios en la base de datos
            $gestion->save();
            return redirect()->route('admin.gestion.index')->with('success', 'Cliente Eliminado exitosamente');
        } 
        catch (\Exception $e) {
            return redirect()->route('admin.cliente.index')->with('error', 'Hubo un problema al eliminar el cliente');
        }
    }
}
