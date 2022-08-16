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
        $acta_nacimientos = DB::table('acta_nacimientos')
            ->LeftJoin('personas as nacido', 'acta_nacimientos.fk_id_nacido', '=', 'nacido.id')
            ->LeftJoin('personas as padre', 'acta_nacimientos.fk_id_padre', '=', 'padre.id')
            ->LeftJoin('personas as madre', 'acta_nacimientos.fk_id_madre', '=', 'madre.id')
            ->select(
                DB::raw("CONCAT_WS('',nacido.dni,'-',nacido.apellido_paterno,'-',nacido.apellido_materno,'-',nacido.nombres) as nacido"),
                DB::raw("CONCAT_WS('',padre.dni,'-',padre.apellido_paterno,'-',padre.apellido_materno,'-',padre.nombres) as padre"),
                DB::raw("CONCAT_WS('',madre.dni,'-',madre.apellido_paterno,'-',madre.apellido_materno,'-',madre.nombres) as madre"),
                'acta_nacimientos.*',
                'nacido.sexo as sexo',
                DB::raw("(DATE_FORMAT(acta_nacimientos.fecha_registro,'%m/%d/%y')) as fecha_registro_format"),
                DB::raw("(DATE_FORMAT(acta_nacimientos.fecha_nacimiento,'%m/%d/%y')) as fecha_nacimiento_format")
            )
            ->get();
        // return Response::json($acta_defunciones);
        return view('actas.acta_nacimiento.show',compact("acta_nacimientos"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //mostrar formulario
        return view('actas.acta_nacimiento.create');

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
        $personas_not_null = Persona::where("dni", "<>", null)->get();
        $buscar_padre = $personas_not_null->where("dni", $request->dni_padre)->where("dni", "<>", null)->first();

        $buscar_madre = $personas_not_null->where("dni", $request->dni_madre)->where("dni", "<>", null)->first();

        $buscar_nacido = $personas_not_null->where("dni", $request->ndni_acido)->where("dni", "<>", null)->first();

        if ($buscar_padre) {
            //si persona ya existe            
            $id_padre = $buscar_padre->id;
        } else {
            //si persona no existe
            //agregar nueva persona
            $padre = new Persona();
            $padre->dni=$request->dni_padre;
            $padre->nombres=$request->nombres_padre;
            $padre->apellido_paterno=$request->apellido_paterno_padre;
            $padre->apellido_materno=$request->apellido_materno_padre;
            $padre->save();
            $id_padre = $padre->id;
        }
        if ($buscar_madre) {
            # si persona ya existe
            $id_madre = $buscar_madre->id;
        } else {
            //si persona no existe
            //agregar nueva persona
            $madre = new Persona();
            $madre->dni=$request->dni_madre;
            $madre->nombres=$request->nombres_madre;
            $madre->apellido_paterno=$request->apellido_paterno_madre;
            $madre->apellido_materno=$request->apellido_materno_madre;
            $madre->save();
            $id_madre = $madre->id;
        }
        if ($buscar_nacido) {
            # si persona ya existe
            $id_nacido = $buscar_nacido->id;
        } else {
            //si persona no existe
            //agregar nueva persona
            $nacido = new Persona();
            $nacido->dni=$request->dni_nacido;
            $nacido->nombres=$request->nombres_nacido;
            $nacido->apellido_paterno=$request->apellido_paterno_nacido;
            $nacido->apellido_materno=$request->apellido_materno_nacido;
            $nacido->sexo=$request->sexo;
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
                return redirect('/acta_nacimiento');
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
        $acta_nacimiento = Acta_Nacimiento::find($id);
        return Response::json(array("acta" => $acta_nacimiento, "nacido" => $acta_nacimiento->nacido, "padre" => $acta_nacimiento->padre, "madre" => $acta_nacimiento->madre));
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
        $acta_nacimiento = Acta_Nacimiento::findOrFail($id);

        return view('actas.acta_nacimiento.update',compact('acta_nacimiento'));
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
        $nacido = Persona::find($request->id_nacido);
        $nacido->fill($request->nacido)->save();

        $padre = Persona::find($request->id_padre);
        $padre->fill($request->padre)->save();

        $madre = Persona::find($request->id_madre);
        $madre->fill($request->madre)->save();


        $acta_matrimonio = Acta_Nacimiento::find($id);
        $acta_matrimonio->fk_id_nacido = $nacido->id;
        $acta_matrimonio->fk_id_padre = $padre->id;
        $acta_matrimonio->fk_id_madre = $madre->id;
        $acta_matrimonio->libro = $request->libro;
        $acta_matrimonio->acta = $request->acta;
        $acta_matrimonio->fecha_registro = Carbon::parse($request->fecha_registro)->format("Y-m-d");
        $acta_matrimonio->fecha_nacimiento = $request->fecha_nacimiento == null ? NULL : Carbon::parse($request->fecha_nacimiento)->format("Y-m-d");

        $acta_matrimonio->rectificado = $request->rectificado;
        $acta_matrimonio->archivo = $request->archivo;

        $acta_matrimonio->update();

        // return $acta_matrimonio;
        return redirect('/acta_nacimiento');
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
