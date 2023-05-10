<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiUserController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }
    /* public function usuario(Request $request){
        $usuario = null;
        if($request->has('dni')){
            $usuario = Cliente::where('dniRuc','=',$request->dni)->get();
        }
        return response()->json($usuario);
    } */
    public function datos (Request $request){
        //return $request->user();
        $message = ['message'=>'no se envio el parametro DNI'];
        if($request->has('dni')){
            $estudiante = DB::table('estudiantes as es')
            ->join('admisione_postulantes as p','es.admisione_postulante_id','=','p.id')
            ->join('ccarreras as cc','cc.idCarrera','=','p.idCarrera')
            ->join('clientes as c','c.idCliente','=','p.idCliente')
            ->select('c.nombre','c.apellido','p.sexo','p.discapacidad','c.telefono as telefono','c.telefono2 as whatsapp','p.fechaNacimiento','c.direccion','cc.nombreCarrera as carrera')
            ->where('c.dniRuc','=',$request->dni)            
            ->get();
            if (count($estudiante)>0){
                return response()->json($estudiante);
            }else{
                $message = ['message'=>'no se encontrados datos con ese dni'];
                return response()->json($message);
            }
        }else{
            return response()->json($message);
        }
    }
}
