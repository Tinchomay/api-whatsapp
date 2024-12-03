<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Document;
use App\Models\UserState;

class PrincipalController extends Controller
{

    public function conectar()
    {
        $token = 'pruebaTokenWebhook';
        $palabraReto = $_GET['hub_challenge'];
        $tokenVerificicacion = $_GET['hub_verify_token'];
        if($token === $tokenVerificicacion){
            echo $palabraReto;
            exit;
        }

    }

    public function recibirMensajes(Request $request)
    {
        $respuesta = $request->getContent();
        $respuestaJson = json_decode($respuesta, true);
        $mensaje = $respuestaJson['entry'][0]['changes'][0]['value']['messages'][0]['text']['body'];
        $telefonoClienteConUno = $respuestaJson['entry'][0]['changes'][0]['value']['messages'][0]['from'];
        if (strlen($telefonoClienteConUno) == 13) {
            $antesTercerLetra = substr($telefonoClienteConUno, 0, 2); $despuesTercerLetra = substr($telefonoClienteConUno, 3); $telefonoCliente = $antesTercerLetra . $despuesTercerLetra;
        } else {
            $telefonoCliente = $telefonoClienteConUno;
        }


        $estadoUsuario = UserState::where('telefono', $telefonoCliente)->first();

        if (!$estadoUsuario || $estadoUsuario->estado === 'inicio') {
            $this->enviar($telefonoCliente, 'Bienvenido al sistema de consulta de documentos, escriba el número de documento que desea buscar a continuación.');
            UserState::updateOrCreate(['telefono' => $telefonoCliente], ['estado' => 'esperando_documento']);
        } elseif ($estadoUsuario->estado === 'esperando_documento') {
            $documento = Document::where('numero', $mensaje)->first();
            if ($documento) {
                $this->enviar($telefonoCliente, 'Documento encontrado. Elija una opción:\n1. 📄 Resumen. \n2. ✍️ Autor. \n3. 📅 Fecha. \n4. 📜 Contenido. \n5. 🔍 Otros.');
                $estadoUsuario->update(['estado' => 'esperando_seleccion', 'documento_id' => $documento->id]);
            } else {
                $this->enviar($telefonoCliente, 'Documento no encontrado. Escriba nuevamente para iniciar otra busqueda.');
                $estadoUsuario->update(['estado' => 'inicio']);
            }
        } elseif ($estadoUsuario->estado === 'esperando_seleccion') {
            $documento = Document::find($estadoUsuario->documento_id);
            $respuesta = match ($mensaje) {
                '1' => "Resumen: {$documento->resumen}",
                '2' => "Autor: {$documento->autor}",
                '3' => "Fecha: {$documento->fecha}",
                '4' => "Contenido: {$documento->contenido}",
                default => 'Opción no válida. Escriba nuevamente para iniciar otra busqueda'
            };
            $this->enviar($telefonoCliente, $respuesta);
            $estadoUsuario->update(['estado' => 'inicio']);
        }
    }

    public function enviar($telefonoCliente, $mensajeTexto)
    {
        $token = env('TOKEN_WHATSAPP');

        $telefonoId = env('TELEFONO_ID');

        $url = 'https://graph.facebook.com/v21.0/' . $telefonoId . '/messages';

        $mensaje = ''
                . '{'
                .'"messaging_product": "whatsapp", '
                .'"recipient_type": "individual",'
                .'"to": "' . $telefonoCliente . '", '
                .'"type": "text", '
                .'"text": '
                .'{'
                .'      "body":"' . $mensajeTexto . '",'
                .'      "preview_url": true, '
                .'} '
                .'}';
        $header = array("Authorization: Bearer " . $token, "Content-Type: application/json",);

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $mensaje);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $response = json_decode(curl_exec($curl), true);

        $status_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        curl_close($curl);

    }

    public function politica()
    {
        return 'Politica';
    }

}
