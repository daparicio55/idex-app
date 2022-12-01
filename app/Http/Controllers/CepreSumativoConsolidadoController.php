<?php

namespace App\Http\Controllers;

use App\Models\Cepre;
use App\Models\CepreEstudiante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CepreSumativoConsolidadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $cepres = Cepre::orderBy('idCepre','desc')->pluck('periodoCepre','idCepre')->toArray();
        $idCepre = $request->idCepre;
        if(isset($idCepre)){
            //vamos a verificar que el proceso tenga mas de 2 sumativos
            $cepre = Cepre::findOrFail($idCepre);
            if (count($cepre->sumativos)>1){
                $estudiantes = CepreEstudiante::where('idCepre','=',$cepre->idCepre)
                ->where('sumatorio','=','SI')
                ->get();
                //ahora tengo q pasar los resultados a otra tabla: para mostrar los resultados
                $resultados = DB::table('cepre_sumativo_resultados as csr')
                ->select('csr.dni','csr.apellido','csr.nombre','csr.carrera',DB::raw('SUM(csr.puntaje) as puntaje'))
                ->join('cepre_sumativos as cs','cs.id','=','csr.cepre_sumativo_id')
                ->join('cepres as c','c.idCepre','=','cs.cepre_id')
                ->groupBy('csr.dni','csr.apellido','csr.nombre','csr.carrera')
                ->orderBy('csr.carrera','asc')
                ->orderBy('puntaje','desc')
                ->where('c.idCepre','=',$cepre->idCepre)
                ->get();
                //ahora vamos a mandar a una vista para mostrar los resultados
                return view('cepres.sumativos.consolidados.resultados',compact('cepre','resultados'));
            }else{
                //mostramos un mensaje de error
                dd('error');
            }
        }
        
        return view('cepres.sumativos.consolidados.index',compact('cepres'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
