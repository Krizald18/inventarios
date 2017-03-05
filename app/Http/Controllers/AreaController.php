<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Area;

class AreaController extends Controller
{
    public function __construct()
    {
        $this->middleware(['cors', 'auth:api']);
    }

    public function index()
    {
        return Area::all();
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
        return Area::find($id);
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