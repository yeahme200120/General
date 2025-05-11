<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\SeguimientoService;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
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
    protected $redirectTo = '/home';

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
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'id_empresa'=>['required'],
            'id_estatus'=>['required'],
            'id_rol'=>['required'],
            'telefono'=>['required'],
            'direccion'=>['required'],
        ],[
            'name.required' => 'El nombre es obligatorio',
            'name.max' => 'El nombre no debe exceder los 255 caracteres',
            'email.required' => 'El correo electrónico es obligatorio',
            'email.email' => 'Debe ingresar un correo electrónico válido',
            'email.max' => 'El correo no debe exceder los 255 caracteres',
            'email.unique' => 'Este correo electrónico ya se encuentra registrado. Prueba Iniciando Sesión',
            'password.required' => 'La contraseña es obligatoria',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres',
            'password.confirmed' => 'Las contraseñas no coinciden',
            'id_empresa.required'=> 'El campo Empresa es un campo obligatorio',
            'id_estatus.required'=> 'El campo Estatus es un campo obligatorio',
            'id_rol.required'=> 'El campo Rol es un campo obligatorio',
            'telefono.required'=> 'El campo Telefono es un campo obligatorio',
            'direccion.required'=> 'El campo Dirección es un campo obligatorio',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' =>   mb_strtoupper(trim($data['name']), 'UTF-8'),
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'id_empresa' => $data["id_empresa"],
            'id_estatus' => $data["id_estatus"],
            'id_rol' => $data["id_rol"],
            'is_admin' => ($data["id_rol"] == 1 || $data["id_rol"] == 11) ? true : false,
            'telefono' => $data["telefono"],
            'direccion' => $data["direccion"],
        ]);
        if($user){
            $respuesta = app(SeguimientoService::class)->registrar(
                "Registro de Usuario", 
                $user, 
                Auth::id() ?? 0, 
                $user->id
            );
            if($respuesta){
                return $user;
            }else{
                return redirect()->back()->with('error', 'Ocurrió un error al registrar El seguimiento del registro de usuario, vuelve a intentarlo.');    
            }
        }else{
            return redirect()->back()->with('error', 'Ocurrió un error al registrar El seguimiento del registro de usuario, vuelve a intentarlo.');    
        }
    }
}
