<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Acta_Nacimiento;
use Response;
use App\Models\Persona;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class acta_nacimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //mostrar todas las actas de nacimiento
        $acta_nacimiento=Acta_Nacimiento::all();
        return Response::json($acta_nacimiento);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //mostrar todas las actas de nacimiento

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        //buscar_novio si ya exise persona
        $personas_not_null=Persona::where("dni", "<>", null)->get();
        $buscar_padre = $personas_not_null->where("dni", $request->padre["dni"])->where("dni", "<>", null)->first();
       
        $buscar_madre = $personas_not_null->where("dni", $request->madre["dni"])->where("dni", "<>", null)->first();

        $buscar_nacido = $personas_not_null->where("dni", $request->nacido["dni"])->where("dni", "<>", null)->first();

        if ($buscar_padre) {
            //si persona ya existe            
            $id_padre = $buscar_padre->id;
        } else {
            //si persona no existe
            //agregar nueva persona
            $padre = new Persona($request->padre);
            $padre->save();
            $id_padre = $padre->id;
        }
        if ($buscar_madre) {
            # si persona ya existe
            $id_madre = $buscar_madre->id;
        } else {            
            //si persona no existe
            //agregar nueva persona
            $madre = new Persona($request->madre);
            $madre->save();
            $id_madre = $madre->id;
        }
        if ($buscar_nacido) {
            # si persona ya existe
            $id_nacido = $buscar_nacido->id;
        }
        else{
            //si persona no existe
            //agregar nueva persona
            $nacido = new Persona($request->nacido);
            $nacido->save();
            $id_nacido = $nacido->id;
        }
        // return "llegaste";
        //verificar existencia del acta
        $existe_acta = Acta_Nacimiento::where('fk_id_nacido', $id_nacido)->first();

        if (($id_padre || $id_madre || $id_nacido) && $existe_acta == null) {
            
            //agregar nueva acta de defuncion
            $nueva_acta = new Acta_Nacimiento();
            $nueva_acta->fk_id_nacido = $id_nacido;
            $nueva_acta->fk_id_padre = $id_padre;
            $nueva_acta->fk_id_madre = $id_madre;
            $nueva_acta->libro = $request->libro;
            $nueva_acta->acta = $request->acta;
            $nueva_acta->fecha_registro = Carbon::parse($request->fecha_registro)->format("Y-m-d");
            $nueva_acta->fecha_nacimiento = $request->fecha_nacimiento == null ? NULL : Carbon::parse($request->fecha_nacimiento)->format("Y-m-d");

            $nueva_acta->rectificado = $request->rectificado;
            $nueva_acta->archivo = $request->archivo;
            if ($nueva_acta->save()) {
                // return $nueva_acta;
                return Response::json(array('success' => true, "mensaje" => "Acta Agregada Correctamente"), 201);
            } else {
                return Response::json(array('success' => true, "mensaje" => "No se pudo agrega Acta"), 200);
            }
        } else {
            return Response::json(array('success' => true, 'mensaje' => "ya existe acta"), 200);
        }
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
