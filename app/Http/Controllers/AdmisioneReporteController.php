<?php

namespace App\Http\Controllers;

use App\Models\Admisione;
use App\Models\AdmisionePostulante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdmisioneReporteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:admisiones.reportes.index')->only('index');
        $this->middleware('can:admisiones.reportes.create')->only('create','store');
        $this->middleware('can:admisiones.reportes.edit')->only('edit','update');
        $this->middleware('can:admisiones.reportes.destroy')->only('destroy');
        $this->middleware('can:admisiones.reportes.show')->only('show');
    }
    public function index(Request $request)
    {
        //
        $admisiones = Admisione::orderBy('periodo','desc')->pluck('periodo','id')->toArray();
        if(isset($request->id)){
            $admisione = Admisione::findOrFail($request->id);
            $postulantes = AdmisionePostulante::where('admisione_id','=',$admisione->id)
            ->where('anulado','=','NO')
            ->get();
            $anulados = AdmisionePostulante::where('admisione_id','=',$admisione->id)
            ->where('anulado','=','SI')
            ->get();
            $programas = DB::table('admisione_postulantes as ap')
            ->select('c.nombreCarrera as programa',DB::raw("count(*) as cantidad"))
            ->join('ccarreras as c','c.idCarrera','=','ap.idCarrera')
            ->where('ap.anulado','=','NO')
            ->groupBy('c.nombreCarrera')
            ->get();
            //extraordinario ahora exonerados
            $postulantesX = AdmisionePostulante::where('admisione_id','=',$admisione->id)
            ->where('anulado','=','NO')
            ->where('modalidadTipo','=','Exonerado')
            ->orderBy('idCarrera','asc')
            ->orderBy('modalidad','asc')
            ->get();
            $anuladosX = AdmisionePostulante::where('admisione_id','=',$admisione->id)
            ->where('anulado','=','SI')
            ->where('modalidadTipo','=','Exonerado')
            ->get();
            $programasX = DB::table('admisione_postulantes as ap')
            ->select('c.idCarrera','c.nombreCarrera as programa',DB::raw("count(*) as cantidad"))
            ->join('ccarreras as c','c.idCarrera','=','ap.idCarrera')
            ->where('ap.anulado','=','NO')
            ->where('modalidadTipo','=','Exonerado')
            ->groupBy('c.nombreCarrera','c.idCarrera')
            ->get();
            //ordinario
            $postulantesO = AdmisionePostulante::where('admisione_id','=',$admisione->id)
            ->where('anulado','=','NO')
            ->where('modalidadTipo','=','Ordinario')
            ->get();
            $anuladosO = AdmisionePostulante::where('admisione_id','=',$admisione->id)
            ->where('anulado','=','SI')
            ->where('modalidadTipo','=','Ordinario')
            ->get();
            $programasO = DB::table('admisione_postulantes as ap')
            ->select('c.nombreCarrera as programa',DB::raw("count(*) as cantidad"))
            ->join('ccarreras as c','c.idCarrera','=','ap.idCarrera')
            ->where('ap.anulado','=','NO')
            ->where('modalidadTipo','=','Ordinario')
            ->groupBy('c.nombreCarrera')
            ->get();
            return view('admisiones.reportes.index',compact('postulantesO','anuladosO','programasO','postulantesX','anuladosX','programasX','admisiones','anulados','admisione','postulantes','programas'));
        }
        return view('admisiones.reportes.index',compact('admisiones'));
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
