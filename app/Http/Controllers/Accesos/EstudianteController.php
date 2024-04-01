<?php

namespace App\Http\Controllers\Accesos;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Traits\MailTrait;

class EstudianteController extends Controller
{
    //
    use MailTrait;
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $usuarios = User::whereHas('roles',function($query){
            $query->where('name','Bolsa User');
        })->paginate(15);
        return view('accesos.estudiantes.index',compact('usuarios'));
    }
    public function update(Request $request, $id){   
        $this->sendReset($request);
        return Redirect::route('accesos.estudiantes.index')->with('info','se envio el correo con el link de restablecimiento de contraseña a: '.$request->email);
        
    }
    public function delete($id){
        try {
            //code...
            $user = User::findOrFail($id);
            $user->delete();
        } catch (\Throwable $th) {
            //throw $th;
            return Redirect::route('accesos.estudiantes.idex')->with('error','no se pudo eliminar el usuario');
        }
        return Redirect::route('accesos.estudiantes.idex')->with('info','se elmino el usuario correctamente');
    }
}
