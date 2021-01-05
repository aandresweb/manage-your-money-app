<?php

namespace App\Http\Controllers;

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

    public function logout()
    {
        Auth::logout();
        return back();
    }
}
