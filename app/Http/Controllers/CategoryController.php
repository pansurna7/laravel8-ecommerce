<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $dbCategory=Category::all();

         if($request->ajax()){
            return datatables()->of($dbCategory)
            ->addColumn('action', function($data){
                if (@isset(Auth::guard('admin')->user()->role->parmission['parmission']['Category']['edit'])){
                    $button = '<a href="javascript:void(0)" data-toggle="tooltip"  category-id="'.$data->id.'"  Category-name="'.$data->Category.'" data-original-title="Edit"  class="edit-Category btn btn-info btn-sm"><i class="far fa-edit"></i> Edit</a>';
                }else{
                    $button = '<a href="javascript:void(0)" data-toggle="tooltip"  category-id="'.$data->id.'" data-original-title="Edit" class="edit-Category btn btn-info btn-sm edit-Category disabled" aria-disabled="true"><i class="far fa-edit"></i> Edit</a>';
                }
                $button .= '&nbsp;&nbsp;';
                if(isset(Auth::guard('admin')->user()->role->parmission['parmission']['Category']['delete'])){
                    $button .= '<a  href="javascript:void(0)" Category-id="'.$data->id.'" category-name="'.$data->Category.'" id="'.$data->id.'" class="delete-Category btn btn-danger btn-sm"><i class="far fa-trash-alt"></i> Delete</a>';
                }else{
                    $button .= '<a href="javascript:void(0)"  manu-id="'.$data->id.'" class="delete-category btn btn-danger btn-sm disabled" aria-disabled="true"><i class="far fa-trash-alt"></i> Delete</a>';
                }
                return $button;
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);

         }
                return view('admin.category.category-list');


    }

    public function store(Request $request)
    {
        $category= new Category();
        $name = $request->name;
        $category->name=$request->name;
        $category->slug=$request->name;
        $category->status=$request->status;
        // $image=$request->file('file');
        // $imageName=$request->name.'.'.$image->extension();
        // $image->move(public_path('/Source/back/dist/img/category'),$imageName);
        // // $user->image=$imageName;
        // $category->banner=$imageName;
        if ($request->file === null) {
            $request['file'] = $category->banner;
        } else {
            $image = $request->file('file');
            $imageName = $name . '.' . $image->extension();
            $image->move(public_path('/Source/back/dist/img/category'), $imageName);
            $category->banner = $imageName;
        }

        $save=$category->save();
        if($save){
            return response()->json(['data'=>$category,
            'massage'=>'Category Created Success Fully'],200);
        }else{
            return response()->json(['data'=>$category,
            'massage'=>'Error']);
        }

    }
    // public function edit($id)
    // {
    //     $data=Category::find($id);
    //     // dd($data);
    //     return response()->json(['data' => $data]);
    // }
    // public function update(Request $request)
    // {

    //     $Category=Category::find($request->id);
    //     $Category->Category=$request->name2;
    //     $Category->icon_left=$request->icon_left2;
    //     $Category->icon_right=$request->icon_right2;
    //     $save=$Category->save();

    //     if($save){
    //         return response()->json(['data'=>$Category,
    //         'msg'=>'Category UpdateSuccess Fully'],200);
    //     }else{
    //         return response()->json(['data'=>$Category,
    //         'msg'=>'Error']);
    //     }
    // }
    // public function destroy($id)
    // {

    // Category::destroy($id);
    // return response()->json(['msg'=>'Record Deleted SuccessFully']);

    // }
}
