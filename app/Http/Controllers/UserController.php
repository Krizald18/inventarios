<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use Response;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['cors', 'auth:api']);
    }
    public function allUsers()
    {
        return User::all();
        /*
        $users = User::all();
        if(count(json_decode($users, true)) == 0)
            return Response::json(['response' => 'Empty'], 422);
        return Response::json($users, 200);
        */
    }
    public function getUser($id)
    {
        return User::find($id);
        /*
        $user = User::find($id);
        if(!$user)
            return Response::json(['response' => 'Not found'], 404);
        return Response::json($user, 200);
        */
    }
    public function index()
    {
        return User::all();
    }
}