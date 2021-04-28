<?php

namespace App\Http\Controllers;

use App\Models\SubMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubMenuController extends Controller
{
    public function index(Request $request)
    {
        // $sbmenu=SubMenu::all();
        $sbmenu=Submenu::latest()->get();
        //  dd($data);

        if($request->ajax()){
            return datatables()->of($sbmenu)
            ->addColumn('parent',function($data){
                return $data->menu->menu;
            })
            ->addColumn('action', function($data){
                if (@isset(Auth::guard('admin')->user()->role->parmission['parmission']['menu']['edit'])){
                    $button = '<a href="javascript:void(0)" data-toggle="tooltip"  sbmenu-id="'.$data->id.'"  sbmenu-name="'.$data->title.'" data-original-title="Edit"  class="edit-sbmenu btn btn-info btn-sm"><i class="far fa-edit"></i> Edit</a>';
                }else{
                    $button = '<a href="javascript:void(0)" data-toggle="tooltip"  sbmenu-id="'.$data->id.'" data-original-title="Edit" class="edit-sbmenu btn btn-info btn-sm disabled" aria-disabled="true"><i class="far fa-edit"></i> Edit</a>';
                }
                $button .= '&nbsp;&nbsp;';
                if(isset(Auth::guard('admin')->user()->role->parmission['parmission']['menu']['delete'])){
                    $button .= '<a  href="javascript:void(0)" sbmenu-id="'.$data->id.'" sbmenu-name="'.$data->title.'" id="'.$data->id.'" class="delete-sbmenu btn btn-danger btn-sm"><i class="far fa-trash-alt"></i> Delete</a>';
                }else{
                    $button .= '<a href="javascript:void(0)"  sbmenu-id="'.$data->id.'" class="delete-sbmenu btn btn-danger btn-sm disabled" aria-disabled="true"><i class="far fa-trash-alt"></i> Delete</a>';
                }
                return $button;
            })
            ->rawColumns(['parent','action'])
            ->addIndexColumn()
            ->make(true);

        }
        return view('admin.ACL.menu.menu-list');

        // return view('admin.ACL.menu.menu-list');
        // return view('admin.include.sidebar')->with('menus',$smenu);

    }

    public function store(Request $request)
    {
        $sbmenu= new SubMenu();
        $sbmenu->menu_id=$request->parent;
        $sbmenu->title=$request->sub_menu_name;
        $sbmenu->slug=$request->slug;
        $sbmenu->icon=$request->sb_icon_add;

        $save=$sbmenu->save();
        if($save){
            return response()->json(['data'=>$sbmenu,
            'text'=>'Menu Created Success Fully'],200);
        }else{
            return response()->json(['data'=>$sbmenu,
            'text'=>'Error']);
        }

    }
    public function edit($id)
    {
        $data=SubMenu::find($id);
        // dd($data);
        return response()->json(['data' => $data]);
    }
    public function update(Request $request)
    {

        $sbmenu=SubMenu::find($request->id);
        $sbmenu->menu_id=$request->parent;
        $sbmenu->title=$request->sub_menu_edit_name;
        $sbmenu->slug=$request->slug_edit;
        $sbmenu->icon=$request->sb_icon_edit;
        $save=$sbmenu->save();
        if($save){
            return response()->json(['data'=>$sbmenu,
            'msg'=>'Sub Menu UpdateSuccess Fully'],200);
        }else{
            return response()->json(['data'=>$sbmenu,
            'msg'=>'Error']);
        }
    }
    public function destroy($id)
    {

    SubMenu::destroy($id);
    return response()->json(['msg'=>'Record Deleted SuccessFully']);

    }
}
