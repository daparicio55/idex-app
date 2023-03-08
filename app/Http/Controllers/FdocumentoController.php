<?php

namespace App\Http\Controllers;

use App\Models\Dmove;
use App\Models\Tmove;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class FdocumentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $tmove = Tmove::where('nombre','=','Finalizado')->first();
        $finalizados = Dmove::where('recive_id','=',auth()->id())
        ->where('tmove_id','=',$tmove->id)
        ->orderBy('fecha','desc')
        ->orderBy('hora','desc')
        ->get();
        return view('tdocumentario.finalizados.index',compact('finalizados'));
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
    public function recepcion($id){       
        try {
            //code...
            DB::beginTransaction();
            $dmovimiento = Dmove::findOrFail($id);
            $fecha = date('Y-m-d',strtotime(Carbon::now()));
            $hora = date('H:i:s',strtotime(Carbon::now()));
            $dmovimiento->rfecha = $fecha;
            $dmovimiento->rhora = $hora;
            $dmovimiento->revisado = 'SI';
            $dmovimiento->update();
            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return Redirect::to('tdocumentario/fdocumentos')->with('error',$th->getMessage());
        }
        return Redirect::to('tdocumentario/fdocumentos')->with('info','se archivo el documento correctamente');
    }
}
