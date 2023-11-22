<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use App\Models\User;
use App\Http\Requests;
// use App\Mail\confirm_email;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Auth;
class Users extends Controller
{

    public function UserUpdate (Request $request) {
        // ['cantidad' =>$cant_total] Como poner la informacion clave + valor
        User::where('id',auth()->id())->update(['f_token' => $request->f_token]);
        return response()->json(array('res' => true));
    }

    public function ActualizarUsuario (Request $request) {
        User::where('id',auth()->id())->update($request->data);
        return response()->json(array('res' => true));
        // dd((array)$request->data);
    }

    public function CambiarPassword (Request $request) {

        $user = User::where('id', auth()->id() )->first();
        if (! $user || ! Hash::check($request->oldpassword, $user->password)) {
            
           return response()->json(array('res' => false, 'error' => 'Contraseña incorrecta'));
        
        }
        $user->password = Hash::make($request->password);
        $user->save();
        // User::where('id',auth()->id())->update(['password' => Hash::make($request->password)]);        
        return response()->json(array('res' => true));

    }
    public function getDomicilio(){
        $domicilio = user::from("domicilio_envio as dm")
        ->select(
                'dm.calle',
                'dm.numero_e',
                'dm.numero_i',
                'dm.calle_1',
                'dm.calle_2',
                'dm.referencia',
                'dm.id_localidad',
                'localidades.name'  
            )
            ->Join('localidades', 'localidades.id_localidad', '=', 'dm.id_localidad','left')
            ->where('id_usuario',auth()->id() )->first();
    
        return response()->json(array( 'res' => true, 'data' => $domicilio));    
    }
}
