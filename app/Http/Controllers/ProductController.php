<?php

namespace App\Http\Controllers;

use App\Models\ProductImage;
use App\Models\Products;
use App\Models\ProductsImage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $dbproduct=Products::all();

         if($request->ajax()){
            return datatables()->of($dbproduct)
            ->addColumn('action', function($data){
                if (@isset(Auth::guard('admin')->user()->role->parmission['parmission']['Product']['edit'])){
                    $button = '<a href="javascript:void(0)" data-toggle="tooltip"  product-id="'.$data->id.'"  product-name="'.$data->Category.'" data-original-title="Edit"  class="edit-product btn btn-info btn-sm"><i class="far fa-edit"></i> Edit</a>';
                }else{
                    $button = '<a href="javascript:void(0)" data-toggle="tooltip"  product-id="'.$data->id.'" data-original-title="Edit" class="edit-product btn btn-info btn-sm edit-product disabled" aria-disabled="true"><i class="far fa-edit"></i> Edit</a>';
                }
                $button .= '&nbsp;&nbsp;';
                if(isset(Auth::guard('admin')->user()->role->parmission['parmission']['Product']['delete'])){
                    $button .= '<a  href="javascript:void(0)" product-id="'.$data->id.'" product-name="'.$data->name.'" id="'.$data->id.'" class="delete-product btn btn-danger btn-sm"><i class="far fa-trash-alt"></i> Delete</a>';
                }else{
                    $button .= '<a href="javascript:void(0)"  product-id="'.$data->id.'" class="delete-product btn btn-danger btn-sm disabled" aria-disabled="true"><i class="far fa-trash-alt"></i> Delete</a>';
                }
                return $button;
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);

         }
            return view('admin.product.product-list');


    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){

            $pro = new Products();
            $pro->sku=$request->sku;
            $pro->name=$request->name;
            $pro['slug'] = Str::slug($pro['name']);
            $pro['admin_id'] = Auth::guard('admin')->user()->id;
            $pro->price=str_replace(",","",$request->price);
            $pro->category_id=$request->category;
            $pro->text_description=$request->sd;
            $pro->description=$request->description;
            $pro->weight=$request->weight;
            $pro->length=$request->length;
            $pro->width=$request->width;
            $pro->height=$request->height;
            $pro->status=$request->status;
            $simpan=$pro->save();

            // store to table product_images
            $images = $request->file('images');
        if ($request->hasFile('images')) :
                foreach ($images as $item):
                    $var = date_create();
                    $time = date_format($var, 'YmdHis');
                    $imageName = $time . '-' . $item->getClientOriginalName();
                    $item->move(public_path() . '/Source/back/dist/img/products/', $imageName);
                    $arr[] = $imageName;
                    $image = new ProductImage();
                    $image->product_id=$pro->id;
                    $image->path=$imageName;
                    $simpan=$image->save();
                endforeach;
                $image = implode(",", $arr);
        else:
                $image = '';
        endif;

            if($simpan){
                return response()->json(['data'=>$simpan,
                'massage'=>'Product Created Success Fully'],200);
            }else{
                return response()->json(['data'=>$simpan,
                'massage'=>validator()]);
            }

    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $data=Products::find($id);
        // return response()->json(['data' => $data]);
        // $img=ProductImage::where('product_id',route('id'))->select('path')->get();
        $pro=Products::find($id);
        $proimg=ProductImage::where('product_id',$id)->select('path')->get();
        // return response()->json(['pro' => $pro]);
        return response()->json(['pro'=>$pro,'proimg' => $proimg]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
            $pro=Products::find($request->id);
            $pro->sku=$request->sku_edit;
            $pro->name=$request->name_edit;
            $pro['slug'] = Str::slug($pro['name']);
            $pro['admin_id'] = Auth::guard('admin')->user()->id;
            $pro->price=str_replace(",","",$request->price_edit);
            $pro->category_id=$request->category_edit;
            $pro->text_description=$request->sd_edit;
            $pro->description=$request->description_edit;
            $pro->weight=$request->weight_edit;
            $pro->length=$request->length_edit;
            $pro->width=$request->width_edit;
            $pro->height=$request->height_edit;
            $pro->status=$request->status_edit;
            $update=$pro->save();
            // store to table product_images
            $images = $request->file('images_edit');
            if ($request->images_edit === null) {
                foreach ($images as $item):
                    $request['images_edit'] = $images->path;
                endforeach;
            } else {
                if ($request->hasFile('images_edit')) :
                        foreach ($images as $item):
                            $var = date_create();
                            $time = date_format($var, 'YmdHis');
                            $imageName = $time . '-' . $item->getClientOriginalName();
                            $item->move(public_path() . '/Source/back/dist/img/products/', $imageName);
                            $arr[] = $imageName;
                            $image =ProductImage::where('product_id',$pro->id)->select('path')->get();
                            $image->product_id=$pro->id;
                            $image->path=$imageName;
                            $update=$image->save();
                        endforeach;
                        $image = implode(",", $arr);
                else:
                        $image = '';
                endif;
            }


        if($update){
            return response()->json(['data'=>$update,
            'msg'=>'Product Update Success Fully'],200);
        }else{
            return response()->json(['data'=>$update,
            'msg'=>'Error']);
        }
    }
    public function destroy($id)
    {

        $delete=Products::destroy($id);
        if($delete)
        {
                return response()->json(['data'=>$delete,
                'msg'=>'Product Delete Success Fully'],200);
            }else{
                return response()->json(['data'=>$delete,
                'msg'=>'Error']);
            }


    }
}
