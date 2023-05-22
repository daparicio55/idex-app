<?php

use App\Models\AdmisioneVacante;
use App\Models\Cepre;
use App\Models\CepreEstudiante;
use App\Models\CepreSumativo;
use App\Models\CepreSumativoAlternativa;
use App\Models\CepreSumativoMarcada;
use App\Models\Cliente;
use App\Models\CriterioDetalle;
use App\Models\Deuda;
use App\Models\DeudaDetalle;
use App\Models\Dmove;
use App\Models\Document;
use App\Models\Ematricula;
use App\Models\EmatriculaDetalle;
use App\Models\Estudiante;
use App\Models\Indicadore;
use App\Models\IndicadoreDetalle;
use App\Models\Mformativo;
use App\Models\Uasignada;
use App\Models\Udidactica;
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
                //verificamos el largo del la cadena
                if (strlen($dni) == 11){
                        //es un ruc
                        $cons = file_get_contents('https://dniruc.apisperu.com/api/v1/ruc/'.$dni.'?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6ImR3YXBhcmljaWNpb0BnbWFpbC5jb20ifQ.2AdhICiTyw6lpnrxtfK2ajSgfMGiMn-71RvrRGKd8Uk');
                        $arr = json_decode($cons,false);
                        if (!isset($arr->success)){
                                $cliente = [
                                        'idCliente'=>0,
                                        'dniRuc'=>$dni,
                                        'nombre'=>$arr->razonSocial,
                                        'apellido'=>'Inst./Emp.',
                                        'direccion'=>$arr->direccion.' - '.$arr->distrito.' - '.$arr->provincia.' - '.$arr->departamento,
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
                if (strlen($dni) == 8){
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
        try {
                //code...
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
        } catch (\Throwable $th) {
                //throw $th;
                return $th->getMessage();
        }


            
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
function checkUnidadeq($matricula,$unidad){

        //buscar la unidad equivalente
        $udidactica = Udidactica::findOrFail($unidad);
        if(isset($udidactica->old)){
                $cantidad = DB::table('ematriculas as ema')
                ->join('ematricula_detalles as emad','ema.id','=','emad.ematricula_id')
                ->where('ema.id','=',$matricula)
                ->where('emad.udidactica_id','=',$udidactica->old->id)
                ->count();
                //propiedades 
                $respuesta = DB::table('ematriculas as ema')
                ->select('emad.tipo')
                ->join('ematricula_detalles as emad','ema.id','=','emad.ematricula_id')
                ->where('ema.id','=',$matricula)
                ->where('emad.udidactica_id','=',$udidactica->old->id)
                ->first();
                if ($cantidad == 1){
                        return "EQ";
                }else{
                        return "NM";
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
function totalPrograma($pmatricula_id,$idCarrera){        
        $cantidad = Ematricula::where('pmatricula_id',$pmatricula_id
        )->whereHas('estudiante.postulante',function($query) use($idCarrera){
                $query->where('idCarrera',$idCarrera);
        })->count();
        return $cantidad;
}
function totalProgramaSexos($pmatricula_id,$idCarrera,$sexo){
        $cantidad = Ematricula::where('pmatricula_id',$pmatricula_id
        )->whereHas('estudiante.postulante',function($query) use($idCarrera,$sexo){
                $query->where('idCarrera',$idCarrera)
                ->where('sexo',$sexo);
        })->count();
        return $cantidad;

}
function ceros($numero){
        $largo = strlen($numero);
        $ceros=null;
        for($i=$largo;$i<5;$i++){
                $ceros=$ceros."0";
        }
        return $ceros.$numero;
}
function primeros($id,$ciclo){
        //$ciclo = 'IV';
        $array = [];
        $creditos = 0;
        $sumaNotas=0;
        $promedios=[];
        $listaPromedios=[];
        $lista=[];
        $suma=0;
        $total =0;
        //voy a calcular todas las notas pertenecientes al ciclo
        //necesito el periodo de la matricula
        //necesito el ciclo de la matricula
        //necesito el carrera
        //ahora tambien puede ser que tenga muchas periodos de matricula para ese ciclo
        $estudiante = Estudiante::findOrFail($id);
        //calculamos los creditos totales
        $unidades = Udidactica::whereHas('modulo',function($query) use($estudiante,$ciclo){
                $query->where('carrera_id',$estudiante->postulante->idCarrera)
                ->where('ciclo',$ciclo);
        })->get();
        foreach ($unidades as $unidad) {
                # code...
                $creditos = $creditos + $unidad->creditos;
        }

        //revizamos las  matriculas del estudiante
        $matriculas = Ematricula::whereHas('detalles.unidad',function($query) use ($ciclo,$estudiante){
                $query->where('ciclo',$ciclo)->where('estudiante_id',$estudiante->id);
        })->get();
        

        //tengo que sacar las notas en cada periodo
        foreach ($matriculas as $matricula) {
                # code...
                //buscar las notas para sacar el promedio
                foreach ($matricula->detalles as $detalle) {
                        # code...
                        if ($detalle->unidad->ciclo == $ciclo){
                                $sumaNotas = $sumaNotas + ($detalle->nota * $detalle->unidad->creditos);
                        }
                }
                //luego de sumar las notas ahora vamos a agregarla a un array
                if($sumaNotas>0){
                        $total = round($sumaNotas / $creditos,2);
                        array_push($promedios,$total);
                        $sumaNotas=0;
                }
                //tengo q obtener el periodo y el ciclo para obtener la lista de los estudiantes
                //vamos a poner las notas
                $matricula_alumnos = Ematricula::whereHas('detalles.unidad',function($query) use ($ciclo,$matricula){
                        $query->where('ciclo',$ciclo)->where('pmatricula_id',$matricula->pmatricula_id);
                })->whereHas('estudiante.postulante.carrera',function($sql) use($estudiante){
                        $sql->where('idCarrera',$estudiante->postulante->carrera->idCarrera);
                })
                ->get();
                //ahora vamos a sacar las los promedios de todos
                foreach ($matricula_alumnos as $alumno) {
                        # code...
                        foreach ($alumno->detalles as $detalle) {
                                # code...
                                if($detalle->unidad->ciclo == $ciclo){
                                        if($detalle->tipo == 'Regular' || $detalle->tipo == 'Repitencia'){
                                                //ahora si vamos a calcular las notas
                                                $suma = $suma + $detalle->nota*$detalle->unidad->creditos;
                                        }
                                }
                        }
                        //aca calculo la nota para crear el array con las notas
                        $pro = round($suma / $creditos,2);   
                        array_push($lista,$pro);
                        $suma=0;                     
                }
                //la agrego al array principal
                rsort($lista);
                $solo = array_values(array_unique($lista));
                //busco la nota en el array
                $puesto = array_search($total,$solo)+1;
                array_push($array,['nota'=>$total,'puesto'=>$puesto,'periodo'=>$matricula->matricula->nombre]);
                $lista = [];
        }
        $objeto = (object)$array;
        return $objeto;      
}
function total_notas($estado,$carrera_id,$pmatricula_id){
        /* $estudiantes = Estudiante::whereHas('postulante',function ($query) use($carrera_id,$pmatricula_id){
                $query->where('idCarrera','=',$carrera_id)
                ->where('pmatricula_id','=',$pmatricula_id);
        })->get(); */
        $matriculas = Ematricula::whereHas('estudiante.postulante',function ($query) use($carrera_id,$pmatricula_id){
                $query->where('idCarrera','=',$carrera_id)
                ->where('pmatricula_id','=',$pmatricula_id);
        })->get();
        //vamos a recorrer los detalles de cada uno
        $ponderados = [];
        foreach ($matriculas as $matricula) {
                # code...
                $notas = 0;
                $suma_creditos = 0;
                $cantidad_creditos = 0;
                foreach( $matricula->detalles as $detalle){
                        if ($detalle->tipo == "Regular"){
                                $notas = $notas + $detalle->nota;
                        }
                }
                array_push($ponderados,$notas);
        }
        return json_encode($ponderados);
        /* $matriculas = EmatriculaDetalle::whereHas('matricula.estudiante.postulante',function ($query) use($carrera_id,$pmatricula_id){
                $query->where('idCarrera','=',$carrera_id)
                ->where('pmatricula_id','=',$pmatricula_id);
        })->where('tipo','Regular')
        ->get(); */
        

        return $matriculas;
}
function fueenviado($move,$document){
        $ultimo = Dmove::where('document_id','=',$document)
        ->orderBy('id','desc')
        ->first();
        
        if ($ultimo->id == $move){
                return false;
        }else{
                return true;
        }
        
}
function totalfolios($id){
        $dmove = Dmove::findOrFail($id);
        $movimientos = Dmove::where('id','<=',$id)
        ->where('document_id','=',$dmove->documento->id)
        ->get();
        $cantidad = $dmove->documento->folios;
        foreach ($movimientos as $key => $movimiento) {
                # code...
                $cantidad = $cantidad + $movimiento->folios;
        }
        return $cantidad;
}
function notacriterio($indicadore_id,$ematricula_detalle_id){
        try {
                //code...
                $indicadore_detalle = IndicadoreDetalle::where('ematricula_detalle_id','=',$ematricula_detalle_id)
                ->where('indicadore_id',$indicadore_id)->first();
                return $indicadore_detalle->nota;
        } catch (\Throwable $th) {
                //throw $th;
                return 0;
        }
}
function capacidad_cerrado($id){
        $uasignada = Uasignada::findOrFail($id);
        if ($uasignada->periodo->plan_cerrado == true)
                if(isset($uasignada->apertura->fecha)){
                $fecha_hora = Carbon::create(date('Y',strtotime($uasignada->apertura->fecha)),date('m',strtotime($uasignada->apertura->fecha)),date('d',strtotime($uasignada->apertura->fecha)),date('h',strtotime($uasignada->apertura->fecha)),date('i',strtotime($uasignada->apertura->fecha)),date('s',strtotime($uasignada->apertura->fecha)));
                $diferencia = Carbon::now()->greaterThan($fecha_hora);
                return ($diferencia); 
                        if($diferencia<25){
                                return false;
                        }else{
                                return true;
                        }
                }else{
                        return true;
                }
        else{
                return false;
        }
}
function calificacion_cerrado($id){
        try {
                //code...                
                $indicador = Indicadore::findOrFail($id);
                $actual = Carbon::now();
                $fecha = Carbon::parse($indicador->fecha);
                return $actual->greaterThan($fecha);
        } catch (\Throwable $th) {
                //throw $th;
                return $th->getMessage();
        }
}
function indicador_calificacion($indicador_id,$ematricula_detalle_id){
        try {
                //code...
                $indicadore_detalle = IndicadoreDetalle::where('indicadore_id','=',$indicador_id)
                ->where('ematricula_detalle_id','=',$ematricula_detalle_id)
                ->first();
                if(isset($indicadore_detalle->nota)){
                        return $indicadore_detalle->nota;
                }else{
                        return 0;
                }
                
        } catch (\Throwable $th) {
                //throw $th;
                return $th->getMessage();
        }
}
function letras($num){
        $letras = [
                0=>'cero',
                1=>'uno',
                2=>'dos',
                3=>'tres',
                4=>'cuatro',
                5=>'cinco',
                6=>'seis',
                7=>'siete',
                8=>'ocho',
                9=>'nueve',
                10=>'diez',
                11=>'once',
                12=>'doce',
                13=>'trece',
                14=>'catorce',
                15=>'quince',
                16=>'dieciséis',
                17=>'diecisiete',
                18=>'dieciocho',
                19=>'diecinueve',
                20=>'veiente'
        ];
        return $letras[$num];
}