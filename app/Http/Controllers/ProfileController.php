<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

class ProfileController extends Controller
{
    public function index()
    {
        $data['admin'] = Admin::all();
        return view('profile', $data);
    }
    public function update(Request $request, Admin $admin)
    {
        $request->validate([
            'name' => 'required|max:30',
            'fullname' => 'required|max:50',
            'divisi' => 'required|max:20',
            'address' => 'required',
            'number' => 'required|numeric',
            'email' => 'required|email|unique:admins,email,' . $admin->id,
            //  'email' => 'required|email|max:255|exists:admins',
            'password' => 'nullable|min:6|max:12',

            'ConfirmPassword' => 'same:password',


        ]);

        if ($request->password === null) {
            $request['password'] = $admin->password;
        } else {
            $request['password'] = Hash::make($request->password);
        }
        unset($request['ConfirmPassword']);
        $name = $request->name;
        $admin->name = $request->name;
        $admin->fullname = $request->fullname;
        $admin->divisi = $request->divisi;
        $admin->address = $request->address;
        $admin->number = $request->number;
        $admin->email = $request->email;
        $admin->password = $request->password;
        if ($request->file === null) {
            $request['file'] = $admin->image;
        } else {
            $imagePath = public_path("/Source/back/dist/img/profile/".$admin->image);
            if(File::exists($imagePath)){
                unlink($imagePath);
            }
            $image = $request->file('file');
            $imageName = $name . '.' . $image->extension();
            $image->move(public_path('/Source/back/dist/img/profile'), $imageName);
            $admin->image = $imageName;
        }

        //   dd($request->all());
        $admin->update();

        Alert::success('lexadev', 'Profile Successfully Updated');
        // toast('User Updated','success');
        return redirect()->route('profile.index');
    }
}
