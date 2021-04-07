<?php

namespace App\Http\Controllers;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
   public function index()
   {
       $data['roles']= Role::all();
       return view('admin.ACL.role.role-list',$data);
   }

   public function create(){
       return view('admin.ACL.role.role-add');
   }
   public function store(Request $request)
   {
    $request->validate([
        'name' => 'required|unique:roles|max:255',

    ]);
     Role::create($request->all());
     return redirect()->route('role.index')->with('sms','Role Created');
    }
    public function destroy($id)
    {
        Role::destroy($id);
        return back()->with('sms','Role Deleted');

    }
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles'

        ]);
        $role=Role::find($request->id);
        $role->name = $request->name;
        $role->update();
        toast('User Updated','success');
        return back()->with('sms','Role updated');
    }
}
