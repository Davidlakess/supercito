<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationsModel extends Model
{
    use HasFactory;



    static public function addNotification(){
        
    } 

    static public function SendNotification($token, $id_venta, $type){
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
        $msg= $datos[$type]['msg'];
        $cargautil = $datos[$type]['data'];
        // dd($msg);

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
}
