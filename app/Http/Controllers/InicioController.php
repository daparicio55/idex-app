<?php

namespace App\Http\Controllers;

use App\Models\User;
use DragonCode\Contracts\Cashier\Auth\Auth;
use Illuminate\Http\Request;

class InicioController extends Controller
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
    public function index()
    {
        return view("inicio.index");
    }
}
