<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Admin;

class ProfileController extends Controller
{
    public function index()
    {
        $data['admin']= Admin::all();
        return view('profile',$data);
    }
}
