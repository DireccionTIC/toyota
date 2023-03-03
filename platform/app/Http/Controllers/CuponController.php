<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\CuponRequest;
use Illuminate\Session\SessionManager;
use App\Models\Cupon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class CuponController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    protected function index(){
        return view('cupon-admin');
    }

    public function showEdit(Request $request, SessionManager $sessionManager)
    { 
        $cupon = DB::table('cupons')->where('placa', $request->placa)->first();
        if($cupon){
            if(!$cupon->times_updated){
                $cupon->times_updated = 0;
            }
            $sessionManager->flash('times_updated', $cupon->times_updated);
            return view('cupon-admin', compact('cupon'));
        }else{
            $sessionManager->flash('errorPlaca', 'Placa no registrada');
            return redirect()->route('cupon.view.edit');
        }
    }

    
    public function edit(Request $request, SessionManager $sessionManager)
    {
        if(
            $cupon = DB::table('cupons')
            ->where('placa', $request->placa)
            ->update(['enabled' => $request->value])
        ){
            $sessionManager->flash('successEdit', 'Cupón actualizado correctamente');
            if(DB::table('cupons')->where('placa', $request->placa)->value('times_updated') > 0){    
                DB::table('cupons')
                ->where('placa', $request->placa)
                ->update(['times_updated' => DB::raw('times_updated + 1')]);
            }else{
                DB::table('cupons')
                ->where('placa', $request->placa)
                ->update(['times_updated' => 1]);
            } 
            
            return redirect()->route('cupon.view.edit');
        }else{
            $sessionManager->flash('errorEdit', 'El cupón ya se encontraba en este estado');

            return redirect()->route('cupon.view.edit');
        }
    }
    
    protected function store(Request $request, SessionManager $sessionManager){
        
        $cupones = DB::table('cupons')->where('placa', $request->placa)->first();
        $who = Auth::user();
        if($cupones == null){
            $sessionManager->flash('errorOne', 'Este cupón no está registrado');
            return redirect()->route('home');
        }
        if($cupones->enabled == 1){
            DB::table('cupons')
            ->where('placa', $request->placa)
            ->update(['enabled' => false, 'site' => $who->name, 'updated_at' => now()]);
            $sessionManager->flash('success', '¡Felicidades, su cupón fue
            redimido exitosamente!');
            return redirect()->route('home');   
        }
        $sessionManager->flash('errorTwo', "Este cupón ya fue redimido por");
        $sessionManager->flash('who', "$cupones->site");
        $sessionManager->flash('updated',"Día y hora: $cupones->updated_at");
        return redirect()->route('home');
    }
}
