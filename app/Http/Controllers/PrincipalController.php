<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PrincipalController extends Controller
{


    public function conectar()
    {
        //mi token
        $token = 'pruebaTokenWebhook';

        //face nos mandara un reto
        $palabraReto = $_GET['hub_challenge'];

        //face nos mandara un token
        $tokenVerificicacion = $_GET['hub_verify_token'];

        //si es el mismo token aceptamos
        if($token === $tokenVerificicacion){
            echo $palabraReto;
            exit;
        }

    }
}
