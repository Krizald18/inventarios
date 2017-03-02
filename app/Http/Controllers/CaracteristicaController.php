<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Caracteristica;

class CaracteristicaController extends Controller
{
    public function __construct()
    {
        $this->middleware(['cors', 'auth:api']);
    }
    public function index()
    {
        return Caracteristica::all();
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        return Caracteristica::find($id);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}