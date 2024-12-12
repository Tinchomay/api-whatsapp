<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Auto;
use App\Models\Telefono;
use App\Models\UserState;
use Carbon\Carbon;

class PrincipalController extends Controller
{

    public function conectar()
    {
        $token = env('TOKEN_PRIMERACONEXIONWHAT');
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
            $this->enviarImagen($telefonoCliente, 'https://chatbot-agustin.domcloud.dev/storage/01JBFW57HE8NQ07VMRHTM8GDVS.png');
            usleep(400000);
            $this->enviar($telefonoCliente, 'Bienvenido al sistema de consulta de autos, escriba el número de documento que desea buscar a continuación.');
            UserState::updateOrCreate(['telefono' => $telefonoCliente], ['estado' => 'esperando_documento']);
            Telefono::create([
                'numero' => $telefonoCliente,
                'fechaHora' => Carbon::now()
            ]);
        } elseif ($estadoUsuario->estado === 'esperando_documento') {
            $auto = Auto::where('numde', $mensaje)->first();
            if ($auto) {
                $this->enviar($telefonoCliente, 'Hola ' . $auto->naciu . ' la denuncia del ' . $auto->tiden .  ', de su vehiculo ' . $auto->vemar .  ' de placa ' . $auto->vepla . ' ha sido registrada con éxito, a continuación puede elegeir que información necesita conocer:\n\nElija una opción:\n \n1. 📄 Estado de la Denuncia\n2. 📄 Orden Captura del Vehiculo\n3. 📄 Requisitos recepción vehículo\n4. 📄 Informe a Físcalia');
                $estadoUsuario->update(['estado' => 'esperando_seleccion', 'auto_id' => $auto->id]);
            } else {
                $this->enviar($telefonoCliente, 'Registro no encontrado. Escriba nuevamente para iniciar otra busqueda.');
                $estadoUsuario->update(['estado' => 'inicio', 'auto_id' => null]);
            }
        } elseif ($estadoUsuario->estado === 'esperando_seleccion') {
            $auto = Auto::find($estadoUsuario->auto_id);
            if($mensaje == '1' || $mensaje == '2' || $mensaje == '3' || $mensaje == '4'){
                $respuesta = match ($mensaje) {
                    '1' => 'Estado de la Denuncia\n\n*Estado:* ' . $auto->estde . '\n*Instructor Responsable:* ' . $auto->resIns . '\n*Celular*: ' . $auto->insce . '\n*Fiscalía a Cargo*: ' . $auto->nafis . '\n\n_Escriba otro numero para consultar mas información o *salir* para realizar otra busqueda_',
                    '2' => 'Orden Captura del vehiculo\n\n*Comunicación a SUNARP:* ' . $auto->comsu . '\n*Estado de Orden de Captura Activo:* ' . $auto->estoc . '\n\n_Escriba otro numero para consultar mas información o *salir* para realizar otra busqueda_',
                    '3' => 'Requisitos recepción vehículo\n\n*Peritaje de Ley* ' . $auto->indpe . '\n*Supensión de captura:* ' . $auto->indsu . '\n*Comunicación a SUNARP desafectación*: ' . $auto->comsd . '\n\n_Escriba otro numero para consultar mas información o *salir* para realizar otra busqueda_',
                    '4' => 'Informe a Físcalia\n\n*Numero Informe* ' . $auto->ninfi . '\n*Fecha de Registro:* ' . Carbon::parse($auto->dareg)->format('d-m-Y') . '\n*Oficio*: ' . $auto->numof . '\n\n_Escriba otro numero para consultar mas información o *salir* para realizar otra busqueda_',
                    default => 'Opción no válida. Escriba nuevamente para iniciar otra búsqueda',
                };
                $this->enviar($telefonoCliente, $respuesta);
                $estadoUsuario->update(['estado' => 'esperando_seleccion', 'auto_id' => $auto->id]);
            } else if(strtolower($mensaje) == 'salir') {
                $this->enviar($telefonoCliente, 'Escriba cualquier palabra para iniciar el bot');
                $estadoUsuario->update(['estado' => 'inicio', 'auto_id' => null]);
            } else {
                $this->enviar($telefonoCliente, 'Opcion incorrecta, escriba otro numero o presione salir para reiniciar el bot');
                $estadoUsuario->update(['estado' => 'esperando_seleccion']);
            }
        }
    }

    public function enviar($telefonoCliente, $mensajeTexto)
    {
        $token = 'EAAMvHZBxZAZCwIBO3B4JCOOv2ZCsChZA70NSm7MbhJgJZBhfOk2meLPiFVZB6iCXCluCW5OwjEnFEe2pNRCZCQ0ZCKGcv4nMQ6kqmQgFlKxdO1jefx3himl6E6tR7qk5Lh9CY6epfL4lIyAd5ndwlYw4wAPeyY4796AzAT6l47ODjZB43gDxUZCmMZAwWlvyXwXGNHMW';
        $telefonoId = '536629176191532';

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

    public function enviarImagen($telefonoCliente, $urlImagen, $caption = null)
    {
        $token = 'EAAMvHZBxZAZCwIBO3B4JCOOv2ZCsChZA70NSm7MbhJgJZBhfOk2meLPiFVZB6iCXCluCW5OwjEnFEe2pNRCZCQ0ZCKGcv4nMQ6kqmQgFlKxdO1jefx3himl6E6tR7qk5Lh9CY6epfL4lIyAd5ndwlYw4wAPeyY4796AzAT6l47ODjZB43gDxUZCmMZAwWlvyXwXGNHMW';
        $telefonoId = '536629176191532';

        $url = 'https://graph.facebook.com/v21.0/' . $telefonoId . '/messages';

        $mensaje = [
            'messaging_product' => 'whatsapp',
            'recipient_type' => 'individual',
            'to' => $telefonoCliente,
            'type' => 'image',
            'image' => [
                'link' => $urlImagen,
            ]
        ];

        if ($caption) {
            $mensaje['image']['caption'] = $caption;
        }

        $header = [
            "Authorization: Bearer " . $token,
            "Content-Type: application/json",
        ];

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($mensaje));
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $response = json_decode(curl_exec($curl), true);

        $status_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        curl_close($curl);

        return ['response' => $response, 'status_code' => $status_code];
    }


    public function politica()
    {
        return 'Politica';
    }

}


