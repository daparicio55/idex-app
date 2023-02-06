<?php

namespace App\Http\Controllers;

use App\Models\Pmatricula;
use App\Models\Uasignada;
use App\Models\Udidactica;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class UasignadaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:sacademica.uasignadas.index')->only('index');
        $this->middleware('can:sacademica.uasignadas.create')->only('create','store');
        $this->middleware('can:sacademica.uasignadas.edit')->only('edit','update');
        $this->middleware('can:sacademica.uasignadas.destroy')->only('destroy');
        $this->middleware('can:sacademica.uasignadas.show')->only('show');
    }
    public function index(Request $request)
    {
        //
        $text = $request->searchText;
        $uasignadas = Uasignada::orderBy('id','desc')->get();
        if (isset($request->searchText)){
            $uasignadas = Uasignada::orderBy('id','desc')
            ->whereHas('user',function($query) use($text){
                $query->where('name','like','%'.$text.'%');
            })->get();
        }
        return view('sacademica.uasignadas.index',compact('uasignadas','text'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        //$users = User::orderBy('name','desc')->pluck('name','id')->toArray();
        $users = User::orderBy('name','asc')->get();
        $periodos = Pmatricula::orderBy('nombre','desc')->get();
        $unidades = Udidactica::orderBy('nombre','asc')->get();
        return view('sacademica.uasignadas.create',compact('users','unidades','periodos'));
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
            $unidades = $request->udidactica;
            for($i=0; $i<count($unidades);$i++){
                $asignada = new Uasignada();
                $asignada->user_id = $request->user_id;
                $asignada->pmatricula_id = $request->pmatricula_id;
                $asignada->udidactica_id = $unidades[$i];
                $asignada->save();
            }
        } catch (\Throwable $th) {
            //throw $th;
            return Redirect::route('sacademica.uasignadas.index')->with('error',$th->getMessage());
        }
        return Redirect::route('sacademica.uasignadas.index')->with('info','se guardo las asignaciones correctamente');
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
        try {
            //code...
            $uasignada = Uasignada::findOrFail($id);
            $uasignada->delete();
        } catch (\Throwable $th) {
            //throw $th;
            return Redirect::route('sacademica.uasignadas.index')->with('error',$th->getMessage());
        }
        return Redirect::route('sacademica.uasignadas.index')->with('info','se elimino el registro correctamente');
    }
}
