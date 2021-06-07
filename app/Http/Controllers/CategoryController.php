<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;


class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $dbCategory=Category::all();

         if($request->ajax()){
            return datatables()->of($dbCategory)
            ->addColumn('action', function($data){
                if (@isset(Auth::guard('admin')->user()->role->parmission['parmission']['Category']['edit'])){
                    $button = '<a href="javascript:void(0)" data-toggle="tooltip"  category-id="'.$data->id.'"  category-name="'.$data->Category.'" data-original-title="Edit"  class="edit-category btn btn-info btn-sm"><i class="far fa-edit"></i> Edit</a>';
                }else{
                    $button = '<a href="javascript:void(0)" data-toggle="tooltip"  category-id="'.$data->id.'" data-original-title="Edit" class="edit-category btn btn-info btn-sm edit-category disabled" aria-disabled="true"><i class="far fa-edit"></i> Edit</a>';
                }
                $button .= '&nbsp;&nbsp;';
                if(isset(Auth::guard('admin')->user()->role->parmission['parmission']['Category']['delete'])){
                    $button .= '<a  href="javascript:void(0)" category-id="'.$data->id.'" category-name="'.$data->Category.'" id="'.$data->id.'" class="delete-category btn btn-danger btn-sm"><i class="far fa-trash-alt"></i> Delete</a>';
                }else{
                    $button .= '<a href="javascript:void(0)"  category-id="'.$data->id.'" class="delete-category btn btn-danger btn-sm disabled" aria-disabled="true"><i class="far fa-trash-alt"></i> Delete</a>';
                }
                return $button;
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);

         }
            return view('admin.category.category-list');


    }
    public function store(Request $request){
        request()->validate([
            'name'  =>'required|unique:categories,name',
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($files = $request->file('image')) {
           $fileName =  "banner-".time().'.'.$request->image->getClientOriginalExtension();
            $request->image->storeAs('banner', $fileName);
            $files->move(public_path('/Source/back/dist/img/category'), $fileName);
            $category = new Category();
            $category->name=$request->name;
            $category->slug=Str::slug($request->name);
            $category->status=$request->status ? 1 : 0 ?? 0;
            $category->banner = $fileName;
            $simpan=$category->save();

            if($simpan){
                return response()->json(['data'=>$simpan,
                'massage'=>'Category Created Success Fully'],200);
            }else{
                return response()->json(['data'=>$simpan,
                'massage'=>validator()]);
            }

        }
    }

    public function edit($id)
    {
        $data=Category::find($id);
        // dd($data);
        return response()->json(['data' => $data]);
    }
    public function update(Request $request)
    {

        $cat=Category::find($request->id);
        $cat->name=$request->name_edit;
        $cat->slug=Str::slug($request->name_edit);
        $cat->status=$request->status_edit;
        if ($request->image_edit === null) {
            $request['image_edit'] = $cat->banner;
        } else {
            $imagePath = public_path("/Source/back/dist/img/category/".$cat->banner);
            if(File::exists($imagePath)){
            unlink($imagePath);
        }

                $image = $request->file('image_edit');
                $imageName = "banner-".time().'.'.$image->extension();
                $image->move(public_path('/Source/back/dist/img/category'), $imageName);
                $cat->banner = $imageName;

        }

        $save=$cat->save();
        if($save){
            return response()->json(['data'=>$cat,
            'msg'=>'Category UpdateSuccess Fully'],200);
        }else{
            return response()->json(['data'=>$cat,
            'msg'=>'Error']);
        }
    }
    public function destroy(Request $request,$id)
    {

        $cat=Category::find($id);
        $imagePath = public_path("/Source/back/dist/img/category/".$cat->banner);
        if(File::exists($imagePath)){
            unlink($imagePath);
        }
            $delete=Category::destroy($id);
            if($delete){
                return response()->json(['data'=>$delete,
                'msg'=>'Category Delete Success Fully'],200);
            }else{
                return response()->json(['data'=>$delete,
                'msg'=>'Error']);
            }


    }
}
