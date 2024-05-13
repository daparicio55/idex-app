<?php

namespace App\Http\Controllers\Ga;

use App\Http\Controllers\Controller;
use App\Models\Tipo;
use Illuminate\Http\Request;

class TipoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $arry = [];
        try {
            //code...
            $tipo = new Tipo();
            $tipo->nombre = $request->nombre;
            $tipo->save();
            $arry = [
                'message'=>'se guardo correctamente el tipo',
            ];
            return $arry;
        } catch (\Throwable $th) {
            //throw $th;
            $arry = [
                'message'=>$th->getMessage()
            ];
            return $arry;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function getTipos(){
        $tipos = Tipo::orderBy('nombre','asc')
        ->get();
        return $tipos;
    }
}
