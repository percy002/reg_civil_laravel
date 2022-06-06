<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Acta_Defuncion;
use App\Models\Acta_Nacimiento;
use App\Models\Persona;
use Response;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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
        $acta_defunciones=DB::table('acta_defuncions')
        ->LeftJoin('personas','acta_defuncions.fk_id_fallecido','=','personas.id')
        ->select(DB::raw("CONCAT(personas.dni,'-',personas.apellido_paterno,'-',personas.apellido_materno,'-',personas.nombres) as fallecido"),'personas.sexo', 'acta_defuncions.*')
        ->get();;
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
        //buscar si ya exise persona
        $buscar = Persona::where("dni",$request->persona["dni"])->where("dni","<>",null)->first();
        
        if($buscar){
            //si persona ya existe
            $idPersona = $buscar->id;
        }
        else{
            //si persona no existe
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

        //verificar existencia del acta
        // $existePersona=Persona::where('dni','=',$idPersona);
        $existe_acta=Acta_Defuncion::where('fk_id_fallecido','<>', null)->where("fk_id_fallecido",$idPersona)->first();
        // return gettype($existe_acta);
        if ($idPersona && $existe_acta==null) {
            //agregar nueva acta de defuncion
            $nueva_acta = new Acta_defuncion();
            $nueva_acta->fk_id_fallecido = $idPersona;
            $nueva_acta->libro = $request->libro;
            $nueva_acta->acta = $request->acta;
            $nueva_acta->fecha_registro = Carbon::parse($request->fecha_registro)->format("Y-m-d");
            $nueva_acta->fecha_defuncion = $request->fecha_defuncion==null? NULL: Carbon::parse($request->fecha_defuncion)->format("Y-m-d");
            // return $nueva_acta;
            // dd($nueva_acta);
            $nueva_acta->rectificado = $request->rectificado;
            $nueva_acta->archivo = $request->archivo;
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
        $acta_defuncion=Acta_Defuncion::find($id);
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
