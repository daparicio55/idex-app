<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ColegioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
        /* $this->middleware('can:cepres.pagos.index')->only('index');
        $this->middleware('can:cepres.pagos.create')->only('create','store');
        $this->middleware('can:cepres.pagos.edit')->only('edit','update');
        $this->middleware('can:cepres.pagos.destroy')->only('destroy');
        $this->middleware('can:cepres.pagos.show')->only('show'); */
    }
    public function index()
    {
        //
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
        $colegios = DB::table('colegios')
        ->where('COD_MOD','LIKE','%'.$id.'%')
        ->orWhere('CODLOCAL','LIKE','%'.$id.'%')
        ->orWhere('CEN_EDU','LIKE','%'.$id.'%')
        ->orderBy('D_DPTO','ASC')
        ->orderBy('D_PROV','ASC')
        ->orderBy('D_DIST','ASC')
        ->get();
        return ($colegios);
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
