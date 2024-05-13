<?php

namespace App\Http\Controllers\Ga;

use App\Http\Controllers\Controller;
use App\Models\Marca;
use Illuminate\Http\Request;

class MarcaController extends Controller
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
            $marca = new Marca();
            $marca->nombre = $request->nombre;
            $marca->save();
            $arry = [
                'message'=>'se guardo correctamente la nueva marca',
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
    public function getMarcas(){
        $marcas = Marca::orderBy('nombre','asc')
        ->get();
        return $marcas;
    }
}
