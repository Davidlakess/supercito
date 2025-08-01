<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Mail\verificarCorreo;
use App\Models\domicilio_envio;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Mail;
use Twilio\Rest\Client;
use Twilio\Jwt\ClientToken;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'telefono' => ['required', 'string', 'min:10'],
            'password' => ['required', 'string', 'min:8']
        ]);
    }
    public function registrar(Request $request){

        $datap = (array) $request->all(); 
        $validator = Validator::make($datap, [
            'name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'string', 'email', 'max:100', 'unique:users'],
            'telefono' => ['required', 'string', 'min:10','unique:users'],
            'password' => ['required', 'string', 'min:8']
        ]);
        
        if ($validator->fails()) {
            return response()->json(array('errors' => $validator->errors(), 'res' =>false));
        }else{
           if($datap['tel_verify']){
                $this->create($datap);
                
              Auth::attempt(['email' => $datap['email'], 'password' => $datap['password']]);
                
                return response()->json(array('errors' => $validator->errors(), 'res' =>true));
           }else {
                return response()->json(array('errors' => $validator->errors(),'res' =>'verify'));
           }
        }
    }
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {

        // $pass = $this->generatePassword(8);
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' =>Hash::make($data['password']),
            'telefono' => $data['telefono'],
            'telefono_confirm' => $data['tel_verify']
        ]);
        

        $domicilio = new  domicilio_envio();
        $domicilio->id_usuario=$user['id'];
        if($data['id_localidad'] != 0){
          $domicilio->id_localidad = $data['id_localidad'];
        }else{
            $domicilio->id_localidad = 0;
            $domicilio->otro_domicilio = $data['namelocalidad'];
        }
        $domicilio->id_localidad=$data['id_localidad'];
        $domicilio->calle=$data['calle'];
        $domicilio->calle_1=($data['calle_1']!=''?$data['calle_1']:'');
        $domicilio->calle_2=($data['calle_2']!=''?$data['calle_2']:'');
        $domicilio->numero_e=$data['numero_e'];
        $domicilio->lat=$data['ubicacion']['lat'];
        $domicilio->long=$data['ubicacion']['long'];
        $domicilio->referencia=$data['referencia'];
        $domicilio->numero_i=($data['numero_i']!='')?$data['numero_i']:'';
        $domicilio->save();
        event(new Registered($user));
        

        // Enviar SMS
        // $token = getenv("TWILIO_TOKEN");
        // $twilio_sid = getenv("TWILIO_SID");
        // $twilio_verify_sid = getenv("TWILIO_VERIFY_SID");
        // $twilio = new Client($twilio_sid, $token);
        // $twilio->verify->v2->services($twilio_verify_sid)
        // ->verifications->create('+52'.$data['telefono'], "sms");
        
        // FIN

        // $email = new \stdClass();
        // $email->email = $data['email'];
        // $email->receiver =$data['name'];
        // $email->password = $pass;
        // Mail::to($data['email'])->send(new verificarCorreo($email));
     }

    protected function generatePassword($length)
    {
        $key = "";
        $pattern = "1234567890abcdefghijklmnopqrstuvwxyz";
        $max = strlen($pattern)-1;
        for($i = 0; $i < $length; $i++){
            $key .= substr($pattern, mt_rand(0,$max), 1);
        }
        return $key;
    }
}
