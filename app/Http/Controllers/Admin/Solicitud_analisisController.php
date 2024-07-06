<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\Gestion;
use App\Models\Solicitud_analisis;
use Illuminate\Http\Request;

class Solicitud_analisisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $solicitudes_analisis = Solicitud_analisis::all();
        return view('admin.solicitud_analisis.index', compact('solicitudes_analisis'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $gestiones = Gestion::where('estado', 1)->get();
        return view('admin.solicitud_analisis.create', compact('gestiones'));
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
            'cliente_id' => 'required',
            'gestion_id' => 'required',
            'glosario' => 'required',
            'fecha_muestreo' => 'required',
            'cultivo_anterior' => 'required',
            'cultivo_actual' => 'required',
            'lugar_muestreo' => 'required',
        ]
        , [
            'cliente_id.required' => 'El campo Nombre_del_cliente es obligatorio.',
            'gestion_id.required' => 'El campo Gestión es obligatorio.',
            'glosario.required' => 'El campo Descripción es obligatorio.',
            
        ]);
        
        $datos = $request->only([
            'cliente_id',
            'gestion_id',
            'glosario',
            'fecha_muestreo',
            'cultivo_anterior',
            'cultivo_actual',
            'lugar_muestreo'
        ]);

        Solicitud_analisis::create($datos);
        // return view('admin.solicitud_analisis.index')->with('message', 'La Solicitud de análisis fue creado con éxito...');
        return redirect()->route('admin.solicitud_analisis.index')->with('message', 'La solicitud de análisis ha sido creada exitosamente.');
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

    public function buscarCliente(Request $request)
    {
        $query = $request->get('query');
        $clientes = Cliente::with(['persona', 'propiedad'])
            ->where('estado', '!=', 0)
            ->whereHas('persona', function($q) use ($query) {
                $q->where('nombre', 'LIKE', "%{$query}%")
                  ->orWhere('apellido', 'LIKE', "%{$query}%");
            })
            ->get();

        $clientes = $clientes->map(function($cliente) {
            $cliente->propiedad_nombre = $cliente->propiedad ? $cliente->propiedad->nombre : 'sin propiedad';
            return $cliente;
        });

        return response()->json($clientes);
    }
}