<?php

namespace App\Http\Controllers;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Testing\Fluent\Concerns\Has;
use Illuminate\Support\Facades\Auth;
class AdminController extends Controller
{
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
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect(route('login_form'));
    }

    public function dashboard()
    {
        return view('admin.include.home');
    }
}
