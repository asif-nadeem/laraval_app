<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminsController extends Controller
{
    //

    public function showLoginForm(){
        if (auth()->guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        } else {
            return view('admin.login');
        }

    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        // Try login using guard admin
        if (Auth::guard('admin')->attempt([
            'email'    => $request->email,
            'password' => $request->password,
        ])) {
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors([
            'email' => 'Invalid email or password.',
        ]);
    }

    public function dashboard()
    {
        return view('admin.dashboard'); // your dashboard view
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }

}
