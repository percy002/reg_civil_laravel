<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Acta_Defuncion;
use App\Models\Acta_Nacimiento;
use App\Models\Persona;
use Response;
use Carbon\Carbon;

class acta_defuncionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $acta_defunciones=Acta_Defuncion::all();
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
        $buscar = Persona::where("dni",$request->persona["dni"])->first();
        // return $buscar->id;
        $idPersona=0;
        if($buscar){
            $idPersona = $buscar->id;
        }
        else{
            
            //agregar nueva persona
            $persona = new Persona();
            $persona->dni = $request->persona["dni"];
            $persona->nombres = $request->persona["nombres"];
            $persona->apellido_paterno = $request->persona["apellido_paterno"];
            $persona->apellido_materno = $request->persona["apellido_materno"];
            $persona->sexo = $request->persona["sexo"];
    
            // return $persona;
            $persona->save();
            $idPersona = $persona->id;
        }

        $existe_acta=Acta_Defuncion::whereNotIn('fk_id_fallecido', 'null')->where("fk_id_fallecido",$idPersona)->first();
        // return gettype($existe_acta);
        if ($idPersona && $existe_acta==null) {
            //agregar nueva acta de defuncion
            $nueva_acta = new Acta_defuncion();
            $nueva_acta->fk_id_fallecido = $idPersona;
            $nueva_acta->libro = $request->libro;
            $nueva_acta->acta = $request->acta;
            $nueva_acta->fecha_registro = Carbon::parse($request->fecha_registro)->format("Y-m-d");
            $nueva_acta->fecha_defuncion = $request->fecha_defuncion==null? NULL: $request->fecha_defuncion->format("Y-m-d");
            $nueva_acta->archivo = $request->archivo;
            $nueva_acta->rectificado = $request->rectificado;
            if ($nueva_acta->save()) {
                return $nueva_acta;
                // return Response::json(array('success' => true), 200);
            }
            else
            {
                // return "el acta ya existe";
                return "no se puso guardar esta Acta";
                // return Response::json(array('success' => false), 204);
            }
        }
        else
        {
            return Response::json(array('success' => true,'mensaje'=>"ya existe acta"), 200);
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
