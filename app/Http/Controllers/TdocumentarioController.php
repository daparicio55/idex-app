<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;

class TdocumentarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $anios=[
            '2024'=>'2024',
            '2023'=>'2023',
            '2022'=>'2022',
            '2021'=>'2021'
        ];
        if(isset($request->dni)){
            //vamos a buscar el documento
            $documento = Document::whereHas('cliente',function($query) use($request){
                $query->where('dniRuc','=',$request->dni)
                ->where('numero','=',$request->expediente)
                ->whereYear('fecha','=',$request->anios);
            })->first();
            //dd($documento);
            return view('tdocumentario.check.index',compact('anios','documento'));
        }
        return view('tdocumentario.check.index',compact('anios'));
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
