<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginUserController extends Controller
{
    public function login() 
    {
        return view('login');
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required|min:8|string',
        ]);

        if (Auth::guard('web')->attempt(['username' => $request->username, 'password' => $request->password])) {

            $userId = Auth::id();
        
            session([
                'user_id' => $userId,
                'username' => Auth::user()->username,
                'first_name' => Auth::user()->first_name,
                'middle_name' => Auth::user()->middle_name,
                'last_name' => Auth::user()->last_name,
                'role_type' => Auth::user()->role->role_type,
            ]);

            return redirect()->route('Dashboard');
            
        } else {
            return back()->withErrors([
                'login' => 'The provided credentials are incorrect.',
            ]);
        }
    }

    public function logout(Request $request)
    {

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
