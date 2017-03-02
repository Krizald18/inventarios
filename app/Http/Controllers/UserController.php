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
    }
    public function getUser($id)
    {
        return User::find($id);
    }
    public function index()
    {
        return User::all();
    }
}