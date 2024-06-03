<?php

namespace App\Http\Controllers\Ga;

use App\Http\Controllers\Controller;
use App\Models\Gadministrativa\Catalogo;
use App\Models\Gadministrativa\Unidade;
use App\Models\Marca;
use App\Models\Tipo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class CatalogoController extends Controller
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
        $catalogos = Catalogo::orderBy('id','desc')->get();
        return view('gadministrativa.administracion.catalogos.index',compact('catalogos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $marcas = Marca::orderBy('nombre','asc')->get();
        $tipos = Tipo::orderBy('nombre','asc')->get();
        $unidades = Unidade::orderBy('nombre','asc')->get();
        $catalogos = Catalogo::orderBy('codigo','asc')->get();
        return view('gadministrativa.administracion.catalogos.create',compact('marcas','tipos','unidades','catalogos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            //code...
            DB::beginTransaction();
            $catalogo = new Catalogo();
            if(isset($request->codigo)){
                $catalogo->codigo = $request->codigo;
            }
            if(isset($request->modelo)){
                $catalogo->modelo = $request->modelo;
            }
            $catalogo->descripcion = $request->descripcion;
            $catalogo->observacion = $request->observacion;
            $catalogo->marca_id = $request->marcas;
            $catalogo->tipo_id = $request->tipos;
            $catalogo->unidade_id = $request->unidades;
            if(isset($request->cantidad)){
                $catalogo->cantidad = $request->cantidad;
            }
            if(isset($request->padre)){
                $catalogo->padre_id = $request->padre;
            }
            if(isset($request->serie)){
                $catalogo->serie = 1;
            }
            if(isset($request->perecible)){
                $catalogo->perecible = 1;
            }
            $catalogo->save();
            //
            $catalogo->codigo = 'CAT'.ceros($catalogo->id);      
            $catalogo->modelo = 'MOD'.ceros($catalogo->id);
            $catalogo->update();
            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            //dd($th->getMessage());
            return Redirect::route('gadministrativa.administracion.catalogos.index')->with('error','no se guardo el catalogo en la base de datos');
        }
        return Redirect::route('gadministrativa.administracion.catalogos.index')->with('info','se guardo el catalogo en la base de datos');
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
        try {
            //code...
            $catalogo = Catalogo::findOrFail($id);
            $marcas = Marca::orderBy('nombre','asc')->get();
            $tipos = Tipo::orderBy('nombre','asc')->get();
            $unidades = Unidade::orderBy('nombre','asc')->get();
            $catalogos = Catalogo::orderBy('codigo','asc')
            ->whereNot('id','=',$catalogo->id)
            ->get();
        } catch (\Throwable $th) {
            //throw $th;
            return Redirect::route('gadministrativa.administracion.catalogos.index')->with('erro','error cuando se intento editar el catálogo');
        }
        return view('gadministrativa.administracion.catalogos.edit',compact('catalogo','catalogos','tipos','unidades','marcas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        try {
            //code...
            DB::beginTransaction();
            $catalogo = Catalogo::findOrFail($id);
            if(isset($request->codigo)){
                $catalogo->codigo = $request->codigo;
            }else{
                $catalogo->codigo = 'CAT'.ceros($catalogo->id);
            }
            if(isset($request->modelo)){
                $catalogo->modelo = $request->modelo;
            }else{
                $catalogo->modelo = 'MOD'.ceros($catalogo->id);
            }
            $catalogo->descripcion = $request->descripcion;
            $catalogo->observacion = $request->observacion;
            $catalogo->marca_id = $request->marcas;
            $catalogo->tipo_id = $request->tipos;
            $catalogo->unidade_id = $request->unidades;
            if(isset($request->cantidad)){
                $catalogo->cantidad = $request->cantidad;
            }
            if(isset($request->padre)){
                $catalogo->padre_id = $request->padre;
            }else{
                $catalogo->padre_id = NULL;
            }
            if(isset($request->serie)){
                $catalogo->serie = 1;
            }else{
                $catalogo->serie = 0;
            }
            if(isset($request->perecible)){
                $catalogo->perecible = 1;
            }else{
                $catalogo->perecible = 0;
            }
            $catalogo->update();
            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return Redirect::route('gadministrativa.administracion.catalogos.index')->with('error','no se actualizó el catalogo en la base de datos');
        }
        return Redirect::route('gadministrativa.administracion.catalogos.index')->with('info','se actualizó el catalogo en la base de datos');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        try {
            //code...
            $catalogo = Catalogo::findOrFail($id);
            $catalogo->delete();
        } catch (\Throwable $th) {
            //throw $th;
            return Redirect::route('gadministrativa.administracion.catalogos.index')->with('error','no se puede eliminar el catalogo');
        }
        return Redirect::route('gadministrativa.administracion.catalogos.index')->with('info','se elimino el catalogo correctamente');
    }
    public function getCatalogosExcept(Request $request){
        try {
            //code...
            $ids = json_decode(urldecode($request->ids), true);
            $catalogos = Catalogo::whereNotIn('id',$ids)->orderBy('codigo','asc')->get();
            $array = [];
            foreach ($catalogos as $key => $catalogo) {
                # code...
                $array [] = [
                    'id'=>$catalogo->id,
                    'nombre'=>$catalogo->codigo.' - '.$catalogo->modelo.' - '.$catalogo->descripcion.' x '.$catalogo->unidade->nombre,
                ];
            }
            return $array;
        } catch (\Throwable $th) {
            //throw $th;
            $array = [
                'message'=>$th->getMessage()
            ];
            return $array;
        }
    }
}
