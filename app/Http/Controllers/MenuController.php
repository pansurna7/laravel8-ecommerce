<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class MenuController extends Controller
{
    public function index()
    {
        $data['menus']=Menu::all();
        return view('admin.ACL.menu.menu-list',$data);
    }
    public function store(Request $request)
    {
        $menu= new Menu();
        $menu->menu=$request->name;
        $menu->icon_left=$request->left_icon;
        $menu->icon_right=$request->right_icon;
        $menu->save();
        toast('Menu Created Success Fully','success');
        return redirect()->route('menu.index');
    }
}
