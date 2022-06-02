<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use response;

class pdfController extends Controller
{
    //   
    public function save(Request $request){
        $file = $request->file("myfile")->storeAs("actasAPI",$request->file("myfile")->getClientOriginalName());
        return $file;
    }
}
