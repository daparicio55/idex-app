<?php

use App\Models\AdmisioneVacante;
use App\Models\Cepre;
use App\Models\CepreEstudiante;
use App\Models\CepreSumativo;
use App\Models\CepreSumativoAlternativa;
use App\Models\CepreSumativoMarcada;
use App\Models\Cliente;
use App\Models\Deuda;
use App\Models\DeudaDetalle;
use App\Models\Ematricula;
use App\Models\EmatriculaDetalle;
use App\Models\Estudiante;
use App\Models\Mformativo;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

function oficinaNombre(){
    $oficina=DB::table('users')
    ->join('oficinas','oficinas.idOficina','=','users.idOficina')
    ->select('users.idOficina','oficinas.nombre')
    ->where('id','=',auth()->user()->id)
    ->first();
    return ($oficina->nombre);
}
function usuarioCorreo()
{
        $correo = DB::table('users')
        ->where('id','=',auth()->id())
        ->first();
        return ($correo->email);
}
//buscar egresado
//bucar alumno y sus datos
function BuscarAlumno($id,$tipo)
{
        //buscar alumno por idCliente
        if ($tipo == "alumno")
        {
                $filas = DB::table('alumnos as a')
                ->join('clientes as cl','cl.idCliente','=','a.idCliente')
                ->join('carreras as c','c.idCarreras','=','a.idCarreras')
                ->join('ingresos as i','i.idIngresos','=','a.idIngresos')
                ->where('a.idAlumno','=',$id)
                ->count();
                if ($filas == 1)
                {
                        $alumno = DB::table('alumnos as a')
                        ->join('clientes as cl','cl.idCliente','=','a.idCliente')
                        ->join('carreras as c','c.idCarreras','=','a.idCarreras')
                        ->join('ingresos as i','i.idIngresos','=','a.idIngresos')
                        ->where('a.idAlumno','=',$id)
                        ->first();
                        return ($alumno);
                }
                else
                {
                        $alumno = ['idAlumno'=>0,
                        'idCarreras'=>0,
                        'idIngresos'=>0,
                        'idCliente'=>$id,
                        'dniRuc'=>NULL,
                        'nombre'=>NULL,
                        'apellido'=>NULL,
                        'direccion'=>NULL,
                        'email'=>NULL,
                        'telefono'=>NULL,
                        'estado'=>NULL,
                        'estudiante'=>NULL,
                        'telefono2'=>NULL,
                        'nombresCarreras'=>NULL,
                        'anioIngreso'=>NULL
                        ];
                        $alumno = (object)$alumno;
                        return($alumno); 
                }
        }
        if ($tipo == "cliente")
        {
                $filas = DB::table('alumnos as a')
                ->join('clientes as cl','cl.idCliente','=','a.idCliente')
                ->join('carreras as c','c.idCarreras','=','a.idCarreras')
                ->join('ingresos as i','i.idIngresos','=','a.idIngresos')
                ->where('a.idCliente','=',$id)
                ->count();
                if ($filas == 1)
                {
                        $alumno = DB::table('alumnos as a')
                        ->join('clientes as cl','cl.idCliente','=','a.idCliente')
                        ->join('carreras as c','c.idCarreras','=','a.idCarreras')
                        ->join('ingresos as i','i.idIngresos','=','a.idIngresos')
                        ->where('a.idCliente','=',$id)
                        ->first();
                        return ($alumno);
                }
                else
                {
                        $alumno = ['idAlumno'=>0,
                        'idCarreras'=>0,
                        'idIngresos'=>0,
                        'idCliente'=>$id,
                        'dniRuc'=>NULL,
                        'nombre'=>NULL,
                        'apellido'=>NULL,
                        'direccion'=>NULL,
                        'email'=>NULL,
                        'telefono'=>NULL,
                        'estado'=>NULL,
                        'estudiante'=>NULL,
                        'telefono2'=>NULL,
                        'nombresCarreras'=>NULL,
                        'anioIngreso'=>NULL
                        ];
                        $alumno = (object)$alumno;
                        return($alumno); 
                }
        }
        
}
//vamos a retornar el DNI
function BuscarDni($dni){
        if ($dni == "vacio")
        {
                //$vacio';
                $cliente = ['idCliente'=>0,
                'dniRuc'=>NULL,
                'nombre'=>NULL,
                'apellido'=>NULL,
                'direccion'=>NULL,
                'email'=>NULL,
                'telefono'=>NULL,
                'estado'=>NULL,
                'estudiante'=>NULL,
                'telefono2'=>NULL
                ];
                $cliente = (object)$cliente;
                return($cliente);
        }
        else
        {
        $filas = DB::table('clientes')
	->where('dniRuc','=',$dni)
	->count();
        if($filas == 1)
        {
                //si hay regresamos el cliente
                $cliente = DB::table('clientes')->where('dniRuc','=',$dni)->first();
                return($cliente);
        }
        else
        {
                //si no hay vamos a buscar en la api
                $cons = file_get_contents('https://dniruc.apisperu.com/api/v1/dni/'.$dni.'?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6ImR3YXBhcmljaWNpb0BnbWFpbC5jb20ifQ.2AdhICiTyw6lpnrxtfK2ajSgfMGiMn-71RvrRGKd8Uk');
                $arr = json_decode($cons,false);
                if (isset($arr->success))
		{
			//$dni='INGRESE MANUAL';
                        $cliente = ['idCliente'=>0,
                        'dniRuc'=>$dni,
                        'nombre'=>'INGRESO',
                        'apellido'=>'MANUAL',
                        'direccion'=>'-',
                        'email'=>'sincorreo@gmail.com',
                        'telefono'=>'999999999',
                        'estado'=>0,
                        'estudiante'=>'no',
                        'telefono2'=>'999999999'
                        ];
                        $cliente = (object)$cliente;
			return($cliente);
		}
                else
                {
                        $cliente = ['idCliente'=>0,
                        'dniRuc'=>$dni,
                        'nombre'=>$arr->nombres,
                        'apellido'=>$arr->apellidoPaterno.' '.$arr->apellidoMaterno,
                        'direccion'=>'-',
                        'email'=>'sincorreo@gmail.com',
                        'telefono'=>'999999999',
                        'estado'=>0,
                        'estudiante'=>'no',
                        'telefono2'=>'999999999'
                        ];
                        $cliente = (object)$cliente;
                        return($cliente);
                }
        }
        }
}
//vamos a verificar las deudas pe bateria
function estadoDeuda($id)
{
        $fechaActual = Carbon::now();
        $estado = "al dia";
        $deudas = DB::table('deudas as d')
        ->select('d.idDeuda','dd.estado','dd.fechaPrograma')
        ->join('deudas_detalles as dd','dd.idDeuda','=','d.idDeuda')
        ->where('d.idDeuda','=',$id)
        ->orderBy('dd.fechaPrograma','desc')
        ->get();
        foreach($deudas as $deuda){
                //pasar al objeto carbon
                $fechaProgramada = Carbon::parse($deuda->fechaPrograma);
                if($fechaActual->greaterThanOrEqualTo($fechaProgramada) && $deuda->estado == "deuda"){
                        $estado = "en deuda";
                }
        }
        return $estado;
}
function totalDeudas()
{
        $contador = 0;
        
        $listaDeudas = Deuda::all();
        foreach($listaDeudas as $deuda){
                if (estadoDeuda($deuda->idDeuda) == "en deuda"){
                        $contador ++;
                }
        }
        return $contador;
}
//vamos a calcular las notas con el id de la asignacion;
function calcularNotas($id)
{
        
}
//calular la nota de un sumativo
function sumativoPuntaje($dni,$id){
        $correctas = 0;
        $incorrectas = 0;
        $blancas = 0;
        $sumativo = CepreSumativo::findOrFail($id);
        $preguntas = CepreSumativoAlternativa::orderBy('pregunta','asc')->where('cepre_sumativo_id','=',$id)->get();
        foreach ($preguntas as $pregunta){
            $marcada = CepreSumativoMarcada::where('dni','=',$dni)
            ->where('pregunta','=',$pregunta->pregunta)
            ->where('cepre_sumativo_id','=',$id)
            ->first();
            if(isset($marcada)){
                if($pregunta->respuesta == $marcada->marcada){
                        $correctas ++;
                    }else{
                        if($marcada->marcada == " "){
                            $blancas ++;
                        }else{
                            $incorrectas ++;
                        }
                    }
            }else{
                $blancas++;
            }
        }
        $puntaje = $correctas * $sumativo->puntos - ($incorrectas * $sumativo->encontra);
        $respuesta = ['puntaje'=>$puntaje,'correctas'=>$correctas,'incorrectas'=>$incorrectas,'blancas'=>$blancas];
        $objeto = (object)$respuesta;
        return ($objeto);
}
function sumativo($dni,$cepre){
        //buscar el resultado del primer sumativo
        $sumativos = DB::table('cepre_sumativos')
        ->select('id')
        ->where('cepre_id','=',$cepre)
        ->orderBy('id','asc')
        ->get();
        $primer = DB::table('cepre_sumativo_resultados')
        ->where('cepre_sumativo_id','=',$sumativos[0]->id)
        ->where('dni','=',$dni)
        ->first();
        $segundo = DB::table('cepre_sumativo_resultados')
        ->where('cepre_sumativo_id','=',$sumativos[1]->id)
        ->where('dni','=',$dni)
        ->first();
        $puntaje = [$primer->puntaje,$segundo->puntaje];
        return ($puntaje);       
}
//calcular vacantes
function vacantes($admisione_id,$carrera_id){
        $vacantes = AdmisioneVacante::where('carrera_id','=',$carrera_id)
        ->where('admisione_id','=',$admisione_id)
        ->first();
        return $vacantes->cantidad;
}
//ver lo que falta por pagar de la cepre
function ceprePorPagar($id){
        try {
                //code...
                
                $estudiante = CepreEstudiante::findOrFail($id);
                $cepre = DB::table('cepres')
                ->where('idCepre','=',$estudiante->idCepre)
                ->first();
                $pago = DB::table('cepre_pagos')
                ->select(DB::raw('sum(montoPago) as total'))
                ->where('idCepreEstudiante','=',$id)
                ->first();
                $cantidad = DB::table('cepre_pagos')
                ->where('idCepreEstudiante','=',$id)
                ->count();
                //verificar primero si el pago es total
                if ($pago->total >= $cepre->costoTotal && $cantidad == 1 ){
                        //
                        return(0);
                }else{
                        $resta = $cepre->costoCuota - $pago->total;
                        return ($resta);
                }
        } catch (\Throwable $th) {
                //throw $th;
                return ($th->getMessage());
        }
        
}
/* verificar si es estudiante */
function existeEstudiante($id){
        $respuesta = "NO";
        $alumno = Estudiante::where('admisione_postulante_id','=',$id)->first();
        if(isset($alumno)){
                $respuesta="SI";
        }
        return($respuesta);
}
function tMatricula(){
        $matriculas = [
                'Regular'=>'Regular',
                'Extemporaneo'=>'Extemporaneo'
        ];
        return $matriculas;
}
function tUnidades(){
        $tipos =[
                'Específica'=>'Específica',
                'Empleabilidad'=>'Empleabilidad',
                'Técnica'=>'Técnica',
                'Transversal'=>'Transversal'
        ];
        return $tipos;
}
function ciclos(){
        $ciclos = [
                'I'=>'I',
                'II'=>'II',
                'III'=>'III',
                'IV'=>'IV',
                'V'=>'V',
                'VI'=>'VI'
        ];
        return $ciclos;
}
function tmUnidad(){
        $tipos = [
                'Regular'=>'Regular',
                'Repitencia'=>'Repitencia'
        ];
        return $tipos;
}
function checkUnidad($matricula,$unidad){
        $cantidad = DB::table('ematriculas as ema')
        ->join('ematricula_detalles as emad','ema.id','=','emad.ematricula_id')
        ->where('ema.id','=',$matricula)
        ->where('emad.udidactica_id','=',$unidad)
        ->count();
        //propiedades 
        $respuesta = DB::table('ematriculas as ema')
        ->select('emad.tipo')
        ->join('ematricula_detalles as emad','ema.id','=','emad.ematricula_id')
        ->where('ema.id','=',$matricula)
        ->where('emad.udidactica_id','=',$unidad)
        ->first();
        if ($cantidad == 1){
                if ($respuesta->tipo == 'Regular'){
                        return "SI";
                }
                if ($respuesta->tipo == 'Repitencia' ){
                        return "RE";
                }
                if($respuesta->tipo == 'Convalidacion'){
                        return "CV";
                }
        }else{
                return "NM";
        }
}
function detalle($matricula,$unidad){
        $detalle = EmatriculaDetalle::where('udidactica_id','=',$unidad)
        ->where('ematricula_id','=',$matricula)
        ->first();
        return $detalle; 
}
function modulos($id){
        $modulos = Mformativo::where('carrera_id','=',$id)
        ->get();
        return $modulos;
}
//vamos a devolver las notas por unidad didactica
function notas($unidad,$estudiante){
        $notas = DB::table('ematricula_detalles as md')
        ->select('md.nota','md.tipo','pm.ffin','md.observacion')
        ->join('ematriculas as m','m.id','=','md.ematricula_id')
        ->join('pmatriculas as pm','pm.id','=','m.pmatricula_id')
        ->where('md.udidactica_id','=',$unidad)
        ->where('m.estudiante_id','=',$estudiante)
        ->get();
        return $notas;
}
function edad($nacimiento){
        //$actual = Carbon::now();
        //$nacimiento = date('Y-m-d h:i:s',strtotime($nacimiento));
        $age = Carbon::parse($nacimiento)->age;
        //$edad = $actual->diffForHumans($nacimiento,$actual);
        return $age;
}
function veriManual($id,$ciclo){
        //vamos a verificar si tiene una verificacion manual de ciclo;
        $matricula = Ematricula::where('estudiante_id','=',$id)
        ->where('observacion','=',$ciclo)
        ->count();
        if ($matricula>0){
                return true;
        }else{
                return false;
        }
}
function calcularnota($estudiante){
        //
        $nota = DB::table('ematricula_detalles as ema_det')
        ->join('ematriculas as ema','ema.id','=','ema_det.ematricula_id')
        //->where('ema_det.udidactica_id','=',$unidad)
        ->where('ema.estudiante_id','=',$estudiante)
        ->count();
        return $estudiante;
}
/* calcular deuda */
function deuda($id){
        $cliente = Cliente::findOrFail($id);
        /* return ($cliente->deudas[0]->deudadetalles); */
        $total = 0;
        foreach ($cliente->deudas as $deuda){
                foreach ($deuda->deudadetalles as $detalle){
                        if($detalle->estado == 'deuda'){
                                $total = $total + $detalle->monto;
                        }
                }
        }
        return ($total);
}