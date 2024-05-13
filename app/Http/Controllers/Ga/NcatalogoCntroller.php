<?php

namespace App\Http\Controllers\Ga;

use App\Http\Controllers\Controller;
use App\Models\Gadministrativa\NacionalCatalogo;
use Illuminate\Http\Request;

class NcatalogoCntroller extends Controller
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
    public function getCatalogos(){
        $arr = [];
        $grupos = NacionalCatalogo::select('grupo')
        ->groupBy('grupo')->get();
        foreach ($grupos as $key => $grupo) {
            # code...
            $c = [];
            //llenamos las clases que 
            $clases = NacionalCatalogo::select('clase')
            ->where('grupo','=',$grupo->grupo)
            ->groupBy('clase')
            ->get();
            foreach ($clases as $clase) {
                # code...
                $i = [];
                $catalogos = NacionalCatalogo::where('grupo','=',$grupo->grupo)
                ->where('clase','=',$clase->clase)->get();
                foreach ($catalogos as $catalogo) {
                    # code...
                    $i [] = [
                        'id'=>$catalogo->id,
                        'denominacion'=>$catalogo->denominacion,
                    ];
                }
                $c [] = [
                    'clase'=>$clase->clase,
                    'catalogos'=>$i,
                ];
            }
            $arr [] = [
                'grupo'=>$grupo->grupo,
                'clases'=>$c,
            ];
        }
        return $arr;
    }
}
