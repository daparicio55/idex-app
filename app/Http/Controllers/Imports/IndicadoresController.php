<?php

namespace App\Http\Controllers\Imports;

use App\Http\Controllers\Controller;
use App\Imports\NotasExcel;
use Illuminate\Http\Request;

use Maatwebsite\Excel\Facades\Excel;

class IndicadoresController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function store(Request $request){
        /* $request->validate(
            'file','required',
        ); */
        $array=[];
        $ar = (Excel::toArray(new  NotasExcel, request()->file('file')));
        //return $ar[0][1];
        foreach ($ar[0] as $a) {
            # code...
            $b=[
                'dni'=>$a[0],
                'nota'=>$a[1],
            ];
            array_push($array,$b);
        }
        return json_encode($array);
    }
}
