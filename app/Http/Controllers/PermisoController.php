<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use PhpParser\Node\Stmt\TryCatch;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermisoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:accesos.permisos.index')->only('index');
        $this->middleware('can:accesos.permisos.create')->only('create','store');
        $this->middleware('can:accesos.permisos.edit')->only('edit','update');
        $this->middleware('can:accesos.permisos.destroy')->only('destroy');
        $this->middleware('can:accesos.permisos.show')->only('show');
    } 
    public function index(Request $request)
    {
        $searchText = null;
        if (isset($request->searchText)) {
            # code...
            //ahora que hay código vamos a buscar
            $searchText = $request->searchText;
            $permissions = Permission::where('description','LIKE','%'.$searchText.'%')
            ->orWhere('name','LIKE','%'.$searchText.'%')->orderBy('name','asc')->get();
        }else{
            $permissions = Permission::orderBy('name','asc')->get();
        }
        return view('accesos.permisos.index',compact('permissions','searchText'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('accesos.permisos.create');
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
            Permission::create($request->all());
        } catch (\Throwable $th) {
            //throw $th;
            return Redirect::to('accesos/permisos')->with('error','no se guardo el permiso correctamente, error: '.$th->getMessage());
        }
        return Redirect::to('accesos/permisos')->with('info','se guardo el permiso correctamente');
        
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
        $permission = Permission::findOrFail($id);
        return view('accesos.permisos.edit',compact('permission'));
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
        $permission = Permission::findOrFail($id);
        $permission->update($request->all());
        return redirect::to('accesos/permisos')->with('info','el permiso se actualizo correctamente');

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
            //code...
            DB::beginTransaction();
            $permission = Permission::findOrFail($id);
            $permission->delete();
            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollback();
            return Redirect::to('accesos/permisos')->with('error','no se puede eliminar el permiso');
        }
        return Redirect::to('accesos/permisos')->with('info','se elimino el permiso correctamente');
    }
}
