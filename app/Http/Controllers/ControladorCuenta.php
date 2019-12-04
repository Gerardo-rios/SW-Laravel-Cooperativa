<?php

namespace App\Http\Controllers; 

use App\Cliente;
use App\Cuenta;

use App\Http\Helper\ResponseBuilder;

use Illuminate\Http\Request;

use Laravel\Lumen\Routing\Controller as BaseController;

class ControladorCuenta extends BaseController
{
    public function index(Request $request){
    	$cuentas = Cuenta::all();
    	return response()->json($cuentas, 200);
    }

    public function getCuenta(Request $request, $numero){

    	if ($request->isjson()) {
    		$cuenta = cuenta::where('numero', $numero)->get();
    		if (!$cuenta->isEmpty()) {
    			$status = true;
    			$info = "Data is listed successfully";
    		} else {
    			$status = false;
    			$info = "Data is not listed successfully";
    		}

    		return ResponseBuilder::result($status, $info, $cuenta);
    	} else {
    		$status = false;
    		$info = "NO autorizado";
    		return ResponseBuilder::result($status, $info);
    	}
    	
    }

    public function crearCuenta(Request $request, $cedula){

        if ($request -> isjson()) {
            $cliente = Cliente::where('cedula', $cedula)->first();
            if ($cliente != null) {
                $cuenta = new cuenta();

                $cuenta -> numero = $request -> numero;
                $cuenta -> estado = true;
                $cuenta -> fecha_apertura = $request -> fecha_apertura;
                $cuenta -> tipo_cuenta = $request -> tipo_cuenta;
                $cuenta -> saldo = $request -> saldo;
                $cuenta -> cliente_id = $cliente -> cliente_id;

                $cuenta->save();
                $status = true;
                $info = "La cuenta ha sido creada";
                return ResponseBuilder::result($status, $info, $cuenta);
            } else {
                $status = false;
                $info = "No se pudo crear la cuenta";
                return ResponseBuilder::result($status, $info);
            }
        } else {
            $status = false;
            $info = "NO autorizado";
            return ResponseBuilder::result($status, $info);
        }

    }

    public function cuentasCliente(Request $request, $cedula){

        if ($request->isjson()) {
            $cliente = Cliente::where('cedula', $cedula)->first();            
            if ($cliente != null) {
                $cuenta = cuenta::where('cliente_id', $cliente -> cliente_id)->get();
                $status = true;
                $info = "Data is listed successfully";
                return ResponseBuilder::result($status, $info, $cuenta);
            } else {
                $status = false;
                $info = "Data is not listed successfully, cedula no registrada";
                return ResponseBuilder::result($status, $info);
            }

            
        } else {
            $status = false;
            $info = "NO autorizado";
            return ResponseBuilder::result($status, $info);
        }

    }


}