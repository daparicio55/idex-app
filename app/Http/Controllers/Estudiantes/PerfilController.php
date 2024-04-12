<?php

namespace App\Http\Controllers\Estudiantes;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\Estudiante;
use App\Models\User;
use Illuminate\Http\Request;

class PerfilController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $user = User::findOrFail(auth()->id());
        $estudiante = Estudiante::whereHas('postulante',function($query) use($user){
            $query->where('idCliente','=',$user->ucliente->cliente_id);
        })->get();
        return view('estudiantes.perfil.index',compact('user','estudiante'));
    }
    public function store(Request $request){
        $arr = [
            'message' => 'Se actualizo correctamente'
        ];
        return $arr;
    }
    public function update(Request $request,$id){
        try {
            //code...
            $arr = [
                'message' => 'Se actualizo correctamente'
            ];
            $cliente = Cliente::findOrFail($id);
            $cliente->telefono = $request->telefono1;
            $cliente->telefono2 = $request->telefono2;
            $cliente->direccion = $request->direccion;
            $cliente->update();
        } catch (\Throwable $th) {
            //throw $th;
            $arr = [
                'message' => $th->getMessage()
            ];
        }
        return $arr;
    }
}
