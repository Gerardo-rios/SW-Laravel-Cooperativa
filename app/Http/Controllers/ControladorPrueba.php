<?php

namespace App\Http\Controllers; 

use Illuminate\Http\Request;

use Laravel\Lumen\Routing\Controller as BaseController;

class ControladorPrueba extends BaseController
{
    public function index(Request $request){
    	return response()->json("hola:mundo");
    }
}