<?php

namespace App\Http\Controllers; 

use App\Cliente;
use App\Cuenta;

use App\Http\Helper\ResponseBuilder;

use Illuminate\Http\Request;

use Laravel\Lumen\Routing\Controller as BaseController;

class ControladorCliente extends BaseController
{
    public function index(Request $request){
    	$clientes = cliente::all();
    	return response()->json($clientes, 200);
    }

    public function getCliente(Request $request, $cedula){

    	if ($request->isjson()) {
    		$cliente = cliente::where('cedula', $cedula)->get();
    		if (!$cliente->isEmpty()) {
    			$status = true;
    			$info = "Data is listed successfully";
    		} else {
    			$status = false;
    			$info = "Data is not listed successfully";
    		}

    		return ResponseBuilder::result($status, $info, $cliente);
    	} else {
    		$status = false;
    		$info = "NO autorizado";
    		return ResponseBuilder::result($status, $info);
    	}
    	
    }

    public function getClienteApe(Request $request, $apellido){

        if ($request->isjson()) {
            $cliente = cliente::where('apellidos', $apellido)->get();
            if (!$cliente->isEmpty()) {
                $status = true;
                $info = "Data is listed successfully";
            } else {
                $status = false;
                $info = "Data is not listed successfully";
            }

            return ResponseBuilder::result($status, $info, $cliente);
        } else {
            $status = false;
            $info = "NO autorizado";
            return ResponseBuilder::result($status, $info);
        }
        
    }

    public function createCliente(Request $request){

    	$cliente = new cliente();

    	$cliente -> cedula = $request -> cedula;
    	$cliente -> nombres = $request -> nombres;
    	$cliente -> apellidos = $request -> apellidos;
    	$cliente -> genero = $request -> genero;
    	$cliente -> fecha_nacimiento = $request -> fecha_nacimiento;
    	$cliente -> estado_civil = $request -> estado_civil;
    	$cliente -> correo = $request -> correo;
    	$cliente -> telefono = $request -> telefono;
    	$cliente -> celular = $request -> celular;
    	$cliente -> direccion = $request -> direccion;

    	$cliente->save();

    	$cuenta = new cuenta();

    	$cuenta -> numero = $request -> numero;
    	$cuenta -> estado = true;
    	$cuenta -> fecha_apertura = $request -> fecha_apertura;
    	$cuenta -> tipo_cuenta = $request -> tipo_cuenta;
    	$cuenta -> saldo = $request -> saldo;
    	$cuenta -> cliente_id = $cliente -> id;


    	$cuenta->save();


    	return response()->json($cliente, 200);

    }

    public function putCliente(Request $request, $cedula){

        if ($request->isjson()) {
            
            $entrada = $request->all();
            Cliente::where('cedula', $cedula)->update($entrada);
            $cliente = Cliente::where('cedula', $cedula)->first();
            $status = true;
            $info = "Data is modified successfully";
            return ResponseBuilder::result($status, $info, $cliente);

        } else {
            $status = false;
            $info = "NO autorizado";
            return ResponseBuilder::result($status, $info);
        }
 	
    }
    //get cuenta


}