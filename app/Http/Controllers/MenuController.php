<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\SubMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        $dbmenu=Menu::all();

        // dd($dbmenu,$sbmenu);
         if($request->ajax()){
            return datatables()->of($dbmenu)
            ->addColumn('action', function($data){
                if (@isset(Auth::guard('admin')->user()->role->parmission['parmission']['menu']['edit'])){
                    $button = '<a href="javascript:void(0)" data-toggle="tooltip"  menu-id="'.$data->id.'"  menu-name="'.$data->menu.'" data-original-title="Edit"  class="edit-menu btn btn-info btn-sm"><i class="far fa-edit"></i> Edit</a>';
                }else{
                    $button = '<a href="javascript:void(0)" data-toggle="tooltip"  menu-id="'.$data->id.'" data-original-title="Edit" class="edit-menu btn btn-info btn-sm edit-menu disabled" aria-disabled="true"><i class="far fa-edit"></i> Edit</a>';
                }
                $button .= '&nbsp;&nbsp;';
                if(isset(Auth::guard('admin')->user()->role->parmission['parmission']['menu']['delete'])){
                    $button .= '<a  href="javascript:void(0)" menu-id="'.$data->id.'" menu-name="'.$data->menu.'" id="'.$data->id.'" class="delete-menu btn btn-danger btn-sm"><i class="far fa-trash-alt"></i> Delete</a>';
                }else{
                    $button .= '<a href="javascript:void(0)"  manu-id="'.$data->id.'" class="delete-menu btn btn-danger btn-sm disabled" aria-disabled="true"><i class="far fa-trash-alt"></i> Delete</a>';
                }
                return $button;
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);

         }
                return view('admin.ACL.menu.menu-list');


    }

    public function store(Request $request)
    {
        $menu= new Menu();
        $menu->menu=$request->name;
        $menu->icon_left=$request->left_icon;
        $menu->icon_right=$request->right_icon;
        $save=$menu->save();
        if($save){
            return response()->json(['data'=>$menu,
            'text'=>'Menu Created Success Fully'],200);
        }else{
            return response()->json(['data'=>$menu,
            'text'=>'Error']);
        }

    }
    public function edit($id)
    {
        $data=Menu::find($id);
        // dd($data);
        return response()->json(['data' => $data]);
    }
    public function update(Request $request)
    {

        $menu=Menu::find($request->id);
        $menu->menu=$request->name2;
        $menu->icon_left=$request->icon_left2;
        $menu->icon_right=$request->icon_right2;
        $save=$menu->save();

        if($save){
            return response()->json(['data'=>$menu,
            'msg'=>'Menu UpdateSuccess Fully'],200);
        }else{
            return response()->json(['data'=>$menu,
            'msg'=>'Error']);
        }
    }
    public function destroy($id)
    {

    Menu::destroy($id);
    return response()->json(['msg'=>'Record Deleted SuccessFully']);

    }


}
