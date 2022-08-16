<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Acta_Defuncion;
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
    // private $file="";
    public function index()
    {
        //
        $acta_defunciones = DB::table('acta_defuncions')
            ->LeftJoin('personas', 'acta_defuncions.fk_id_fallecido', '=', 'personas.id')
            ->select(DB::raw("CONCAT_WS('',personas.dni,'-',personas.apellido_paterno,'-',personas.apellido_materno,'-',personas.nombres) as fallecido"), 'personas.sexo', 'acta_defuncions.*',DB::raw("(DATE_FORMAT(acta_defuncions.fecha_defuncion,'%m/%d/%y')) as fecha_fallecimiento_format"),DB::raw("(DATE_FORMAT(acta_defuncions.fecha_registro,'%m/%d/%y')) as fecha_registro_format"))
            ->get();

        return view('actas.acta_defuncion.show',compact("acta_defunciones"));
        // return Response::json($acta_defunciones);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('actas.acta_defuncion.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //agregar el archivo
        $file = "";
        $nombre_archivo="";
        if ($request->hasFile('archivo')) {
            //nombre del archivo
            $archivo = $request->file('archivo');
            $nombre_archivo="Acta_nac-".$request->dni."-".
            $request->apellido_paterno."-".
            $request->apellido_materno."-".
            $request->nombres."-".
            $request->fecha_registro.
            ".".$archivo->guessExtension();

            $url_path="public/actas/Actas_Defunciones";
            $file = $request->file("archivo")->storeAs($url_path,$nombre_archivo);
            // dd($file);
        }
        //buscar si ya exise persona
        $buscar = Persona::where("dni", $request->dni)->where("dni", "<>", null)->first();

        if ($buscar) {
            //si persona ya existe
            $idPersona = $buscar->id;
        } else {
            //si persona no existe
            //agregar nueva persona
            $persona = new Persona();
            $persona->dni = $request->dni;
            $persona->nombres = $request->nombres;
            $persona->apellido_paterno = $request->apellido_paterno;
            $persona->apellido_materno = $request->apellido_materno;
            $persona->sexo = $request->sexo;

            // return $persona;
            $persona->save();
            $idPersona = $persona->id;
        }

        //verificar existencia del acta
        $existe_acta = Acta_Defuncion::where('fk_id_fallecido', '<>', null)->where("fk_id_fallecido", $idPersona)->first();

        if ($idPersona && $existe_acta == null) {
            //agregar nueva acta de defuncion
            $nueva_acta = new Acta_defuncion();
            $nueva_acta->fk_id_fallecido = $idPersona;
            $nueva_acta->libro = $request->libro;
            $nueva_acta->acta = $request->acta;
            $nueva_acta->fecha_registro = Carbon::parse($request->fecha_registro)->format("Y-m-d");
            $nueva_acta->fecha_defuncion = $request->fecha_defuncion == null ? NULL : Carbon::parse($request->fecha_defuncion)->format("Y-m-d");

            $nueva_acta->rectificado = $request->rectificado;
            $nueva_acta->archivo = 'storage/actas/Actas_Defunciones/'.$nombre_archivo;
            if ($nueva_acta->save()) {
                // return $nueva_acta;
                // dd($nueva_acta);
                return redirect('/acta_defuncion');
                return Response::json(array('success' => true, "mensaje" => "Acta Agregada Correctamente"), 201);
            } else {
                return Response::json(array('success' => true, "mensaje" => "No se pudo agrega Acta"), 400);

            }
        } else {
            return Response::json(array('success' => true, 'mensaje' => "ya existe acta"), 400);
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
        return Response::json(array("acta"=> $acta_defuncion,"persona"=>$acta_defuncion->persona));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //mostrar formulario update
        $acta_defuncion = Acta_Defuncion::findOrFail($id);

        return view('actas.acta_defuncion.update',compact('acta_defuncion'));
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
        $persona = Persona::find($id);
        // $persona = $request->persona;
        $persona->nombres = $request->nombres;
        $persona->apellido_paterno = $request->apellido_paterno;
        $persona->apellido_materno = $request->apellido_materno;
        $persona->sexo = $request->sexo;
        $persona->update();


        $acta_defuncion = Acta_defuncion::find($id);
        $acta_defuncion->fk_id_fallecido = $persona->id;
        $acta_defuncion->libro = $request->libro;
        $acta_defuncion->acta = $request->acta;
        $acta_defuncion->fecha_registro = Carbon::parse($request->fecha_registro)->format("Y-m-d");
        $acta_defuncion->fecha_defuncion = $request->fecha_defuncion == null ? NULL : Carbon::parse($request->fecha_defuncion)->format("Y-m-d");

        $acta_defuncion->rectificado = $request->rectificado;
        $acta_defuncion->archivo = $request->archivo;

        $acta_defuncion->update();

        // return $acta_defuncion;
        return redirect('/acta_defuncion');

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
