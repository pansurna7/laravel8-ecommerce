<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Testing\Fluent\Concerns\Has;
use Illuminate\Support\Facades\Auth;
class AdminController extends Controller
{
    public function user()
    {
        return view('dashboard');
    }

    public function index()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $data=$request->all();
        if(Auth::guard('admin')->attempt(['email' => $data['email'], 'password' => $data['password']])){
            return redirect()->route('admin.dashboard');
        }else{
            return back()->with('error','Check Username or Password');
        }

    }
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect(route('login_form'));

    }

    public function dashboard()
    {
        return view('admin.include.home');
    }
}
