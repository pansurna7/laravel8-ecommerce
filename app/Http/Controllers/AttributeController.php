<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Attributes;


class AttributeController extends Controller
{
    public function index(Request $request)
    {
        $dbatt=Attributes::all();

         if($request->ajax()){
            return datatables()->of($dbatt)
            ->addColumn('action', function($data){
                if (@isset(Auth::guard('admin')->user()->role->parmission['parmission']['Attribute']['edit'])){
                    $button = '<a href="javascript:void(0)" data-toggle="tooltip"  attribute-id="'.$data->id.'"  attribute-name="'.$data->Attribute.'" data-original-title="Edit"  class="edit-attribute btn btn-info btn-sm"><i class="far fa-edit"></i> Edit</a>';
                }else{
                    $button = '<a href="javascript:void(0)" data-toggle="tooltip"  attribute-id="'.$data->id.'" data-original-title="Edit" class="edit-attribute btn btn-info btn-sm edit-attribute disabled" aria-disabled="true"><i class="far fa-edit"></i> Edit</a>';
                }
                $button .= '&nbsp;&nbsp;';
                if(isset(Auth::guard('admin')->user()->role->parmission['parmission']['Attribute']['delete'])){
                    $button .= '<a  href="javascript:void(0)" attribute-id="'.$data->id.'" attribute-name="'.$data->Attribute.'" id="'.$data->id.'" class="delete-attribute btn btn-danger btn-sm"><i class="far fa-trash-alt"></i> Delete</a>';
                }else{
                    $button .= '<a href="javascript:void(0)"  attribute-id="'.$data->id.'" class="delete-attribute btn btn-danger btn-sm disabled" aria-disabled="true"><i class="far fa-trash-alt"></i> Delete</a>';
                }
                return $button;
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);

         }
            return view('admin.attribute.attribute-list');
    }
    public function store(Request $request){
        $att = new Attributes();
        $att->code=$request->code;
        $att->name=$request->name;
        $att->type=$request->type;
        $att->is_required=$request->required;
        $att->is_unique=$request->unique;
        $att->validation=$request->validation;
        $att->is_configurable=$request->configurable;
        $att->is_filterable=$request->filtering;
        $simpan=$att->save();

        if($simpan){
            return response()->json(['data'=>$simpan,
            'massage'=>'Attribute Created Success Fully'],200);
        }else{
            return response()->json(['data'=>$simpan,
            'massage'=>validator()]);
        }
    }
    public function edit($id)
    {
        $data=Attributes::find($id);
        // dd($data);
        return response()->json(['data' => $data]);
    }
    public function update(Request $request)
    {

        $att=Attributes::find($request->id);
        $att->code=$request->code_edit;
        $att->name=$request->name_edit;
        $att->type=$request->type_edit;
        $att->is_required=$request->required_edit;
        $att->is_unique=$request->unique_edit;
        $att->validation=$request->validation_edit;
        $att->is_configurable=$request->configurable_edit;
        $att->is_filterable=$request->filtering_edit;
        $simpan=$att->save();
        if($simpan){
            return response()->json(['data'=>$simpan,
            'massage'=>'Attribute Update Success Fully'],200);
        }else{
            return response()->json(['data'=>$simpan,
            'massage'=>validator()]);
        }

    }
    public function destroy(Request $request,$id)
    {

        $delete=Attributes::destroy($id);
        if($delete){
            return response()->json(['data'=>$delete,
            'msg'=>'Attribute Delete  Success Fully'],200);
        }else{
            return response()->json(['data'=>$delete,
            'msg'=>'Error']);
        }


    }
}
