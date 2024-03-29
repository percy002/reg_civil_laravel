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
    public function __construct()
    {
        $this->middleware(['permission:editor|administrador'])->except('index');
    }
    public function index()
    {
        //
        $acta_matrimonios = DB::table('acta_matrimonios')
            ->LeftJoin('personas as novio', 'acta_matrimonios.fk_id_novio', '=', 'novio.id')
            ->leftJoin('personas as novia', 'acta_matrimonios.fk_id_novia', '=', 'novia.id')
            ->select(
                DB::raw("CONCAT_WS('',novio.dni,'-',novio.apellido_paterno,' ',novio.apellido_materno,' ',novio.nombres) as novio"),
                DB::raw("CONCAT_WS('',novia.dni,'-',novia.apellido_paterno,' ',novia.apellido_materno,' ',novia.nombres) as novia"), 'acta_matrimonios.*',DB::raw("(DATE_FORMAT(acta_matrimonios.fecha_registro,'%d/%m/%Y')) as fecha_registro_format"),DB::raw("(DATE_FORMAT(acta_matrimonios.fecha_matrimonio,'%d/%m/%Y')) as fecha_matrimonio_format"))
                ->get();
        // return Response::json($acta_defunciones);
        return view('actas.acta_matrimonio.show',compact("acta_matrimonios"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('actas.acta_matrimonio.create');
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
            $nombre_archivo="Acta_matri-".$request->dni_novio."-".
            $request->dni_novia."-".
            \strtotime(Carbon::now()).
            ".".$archivo->guessExtension();

            $url_path="public/actas/Actas_Matrimonios";
            $file = $request->file("archivo")->storeAs($url_path,$nombre_archivo);
            // dd($file);
        }
        //buscar_novio si ya exise persona
        $buscar_novio = Persona::where("dni", $request->dni_novio)->where("dni", "<>", null)->first();

        $buscar_novia = Persona::where("dni", $request->dni_novia)->where("dni", "<>", null)->first();

        if ($buscar_novio) {
            //si persona ya existe            
            $id_novio = $buscar_novio->id;
        } else {
            //si persona no existe
            //agregar nueva persona
            $novio = new Persona();
            $novio->dni=$request->dni_novio;
            $novio->nombres=$request->nombres_novio;
            $novio->apellido_paterno=$request->apellido_paterno_novio;
            $novio->apellido_materno=$request->apellido_materno_novio;
            $novio->save();
            $id_novio = $novio->id;
        }
        if ($buscar_novia) {
            # si persona ya existe
            $id_novia = $buscar_novia->id;
        } else {
            //si persona no existe
            //agregar nueva persona
            $novia = new Persona();
            $novia->dni=$request->dni_novia;
            $novia->nombres=$request->nombres_novia;
            $novia->apellido_paterno=$request->apellido_paterno_novia;
            $novia->apellido_materno=$request->apellido_materno_novia;
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

            $nueva_acta->rectificado = $request->rectificado == 1? 1:0;
            $nueva_acta->archivo = 'storage/actas/Actas_Matrimonios/'.$nombre_archivo;
            if ($nueva_acta->save()) {
                // return $nueva_acta;
                return redirect('/acta_matrimonio');
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
        //mostrar formulario update
        $acta_matrimonio = Acta_Matrimonio::findOrFail($id);

        return view('actas.acta_matrimonio.update',compact('acta_matrimonio'));      
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
        //agregar el archivo
        $file = "";
        $nombre_archivo=$request->old_archivo;
        if ($request->hasFile('archivo')) {
            //nombre del archivo
            $archivo = $request->file('archivo');
            $nombre_archivo="Acta_nac-".$request->dni."-".
            $request->apellido_paterno."-".
            $request->apellido_materno."-".
            $request->nombres."-".
            \strtotime(Carbon::now()).
            ".".$archivo->guessExtension();

            $url_path="public/actas/Actas_Defunciones";
            $file = $request->file("archivo")->storeAs($url_path,$nombre_archivo);
            // dd($file);
            $nombre_archivo='storage/actas/Actas_Defunciones/'.$nombre_archivo;
        }
        //modificar novio
        $novio = Persona::find($request->id_novio);
        $novio->nombres = $request->nombres_novio;
        $novio->apellido_paterno = $request->apellido_paterno_novio;
        $novio->apellido_materno = $request->apellido_materno_novio;

        // dd($novio);
        $novio->update();


        //modificar novia
        $novia = Persona::find($request->id_novia);
        $novia->nombres = $request->nombres_novia;
        $novia->apellido_paterno = $request->apellido_paterno_novia;
        $novia->apellido_materno = $request->apellido_materno_novia;
        $novia->update();

        //modificar acta de matrimonio 
         $acta_matrimonio = Acta_Matrimonio::find($id);
         $acta_matrimonio->fk_id_novio = $novio->id;
         $acta_matrimonio->fk_id_novia = $novia->id;
         $acta_matrimonio->libro = $request->libro;
         $acta_matrimonio->acta = $request->acta;
         $acta_matrimonio->fecha_registro = Carbon::parse($request->fecha_registro)->format("Y-m-d");
         $acta_matrimonio->fecha_matrimonio = $request->fecha_matrimonio == null ? NULL : Carbon::parse($request->fecha_matrimonio)->format("Y-m-d");
 
         $acta_matrimonio->rectificado = $request->rectificado == 1? 1:0;
         $acta_matrimonio->archivo = $nombre_archivo;
 
         $acta_matrimonio->update();
 
        //  return $acta_matrimonio;
        return redirect('/acta_matrimonio');
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
