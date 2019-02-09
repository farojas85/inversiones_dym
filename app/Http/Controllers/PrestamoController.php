<?php

namespace App\Http\Controllers;

use App\Prestamo;
use App\Cliente;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PrestamoController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:prestamos.create')->only(['create','store']);
        $this->middleware('permission:prestamos.index')->only('index');
        $this->middleware('permission:prestamos.edit')->only(['edit','update']);
        $this->middleware('permission:prestamos.show')->only('show');
        $this->middleware('permission:prestamos.destroy')->only('destroy');
        $this->middleware('permission:prestamoTable')->only('table');
    }
    public function index()
    {
        $prestamos = Prestamo::all();
        return view('prestamo.deuda.index',compact('prestamos'));
    }

    public function create()
    {
        $clientes = Cliente::select(DB::raw("CONCAT(nombres,' ',apellidos) AS nombres"),'id')
                            ->pluck('nombres','id');
        return view('prestamo.deuda.create',compact('clientes'));
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Prestamo $prestamo)
    {
        //
    }

    public function edit(Prestamo $prestamo)
    {
        //
    }

    public function update(Request $request, Prestamo $prestamo)
    {
        //
    }

    public function destroy(Prestamo $prestamo)
    {
        //
    }
}
