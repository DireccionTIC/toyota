<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Session\SessionManager;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\RegistroRequest;
use App\Imports\{UsersImports, CuponImport};
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use App\Exports\CuponsExport;



class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('register-admin');
    }

    public function create(RegistroRequest $request, SessionManager $sessionManager)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ])->assignRole('rol2');
        $sessionManager->flash('registed',"El usuario fue registrado exitosamente");
          
        return back();
    }




    public function import(Request $request){
        Excel::import(new UsersImports, $request->file('file'));

        return redirect()->back();
    }

    public function importCupon(Request $request){
        $path = $request->file('file');
        Excel::import(new CuponImport, $path);

        return redirect()->back();
    }

}
