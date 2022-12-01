<?php

namespace App\Http\Controllers;

use App\Models\Oficina;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:accesos.usuarios.index')->only('index');
        $this->middleware('can:accesos.usuarios.create')->only('create','store');
        $this->middleware('can:accesos.usuarios.edit')->only('edit','update');
        $this->middleware('can:accesos.usuarios.destroy')->only('destroy');
        $this->middleware('can:accesos.usuarios.show')->only('show');
    } 
    public function index(Request $request)
    {
        //
        $searchText = null;
        if (isset($request->searchText)) {
            # code...
            //ahora que hay código vamos a buscar
            $searchText = $request->searchText;
            $usuarios = User::where('name','LIKE','%'.$searchText.'%')
            ->orWhere('email','LIKE','%'.$searchText.'%')->get();
        }else{
            $usuarios = User::all();
        }
        return view('accesos.usuarios.index',compact('usuarios','searchText'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $roles = Role::all();
        $oficinas = Oficina::pluck('nombre','idOficina')->toArray();
        return view('accesos.usuarios.create',compact('oficinas','roles'));
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
            //code... Hash::make
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->idOficina = $request->idOficina;
            $user->password = Hash::make($request->password);
            $user->save();
            $user->roles()->sync($request->roles);
        } catch (\Throwable $th) {
            //throw $th;
            return Redirect::to('accesos/usuarios/')->with('error','el  usuario no se creo correctamente, error: '.$th->getMessage());
        }
        return Redirect::to('accesos/usuarios/')->with('info','el nuevo usuario se registro correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //vamos poner roles UserRoleController
        //tenemos que verificar si ya existe roles en el base de datos
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $usuario)
    {
        //
        $oficinas = Oficina::pluck('nombre','idOficina')->toArray();
        $roles = Role::all();
        return view('accesos.usuarios.edit',compact('oficinas','usuario','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        //
        try {
            $usuario = User::findOrFail($id);
            $usuario->name = $request->name;
            $usuario->email = $request->email;
            $usuario->idOficina = $request->idOficina;
            if(isset($request->password)){
                $usuario->password = Hash::make($request->password);
            }
            $usuario->update();
            $usuario->roles()->sync($request->roles);
        } catch (\Throwable $th) {
            //throw $th;
            return Redirect::to('accesos/usuarios/')->with('error','el  usuario no se actualizo correctamente, error: '.$th->getMessage());
        }
        return Redirect::to('accesos/usuarios/')->with('info','el  usuario se actualizo correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $usuario = User::findOrFail($id);
            $usuario->delete();
        } catch (\Throwable $th) {
            //throw $th;
            return Redirect::to('accesos/usuarios/')->with('error','el  usuario no se elimino correctamente, error: '.$th->getMessage());
        }
        return Redirect::to('accesos/usuarios/')->with('info','el  usuario se elimino correctamente');
    }
}
