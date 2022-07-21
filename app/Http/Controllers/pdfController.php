<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;

class pdfController extends Controller
{
    //   
    public function save_defunciones(Request $request){
        // return $request->file("myfile")->getClientOriginalName();
    if ($request->file('myfile')!=null) {
        $url_path="public/actas/Actas_Defunciones";
        $file = $request->file("myfile")->storeAs($url_path,$request->file("myfile")->getClientOriginalName());
        return Response::json("agregado");
    }
    return Response::json("archivo vacio");
    }
    public function save_nacimientos(Request $request){
        if ($request->file('myfile')!=null) {
        $url_path="public/actas/Actas_Nacimientos";
        $file = $request->file("myfile")->storeAs($url_path,$request->file("myfile")->getClientOriginalName());
        return Response::json("agregado");
    }
    return Response::json("archivo vacio");
    }
    public function save_matrimonios(Request $request){
        if ($request->file('myfile')!=null) {
        $url_path="public/actas/Actas_Matrimoios";
        $file = $request->file("myfile")->storeAs($url_path,$request->file("myfile")->getClientOriginalName());
        return Response::json("agregado");
        }
        return Response::json("archivo vacio");
    }
    public function recuperar_acta($url){
        // return 
    }
}
