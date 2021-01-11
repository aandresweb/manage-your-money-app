<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\RegisterRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function getLogin()
    {
        return view('auth.login');
    }

    public function getRegister()
    {
        return view('auth.register');
    }

    public function login(Request $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            $response = [
                'message' => "You're logged in",
                'success' => true,
            ];
        } else {
            $response = [
                'message' => 'Credentials are wrong...',
                'success' => false
            ];
        }
        return response()->json($response);
    }

    public function register(RegisterRequest $request)
    {
        $emailExists = User::where('email', $request->email)->exists();
        if (!$emailExists) {
            $user = User::create($request->all());
            return response()->json([
                'success' => true,
                'message' => 'Thats it! your username has been created 😁',
                'user' => $user
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'This email is already in use'
            ]);
        }
    }

    public function logout()
    {
        Auth::logout();
        return back();
    }
}
