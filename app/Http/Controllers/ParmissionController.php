<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Parmission;

class ParmissionController extends Controller
{
    public function index()
    {
        $data['parmissions']= Parmission::all();
        return view('admin.ACL.parmission.parmission-list',$data);
    }

    public function create(){
        return view('admin.ACL.parmission.parmission-add');
    }
    public function store(Request $request)
    {
     $request->validate([
         'role_id' => 'required',
         'parmission' => 'required',

     ]);
        Parmission::create($request->all());
        return redirect()->route('parmission.index')->with('sms','Parmission Created');
     }
     public function destroy($id)
     {
         Parmission::destroy($id);
         return back()->with('sms','Parmission Deleted');

     }
     public function edit($id)
     {
            $parmission=Parmission::find($id);
            return view('admin.ACL.parmission.parmission-edit',compact('parmission'));
     }
     public function update(Request $request)
     {

         $parmission=parmission::find($request->id);
         $parmission->role_id = $request->role_id;
         $parmission->parmission=$request->parmission;
         $parmission->update();
         return redirect()->route('parmission.index')->with('sms','Parmission updated');
     }
}
