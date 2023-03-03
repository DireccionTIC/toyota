<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cupon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Exports\CuponsExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Session\SessionManager;


class ReportesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $concesionarios = DB::table('users')->pluck('name');

        $cuponsRedimidos = DB::table('cupons')->where('enabled', 0)->get();
        $cuponsRedimidosAux = DB::table('cupons')->where('enabled', 0)->where('site', Auth::user()->name)->get();

        $cuponsRedimibles = DB::table('cupons')->where('enabled', 1)->get();


        
        if(Auth::user()->hasRole('admin')){
            return view('reportes-admin', compact(['cuponsRedimidos', 'cuponsRedimibles', 'concesionarios']));
        }else if(Auth::user()->hasRole('rol2')){
            return view('reportes-aux', compact(['cuponsRedimidosAux']));
        }
    }

    public function exportar(){
        return Excel::download(new CuponsExport, 'cupones.xlsx');
    }

    public function mostrar(Request $request, SessionManager $sessionManager){
        if($request->concesionario != 'Todos'){
            $concesionarios = DB::table('users')->pluck('name');
            $cuponsRedimidos = DB::table('cupons')->where('enabled', 0)->where('site', $request->concesionario)->get();
            $cuponsRedimibles = DB::table('cupons')->where('enabled', 1)->get();

            $sessionManager->flash('filtrado',"Filtrando por: ".$request->concesionario);
            $old = $request->old('concesionario');

            $selected = $request->concesionario;
            return view('reportes-admin', compact(['cuponsRedimidos', 'cuponsRedimibles', 'concesionarios', 'selected']));
        }else{
            return redirect()->back();
        }
    }

}
