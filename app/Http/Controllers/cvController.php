<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\cvPersonale;
use App\Models\Pmatricula;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use PDF;
class cvController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:docentes.cvs.index')->only('index');
        $this->middleware('can:docentes.cvs.show')->only('show');
    }
    public function index()
    {
        //
        return view('docentes.cv.index');
    }
    public function show($id)
    {
        $periodo = Pmatricula::orderBy('nombre','desc')->first();
        $personale = cvPersonale::where('user_id','=',$id)->first();
        //$pdf = PDF::loadview('docentes.cv.show',['personale'=>$personale,'periodo'=>$periodo]);
        //return $pdf->download($personale->dni.'.pdf');
        return view('docentes.cv.show',compact('personale','periodo'));        
    }
}
