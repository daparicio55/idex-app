<?php

namespace App\Http\Controllers\Ga;

use App\Http\Controllers\Controller;
use App\Models\Gadministrativa\Recepcione;
use Illuminate\Http\Request;

class CodificacioneController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('gadministrativa.patrimonio.codificaciones.index');
    }
    public function create()
    {
        $recepciones = Recepcione::orderBy('numero','desc')->get();
        return view('gadministrativa.patrimonio.codificaciones.create',compact('recepciones'));
    }
}
