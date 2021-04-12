<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use \Auth;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        $dbmenu=Menu::all();
        if($request->ajax()){
            return datatables()->of($dbmenu)
            ->addColumn('action', function($dbmenu){
                if (@isset(Auth::guard('admin')->user()->role->parmission['parmission']['menu']['edit'])){
                    $button = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$dbmenu->id.'" data-original-title="Edit" class="edit-menu btn btn-info btn-sm edit-menu"><i class="far fa-edit"></i> Edit</a>';
                }else{
                    $button = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$dbmenu->id.'" data-original-title="Edit" class="edit-menu btn btn-info btn-sm edit-menu disabled" aria-disabled="true"><i class="far fa-edit"></i> Edit</a>';
                }
                $button .= '&nbsp;&nbsp;';
                if(isset(Auth::guard('admin')->user()->role->parmission['parmission']['menu']['delete'])){
                    $button .= '<a  href="javascript:void(0)" menu-id="'.$dbmenu->id.'" menu-name="'.$dbmenu->menu.'" id="'.$dbmenu->id.'" class="delete-menu btn btn-danger btn-sm"><i class="far fa-trash-alt"></i> Delete</a>';     
                }else{
                    $button .= '<a href="javascript:void(0)" name="delete" id="'.$dbmenu->id.'" class="delete-menu btn btn-danger btn-sm disabled" aria-disabled="true"><i class="far fa-trash-alt"></i> Delete</a>';     
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
        // toast('Menu Created Success Fully','success');
        // return redirect()->route('menu.index');
    }
}
