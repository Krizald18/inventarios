<?php

namespace App\Http\Controllers\Auth;

use Auth;
use JWTAuth;
use App\User;
use App\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller {
  public function __construct() {
    $this->middleware('cors');
  }

  public function login(Request $request) {
    $this->validate($request, [
      'username' => 'required|min:5',
      'password' => 'required|min:5',
    ]);

    $credentials = $request->only('username', 'password');
    try {
      // verify the credentials and create a token for the user
      if (! $token = JWTAuth::attempt($credentials)) {
        return response()->error('Credenciales invalidas', 401);
      }
    } catch (\JWTException $e) {
      return response()->error('Error al crear token', 500);
    }

    $user = User::with('admin')->find(Auth::user()->id);
    return response()->success(compact('user', 'token'));
  }

  public function register(Request $request) {
    $this->validate($request, [
      'nombre'   => 'required|min:3',
      'username' => 'required|min:5|unique:users',
      'email'    => 'required|email|unique:users',
      'password' => 'required|min:5',
    ]);

    $user = new User;
    $user->nombre = trim($request->nombre);
    $user->username = trim($request->username);
    $user->email = trim(strtolower($request->email));
    $user->password = bcrypt($request->password);
    $user->save();

    $token = JWTAuth::fromUser($user);

    return response()->success(compact('user', 'token'));
  }
}