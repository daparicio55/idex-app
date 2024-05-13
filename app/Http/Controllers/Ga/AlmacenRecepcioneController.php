<?php

namespace App\Http\Controllers\Ga;

use App\Http\Controllers\Controller;
use App\Models\Gadministrativa\Ocompra;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AlmacenRecepcioneController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        return view('gadministrativa.almacen.recepciones.index');
    }
    public function create() : View {
        $ocompras = Ocompra::get();
        return view('gadministrativa.almacen.recepciones.create',compact('ocompras'));
    }
    public function store(Request $request){
        return $request;
    }
}
