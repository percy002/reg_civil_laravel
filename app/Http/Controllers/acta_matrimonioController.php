<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Acta_Matrimonio;
use App\Models\Persona;
use Response;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class acta_matrimonioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $acta_defunciones = DB::table('acta_matrimonios')
            ->LeftJoin('personas as novio', 'acta_matrimonios.fk_id_novio', '=', 'novio.id')
            ->leftJoin('personas as novia', 'acta_matrimonios.fk_id_novia', '=', 'novia.id')
            ->select(
                DB::raw("CONCAT_WS('',novio.dni,'-',novio.apellido_paterno,'-',novio.apellido_materno,'-',novio.nombres) as novio"),
                DB::raw("CONCAT_WS('',novia.dni,'-',novia.apellido_paterno,'-',novia.apellido_materno,'-',novia.nombres) as novia"), 'acta_matrimonios.*')
                ->get();
        return Response::json($acta_defunciones);
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
        // return $request;
        // $novia=new Persona($request->novia);
        // // $novia=$request->novia;
        // $novia->save();
        // return $novia;
        //buscar_novio si ya exise persona
        $buscar_novio = Persona::where("dni", $request->novio["dni"])->where("dni", "<>", null)->first();

        $buscar_novia = Persona::where("dni", $request->novia["dni"])->where("dni", "<>", null)->first();

        if ($buscar_novio) {
            //si persona ya existe            
            $id_novio = $buscar_novio->id;
        } else {
            //si persona no existe
            //agregar nueva persona
            $novio = new Persona($request->novio);
            $novio->save();
            $id_novio = $novio->id;
        }
        if ($buscar_novia) {
            # si persona ya existe
            $id_novia = $buscar_novia->id;
        } else {
            //si persona no existe
            //agregar nueva persona
            $novia = new Persona($request->novia);
            $novia->save();
            $id_novia = $novia->id;
        }
        // return "llegaste";
        //verificar existencia del acta
        $existe_acta = Acta_Matrimonio::where('fk_id_novio', $id_novio)->where("fk_id_novia", $id_novia)->first();

        if ($id_novio && $id_novia && $existe_acta == null) {
            //agregar nueva acta de defuncion
            $nueva_acta = new Acta_Matrimonio();
            $nueva_acta->fk_id_novio = $id_novio;
            $nueva_acta->fk_id_novia = $id_novia;
            $nueva_acta->libro = $request->libro;
            $nueva_acta->acta = $request->acta;
            $nueva_acta->fecha_registro = Carbon::parse($request->fecha_registro)->format("Y-m-d");
            $nueva_acta->fecha_matrimonio = $request->fecha_matrimonio == null ? NULL : Carbon::parse($request->fecha_matrimonio)->format("Y-m-d");

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
        $acta_matrimonio=Acta_Matrimonio::find($id);
        return Response::json(array("acta"=> $acta_matrimonio,"novio"=>$acta_matrimonio->novio,"novia"=> $acta_matrimonio->novia));
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
