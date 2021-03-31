<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function manage()
    {
        $categories=Category::latest()->get();
        return view('admin.category.manage',compact('categories'));
    }
    public function show()
    {
        return view('admin.category.add_form');
    }
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|unique:categories|max:255',

        ]);
        $categories=new Category();
        $categories->name = $request->name;
        $categories->slug = strtolower(str_replace('','_',$request->slug));
        $categories->save();
        return redirect()->route('category.manage')->with('sms','Category Created');

    }
    public function hide($id)
    {
        $cate=Category::find($id);
        $cate->status=0;
        $cate->save();
        return back()->with('sms','Category unavailable in public');

    }
    public function public($id)
    {
        $cate=Category::find($id);
        $cate->status=1;
        $cate->save();
        return back()->with('sms','Category available in public');

    }
    public function update(Request $request)
    {

        $request->validate([
            'name' => 'required|unique:categories|max:255',

        ]);
        $cate=Category::find($request->id);
        $cate->name= $request->name;
        $cate->update();
        return back()->with('sms','Role Updated');

    }
    public function destroy($id)
    {
        Category::destroy($id);
        return back()->with('sms','Category Deleted');

    }
}
