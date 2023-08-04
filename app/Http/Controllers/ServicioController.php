<?php

namespace App\Http\Controllers;

use App\Models\Servicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class ServicioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:ventas.servicios.index')->only('index');
        $this->middleware('can:ventas.servicios.create')->only('create','store');
        $this->middleware('can:ventas.servicios.edit')->only('edit','update');
        $this->middleware('can:ventas.servicios.destroy')->only('destroy');
        $this->middleware('can:ventas.servicios.show')->only('show');
    }
    public function index(Request $request)
    {
        $servicios = Servicio::get();
        return view('ventas.servicios.index',compact('servicios'));
    }
    public function create()
    {
        return view("ventas.servicios.create");
    }
    public function store(Request $request)
    {
        
        $servicio = new Servicio;
        $servicio->nombre=$request->get('nombre');
        $servicio->precio=$request->get('precio');
        $servicio->dias=$request->get('dias');
        $servicio->estado='1';
        $servicio->save();
        
        return Redirect::to('ventas/servicios');
    }
    public function show($id)
    {
        return view("ventas.servicios.show",["servicio"=>Servicio::findOrFail($id)]);
    }
    public function edit($id)
    {
        return view("ventas.servicios.edit",["servicio"=>Servicio::findOrFail($id)]);
    }
    public function update(Request $request,$id)
    {
        $servicio = servicio::findOrFail($id);
        $servicio->nombre=$request->get('nombre');
        $servicio->precio=$request->get('precio');
        $servicio->dias=$request->get('dias');
        $servicio->update();
        return Redirect::to('ventas/servicios');
    }
    public function destroy($id)
    {
        $servicio = Servicio::findOrFail($id);
        if($servicio->estado==1){
            $servicio->estado=0;
        }else{
            $servicio->estado=1;
        }
        $servicio->update();
        return Redirect::to('ventas/servicios');
    }
}
