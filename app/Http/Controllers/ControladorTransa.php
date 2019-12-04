<?php

namespace App\Http\Controllers; 

use App\Transa;
use App\Cuenta;

use Illuminate\Http\Request;
use App\Http\Helper\ResponseBuilder;

use Laravel\Lumen\Routing\Controller as BaseController;

class ControladorTransa extends BaseController
{
    public function transaccion(Request $request){
    	
    	if ($request -> isjson()) {
    		$cuenta = Cuenta::where('numero', $request -> numero)->first();
    		$cuentaR = Cuenta::where('numero', $request -> numeroR)->first();
    		//$cuenta = $cuenta[0];
    		$transa = new Transa();
    		if ($cuenta != null) {
    			$transa -> fecha = $request -> fecha;
    			$transa -> tipo = $request -> tipo;
    			if ($transa -> tipo == 'deposito') {
    				$transa -> valor = $request -> valor;
    				$cuenta -> saldo = $cuenta -> saldo + $transa -> valor;
    				$cuenta -> save();
    			} elseif ($transa -> tipo == 'retiro'){
    				$transa -> valor = $request -> valor;
    				$cuenta -> saldo = $cuenta -> saldo - $transa -> valor;
    				$cuenta -> save();
    			} elseif ($transa -> tipo == 'transferencia'){
    				$transa -> valor = $request -> valor;
    				$cuenta -> saldo = $cuenta -> saldo - $transa -> valor;
    				$cuentaR -> saldo = $cuentaR -> saldo + $transa -> valor;
    				$cuenta -> save();
    				$cuentaR -> save();
    			}
    			$transa -> descripcion = $request -> descripcion;
    			$transa -> responsable = $request -> responsable;
    			$transa -> cuenta_id = $cuenta -> cuenta_id;
    			$transa -> save();
    			$status = true;
    			$info = "transa is done";
    			return ResponseBuilder::result($status, $info, $transa);
    		} else {
    			$status = false;
    			$info = "transa is in murky waters";
    			return ResponseBuilder::result($status, $info);
    		}

    	} else {
    		$status = false;
    		$info = "No estas enviando json";
    		return ResponseBuilder::result($status, $info);
    	}

    }
}