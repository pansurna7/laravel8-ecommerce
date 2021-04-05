<?php

namespace App\Http\Controllers;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Testing\Fluent\Concerns\Has;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Validation\Rule;
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


    // =======================ACL Route ========== //
    public function users()
    {
        $users=Admin::latest()->get();
        return view('admin.ACL.user.user-list',compact('users'));
    }

    public function create()
    {
        return view('admin.ACL.user.user-add');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|max:200',
            'email'=>'required|email|unique:admins,email',
            'number'=>'required|numeric',
            'password'=>'required|min:8|max:30',
            'ConfirmPassword'=>'required|same:password',
            'role_id'=>'required',

        ]);
        $name=$request->name;
        $email=$request->email;
        $number=$request->number;
        $role_id=$request->role_id;
        $password=bcrypt($request->password);
        // $image=$request->file('file');
        // $imageName=$name.'.'.$image->extension();
        // $image->move(public_path('/Source/back/dist/img/profile'),$imageName);

        $user= new Admin();
        $user->name=$name;
        $user->number=$number;
        // $user->image=$imageName;
        $user->email=$email;
        $user->role_id=$role_id;
        $user->password=$password;

        $user->save();
        // klu menggunakan sweet aler aktifkan
        // Alert::success('lexadev','User saved successfully');
        // menggunakakan toastr
        toast('User saved successfully','success');
        return redirect()->route('all-user');

    }
    public function edit(Admin $admin )
    {
        return view('admin.ACL.user.user-edit',compact('admin'));

    }

    public function update(Request $request,Admin $admin)
    {
        $request->validate([
            'name'=>'required|max:30',
            'number'=>'required|numeric',
            'email' => 'required|email|unique:admins,email,'.$admin->id,
            //  'email' => 'required|email|max:255|exists:admins',
            'password' => 'nullable|min:6|max:12',

            'ConfirmPassword'=>'same:password',
            'role_id'=>'required',

        ]);

        if($request->password === null)
        {
            $request['password']=$admin->password;
        }else{
            $request['password']=Hash::make($request->password);
        }
        unset($request['ConfirmPassword']);

        $admin->name=$request->name;
        $admin->number=$request->number;
        $admin->email=$request->email;
        $admin->password=$request->password;
        $admin->role_id=$request->role_id;
        // dd($request->all());
         $admin->update();

        // Alert::success('lexadev','User Updated');
        toast('User Updated','success');
        return redirect()->route('all-user');

    }

    public function destroy($id)
    {
        $user= Admin::find($id);
        // unlink(public_path('/Source/back/dist/img/profile').'/'.$user->image);
        $user->delete();
        Alert::success('lexadev','Uuser Destroyed success');
        return back();
    }
}
