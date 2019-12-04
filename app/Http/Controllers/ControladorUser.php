<?php

namespace App\Http\Controllers; 

use App\User;

use App\Http\Helper\ResponseBuilder;

use Illuminate\Support\Facades\Hash;

use Illuminate\Hashing\BcryptHasher;

use Illuminate\Http\Request;

use Laravel\Lumen\Routing\Controller as BaseController;

class ControladorUser extends BaseController
{
   
   public function login(Request $request)
   {
    $username = $request -> username;
    $password = $request -> password;

    $user = User::where('username', $username)->first();

    error_log($this -> django_password_verify($password, $user->password));
    error_log($user -> password);
    if (!empty($user)) {
        if ($this -> django_password_verify($password, $user->password)) {
            $status = true;
            $info = "User is correct";
        }else{
            $status = false;
            $info = "User is incorrect";
        }
    }else{
        $status = false;
        $info = "User is incorrect";
    }
    return ResponseBuilder::result($status, $info);
   }

   public function django_password_verify(string $password, string $djangoHash): bool
   {
    $pieces = explode('$', $djangoHash);
    
    if (count($pieces) !== 4) {    
        throw new Exception("Illegal hash format");
    }
    list($header, $iter, $salt, $hash) = $pieces;
    //get the hash algorithm used:
    if (preg_match('#^pbkdf2_([a-z0-9A-Z]+)$#', $header, $m)) {
        $algo = $m[1];
    } else {
        throw new Exception(sprintf("Bad header (%s)", $header));
    }
    if (!in_array($algo, hash_algos())) {
        throw new Exception(sprintf("Illegar hash algorithm (%s)", $algo));
    }

    /*hash_pbkdf2 = Genera una derivacion de clave PBKDF2 de una contrasena proporcionada
    algo es el nombre del algoritmo hash seleccionado (esto es, "md5", "sha256", "haval160,4", etc.)
    salt = es un valor para la dericacion, este valor deberia ser generado aleatoriamente
    iterations = el numero de iteraciones internas para realizar la derivacion
    */
    $calc = hash_pbkdf2(
        $algo,
        $password,
        $salt,
        (int) $iter,
        32,
        true
    );
    return hash_equals($calc, base64_decode($hash));
   }

   public function logout(Request $request)
   {
    //deslogears
   }

}