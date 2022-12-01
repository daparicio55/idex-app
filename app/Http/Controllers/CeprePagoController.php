<?php

namespace App\Http\Controllers;

use App\Models\CepreEstudiante;
use App\Models\CeprePago;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class CeprePagoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:cepres.pagos.index')->only('index');
        $this->middleware('can:cepres.pagos.create')->only('create','store');
        $this->middleware('can:cepres.pagos.edit')->only('edit','update');
        $this->middleware('can:cepres.pagos.destroy')->only('destroy');
        $this->middleware('can:cepres.pagos.show')->only('show');
    }
    public function index()
    {
        //
        $ceprepagos = CeprePago::orderBy('idCeprePago','desc')->get();
        return view('cepres.pagos.index',compact('ceprepagos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $cepreEstudiantes = DB::table('cepre_estudiantes as ce')
        ->select('ce.idCepreEstudiante',DB::raw('CONCAT("CEPRE AÑO: ",cep.periodoCepre, " - " ,c.dniRuc," - ",c.apellido,", ",c.nombre," - ",car.nombreCarrera) as nombre'))
        ->join('clientes as c','c.idCliente','=','ce.idCliente')
        ->join('ccarreras as car','car.idCarrera','=','ce.idCarrera')
        ->join('cepres as cep','cep.idCepre','=','ce.idCepre')
        ->get()->toArray();
        return view('cepres.pagos.create',compact('cepreEstudiantes'));
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
        try {
            //code...
            CeprePago::create($request->all());
        } catch (\Throwable $th) {
            //throw $th;
            return Redirect::to('cepres/pagos')->with('error','no se registro el pago correctamente, error: '.$th->getMessage());
        }
        return Redirect::to('cepres/pagos')->with('info','se registro el pago correctamente');
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
        $ceprepago = CeprePago::findOrFail($id);
        $cepreEstudiantes = DB::table('cepre_estudiantes as ce')
        ->select('ce.idCepreEstudiante',DB::raw('CONCAT("CEPRE AÑO: ",cep.periodoCepre, " - " ,c.dniRuc," - ",c.apellido,", ",c.nombre," - ",car.nombreCarrera) as nombre'))
        ->join('clientes as c','c.idCliente','=','ce.idCliente')
        ->join('ccarreras as car','car.idCarrera','=','ce.idCarrera')
        ->join('cepres as cep','cep.idCepre','=','ce.idCepre')
        ->get()
        ->toArray();
        return view('cepres.pagos.edit',compact('ceprepago','cepreEstudiantes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        //
        try {
            //code...
            $ceprepago = CeprePago::findOrFail($id);
            $ceprepago->update($request->all());
        } catch (\Throwable $th) {
            //throw $th;
            return Redirect::to('cepres/pagos')->with('error','no se actualizo el pago, error: '.$th->getMessage());
        }
        return Redirect::to('cepres/pagos')->with('info','se registro el pago correctamente');
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
        try {
            //code...
            $ceprepago = CeprePago::findOrFail($id);
            $ceprepago->delete();
        } catch (\Throwable $th) {
            //throw $th;
            return Redirect::to('cepres/pagos')->with('error','no se elmino el pago, error: '.$th->getMessage());
        }
        return Redirect::to('cepres/pagos')->with('info','se elmino el registro correctamente');
    }
}
