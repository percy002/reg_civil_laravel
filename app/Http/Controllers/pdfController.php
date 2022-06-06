<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;

class pdfController extends Controller
{
    //   
    public function save(Request $request){
        $url_path="public/actas/Actas_Defunciones";
        $file = $request->file("myfile")->storeAs($url_path,$request->file("myfile")->getClientOriginalName());
        return Response::json("agregado");
    }
}
