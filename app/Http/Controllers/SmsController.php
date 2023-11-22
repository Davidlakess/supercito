<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\Rest\Client;
use Twilio\Jwt\ClientToken;

class SmsController extends Controller
{
    public function sendSms()
    {

        $token = getenv("TWILIO_TOKEN");
        $twilio_sid = getenv("TWILIO_SID");
        $twilio_verify_sid = getenv("TWILIO_VERIFY_SID");
        $twilio = new Client($twilio_sid, $token);
        $twilio->verify->v2->services($twilio_verify_sid)
        ->verifications->create('+524434126238', "sms");
        
    }
    // parametros
    // $token, $type = 'pendiente', $id_venta
    public function noty () {
   date_default_timezone_set('America/Mexico_City');
    // echo date('Y-m-d H:i:s');

        $id_venta = 'v1687647441';
        $datos = array(
            'pendiente'=>array(
                'msg' => array(
                    'title' => 'Solicitud de Nuevo Pedido',
                    'body' => 'Recibimos tu Pedido, tu solicitud se esta validando, revisa el estatus en mis compras - detalle .'
                    ),
                'data'=>array(
                    'title' => 'Solicitud de Nuevo Pedido',
                    'body' => 'Recibimos tu Pedido, tu solicitud se esta validando, revisa el estatus en mis compras - detalle .',
                    'url' => 'comprasdetalle',
                    'id' =>$id_venta,
                    'status' => 1,
                    'fecha' => date('Y-m-d H:i:s'),
                    'icono' => 'fa fa-cart-arrow-down'

                )
            ),
            'enviado'=>array(
                'msg' => array(
                    'title' => 'Actualizacion del Pedido',
                    'body' => 'Tu Pedido esta en Camino porfavor de estar pendiente de en su domicilio para su entrega, ¡gracias por su preferencia!.'
                    ),
                'data'=>array(
                    'title' => 'Actualizacion del Pedido',
                    'body' => 'Tu Pedido esta en Camino porfavor de estar pendiente en su domicilio para su entrega, ¡gracias por su preferencia!.',
                    'url' => 'compras',
                    'id' =>$id_venta,
                    'icono' => 'fa fa-truck',
                    'fecha' => date('Y-m-d H:i:s'),
                    'status' => 2
                    )
            ),     
            'log'=>array(
                'msg' => array(
                    'title' => 'Inicio de session',
                    'body' => 'se registro un inicio de session desde otro dispositivo'),
                'data'=>array(
                    'url' => 'compras',
                    'id' =>$id_venta,
                    'icono' =>'fa fa-info',
                    'fecha' => date('Y-m-d H:i:s'),
                    'status' => 0)
            ),     
            'entregado'=>array(
                'msg' => array(
                    'title' => 'Pedido Finalizado',
                    'body' => 'Entregamos tu pedido! gracias nene'
                    ),
                'data'=>array(
                    'url' => 'compras/',
                    'id' =>$id_venta,
                    'icono' => 'fa fa-handshake-o',
                    'fecha' => date('Y-m-d H:i:s'),
                    'status' => 0
                    )
            ),
            'cancelado'=>array(
                'msg' => array(
                    'title' => 'pedido cancelado',
                    'body' => 'tu pedido fue cancelado para mas informacion ve a tu cuenta jajaja'
                    ),
                'data'=>array(
                    'url' => 'compras/',
                    'id' =>$id_venta,
                    'icono' => 'fa fa-ban',
                    'fecha' => date('Y-m-d H:i:s'),
                    'status' => 0
                    )
            )                
        ); 
        $msg= $datos['enviado']['msg'];
        $cargautil = $datos['enviado']['data'];
        $token = 'ero9MyWsWC8:APA91bG3yPrj8twavwdARTSLyIpjlY9EtxcfxLFAmGmb-nF51O_BAboMC0aqKjEYuJN9bYJGyyYCb0Vr91xxViiIV2jkxjFRor4oQqw1eQ7qmhIbbMlAI1PSnJoCzRyXQhbMZilQAzjj';
        $url = 'https://fcm.googleapis.com/fcm/send';
        $api_key = env('FIREBASE_MSG_TOKEN');
                
    $fields = array(
        'registration_ids' => array($token),
        'notification' => $msg,
        'data'=> $cargautil
    );
    // En url y id , van la ruta y el parametro en caso de tener una url de accion
    $headers = array(
        'Authorization:key ='.$api_key, //Change API KEY HERE
        'Content-Type: application/json'
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);  
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
    
    $result = curl_exec($ch);           

    if ($result === FALSE) {
        die('Curl failed: ' . curl_error($ch));
    }
    curl_close($ch);
    return $result;

    } 
    public function Verify(Request $request)
    {
        $token = getenv("TWILIO_TOKEN");
        $twilio_sid = getenv("TWILIO_SID");
        $twilio_verify_sid = getenv("TWILIO_VERIFY_SID");
        $twilio = new Client($twilio_sid, $token);
        $verification = $twilio->verify->v2->services($twilio_verify_sid)
            ->verificationChecks
            ->create(['to' =>'+524434126238', 'code'=>$request->code]);
            
        if ($verification->valid) {    
          return response()->json(array('res'=>true));
        }
          return response()->json(array('res'=>false));
    }

}
