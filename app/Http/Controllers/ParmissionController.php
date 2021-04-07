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
        //  'role_id' => 'required',
        //  'parmission' => 'required',

     ]);
        Parmission::create($request->all());
        toast('Parmission Created Success Fully','success');
        return redirect()->route('parmission.index');
     }
     public function destroy($id)
     {
         Parmission::destroy($id);
         toast('Parmission Delete','success');
         return back();

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
         toast('Parmission Updated','success');
         return redirect()->route('parmission.index');
     }
}
