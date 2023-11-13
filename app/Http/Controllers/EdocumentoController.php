<?php

namespace App\Http\Controllers;

use App\Models\Dmove;
use App\Models\Tmove;
use App\Models\User;
use Illuminate\Http\Request;

class EdocumentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        //
        $users = User::where('visibility_tramite','=',true)->orderBy('name','asc')->get();
        $tmove = Tmove::where('nombre','=','Enviado')->first();
        $enviados = Dmove::where('envia_id','=',auth()->id())
        ->where('tmove_id','=',$tmove->id)
        ->orderBy('fecha','desc')
        ->orderBy('hora','desc')
        ->paginate(10);
        if($request->buscar == 'si'){
            if($request->oficinas == 0){
                $enviados = Dmove::where('envia_id','=',auth()->id())
                ->whereBetween('fecha',[$request->finicio,$request->ffin])
                ->where('tmove_id','=',$tmove->id)
                ->orderBy('fecha','desc')
                ->orderBy('hora','desc')
                ->whereHas('documento.cliente',function($query) use($request){
                    $query->where('asunto','like','%'.$request->asunto.'%')
                    ->where('numero','like','%'.$request->numero.'%')
                    ->where('dniRuc','like','%'.$request->dniRuc.'%');
                })->get();
            }else{
                $user = User::findOrFail($request->oficinas);
                $u = $user->id;
                if(isset($user->oficina->responsable->id)){
                    $u= $user->oficina->responsable->id;
                }
                $enviados = Dmove::where('envia_id','=',auth()->id())
                ->whereBetween('fecha',[$request->finicio,$request->ffin])
                ->where('tmove_id','=',$tmove->id)
                ->where('reciveresponsable_id','=',$u)
                ->orderBy('fecha','desc')
                ->orderBy('hora','desc')
                ->whereHas('documento.cliente',function($query) use($request){
                    $query->where('asunto','like','%'.$request->asunto.'%')
                    ->where('numero','like','%'.$request->numero.'%')
                    ->where('dniRuc','like','%'.$request->dniRuc.'%');
                })->get();
            }
        }
        return view('tdocumentario.enviados.index',compact('enviados','request','users'));
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
