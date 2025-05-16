<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        parent::__construct(); // Asegura que el constructor de Controller se llame correctamente
        $this->middleware('role:admin'); // Middleware para restringir acceso
    }

    public function index()
    {
        return view('admin.dashboard'); // Carga la vista del dashboard admin
    }
}
