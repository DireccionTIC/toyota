<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Session\SessionManager;
use App\Http\Requests\RegistroRequest;






class PasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        return view('change-password');
    }

    public function change(Request $request, SessionManager $sessionManager){
        $email = Auth::user()->email;
        if($request->password == $request->passwordconfirm){
            if(strlen($request->password) >= 8){
                if(Hash::check($request->oldpassword, Auth::user()->password)){
                    DB::table('users')
                    ->where('email', $email)
                    ->update(['password' => Hash::make($request->password)]);

                    $sessionManager->flash('message',"Contraseña cambiada exitosamente");
                    return back();
                }else{
                    $sessionManager->flash('errorPass',"La contraseña no coincide con la registrada en base de datos");
                    return back();
                }
            }else{
                $sessionManager->flash('message',"La contraseña debe tener al menos 8 dígitos");
                return back();

            }
        }else
        {
            $sessionManager->flash('message',"Error en la confirmación de la nueva contraseña");
            return back();
        }
        }

        public function reset(){
            $concesionarios = DB::table('users')->where('name', '<>' , 'AUTOMOTORES TOYOTA COLOMBIA')->pluck('name');
            
            if(Auth::user()->hasRole('admin')){
                return view('reset-password', compact(['concesionarios']));
            }
        }

        public function resetPassword(Request $request, SessionManager $sessionManager){
            DB::table('users')->where('name', $request->concesionario)->update(['password' => Hash::make('Toyota2022*')]);
            $sessionManager->flash('success',"La contraseña fue restablecida correctamente");
            return back();
        }

        


}
