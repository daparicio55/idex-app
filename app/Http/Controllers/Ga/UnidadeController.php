<?php

namespace App\Http\Controllers\Ga;

use App\Http\Controllers\Controller;
use App\Models\Gadministrativa\Unidade;
use Illuminate\Http\Request;

class UnidadeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
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
        //
        $arry = [];
        try {
            //code...
            $unidade = new Unidade();
            $unidade->nombre = $request->nombre;
            $unidade->save();
            $arry = [
                'message'=>'se guardo correctamente la unidad',
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
    public function getUnidades(){
        $unidades = Unidade::orderBy('nombre','asc')->get();
        return $unidades;
    }
}
