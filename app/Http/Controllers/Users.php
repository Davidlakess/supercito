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

    public function get_info_user(){
        $perfil=User::select('id','name','email','avatar')
        ->where('id',auth()->id())->get();
        return view('perfil')->with('perfil',(isset($perfil[0]))?$perfil[0]:0);
        // $perfil=User::select('id','name','email','avatar')
        // ->where('id',auth()->id())->first();
        // $domicilio = domicilio_envio::select(
        //         'domicilio_envio.calle',
        //         'domicilio_envio.numero_e',
        //         'domicilio_envio.numero_i',
        //         'domicilio_envio.telefono',
        //         'domicilio_envio.calle_1',
        //         'domicilio_envio.calle_2',
        //         'domicilio_envio.id_localidad'  
        //     )
        //     ->Join('localidades', 'domicilio_envio.id_localidad', '=', 'localidades.id_localidad','left')
        //     ->where('domicilio.envio.id_usuario',auth()->id())->first();
        // return view('perfil')->with('perfil',);
    }

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
