<?php

namespace App\Http\Controllers;

use App\Models\Products;
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
                    $button = '<a href="javascript:void(0)" data-toggle="tooltip"  product-id="'.$data->id.'"  product-name="'.$data->Category.'" data-original-title="Edit"  class="edit-category btn btn-info btn-sm"><i class="far fa-edit"></i> Edit</a>';
                }else{
                    $button = '<a href="javascript:void(0)" data-toggle="tooltip"  product-id="'.$data->id.'" data-original-title="Edit" class="edit-product btn btn-info btn-sm edit-product disabled" aria-disabled="true"><i class="far fa-edit"></i> Edit</a>';
                }
                $button .= '&nbsp;&nbsp;';
                if(isset(Auth::guard('admin')->user()->role->parmission['parmission']['Product']['delete'])){
                    $button .= '<a  href="javascript:void(0)" product-id="'.$data->id.'" product-name="'.$data->product.'" id="'.$data->id.'" class="delete-product btn btn-danger btn-sm"><i class="far fa-trash-alt"></i> Delete</a>';
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function show(Products $products)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function edit(Products $products)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Products $products)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy(Products $products)
    {
        //
    }
}
