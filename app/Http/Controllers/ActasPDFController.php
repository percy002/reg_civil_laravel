<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ActasPDFController extends Controller
{
    //
    public function return_acta_pdf(Request $request)
    {
        // return $request;
        $file_name=$request->imagen;
        // $contents = Storage::disk('s3')->get($file_name);
        $contents = Storage::get(asset('/actas/Actas_Defunciones'.$file_name ));
        return $contents;
    }
}
