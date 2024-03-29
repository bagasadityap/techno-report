<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index() {
        return view("login");
    }
    public function login(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        if (Auth::attempt($validatedData)) {
            $user = User::where('email', $request->email)->first();
            Auth::login($user);
            return redirect('/dashboard');
        }
        else {
            return 'gagal';
        }
    }
}
