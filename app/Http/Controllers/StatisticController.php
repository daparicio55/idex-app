<?php

namespace App\Http\Controllers;

use App\Models\Admisione;
use App\Models\Carrera;
use App\Models\Pmatricula;
use Illuminate\Http\Request;

class StatisticController extends Controller
{
    //
    public function website(){
        $carreras = Carrera::where('observacionCarrera','=','visible')->orderBy('nombreCarrera','asc')->get();
        $admisiones = Admisione::orderBy('nombre','desc')->take(2)->get();
        $periodos = Pmatricula::orderBy('nombre','desc')->take(4)->get();
        return view('statistics.website',compact('admisiones','carreras','periodos'));
    }
}
