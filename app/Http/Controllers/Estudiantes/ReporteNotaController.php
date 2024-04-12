<?php

namespace App\Http\Controllers\Estudiantes;

use App\Http\Controllers\Controller;
use App\Models\Estudiante;
use App\Models\User;
use Illuminate\Http\Request;

class ReporteNotaController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $user = User::findOrFail(auth()->id());
        $estudiantes = Estudiante::whereHas('postulante',function($query) use($user){
            $query->where('idCliente','=',$user->ucliente->cliente_id);
        })->get();
        return view('estudiantes.reportes.notas.index',compact('estudiantes'));
    }
}
