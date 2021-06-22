@extends('admin.master')
@section('title')
    Attribute-List
@endsection


@section('content')
    <div class="content-header mt-4 fixed">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Attribute List</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('attribute.index')}}">Attribute</a></li>
                            <li class="breadcrumb-item active">@yield('title')</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                            <!-- /.card-header -->
                            <div class="card-header col-12">
                                @isset(Auth::guard('admin')->user()->role->parmission['parmission']['Attribute']['add'])
                                    <button  class="card-title float-left btn btn-success tambah-attribute" id="btn-attribute-add">
                                        <i class="fas fa-plus-circle nav-icon"></i>
                                            Add Attribute
                                    </button>
                                @endisset
                                <h3 class="text-center">Data Attribute</h3>
                            </div>
                            <div class="card-body">
                                <table id="tbl-attribute" class="table table-bordered table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Code</th>
                                            <th>Name</th>
                                            <th>Type</th>
                                            <th width="250px">Action</th>
                                        </tr>
                                    </thead>

                                </table>
                            </div>
                            <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{--  Product  --}}
        {{--Modal ADD--}}
        <div class="modal fade" id="modal-tambah-attribute" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="false">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-primary justify-content-center">
                        <h5 class="modal-title" id="staticBackdropLabel">Add Attribute</h5>
                    </div>
                    <div class="modal-body">
                        <form  id="form-attribute" enctype="multipart/form-data" action="javascript:void(0)">
                            @csrf
                            <div id="smartwizard-attribute">
                                <ul>
                                    <li><a href="#step-1">Step 1<br /><small>Attribute Info</small></a></li>
                                    <li><a href="#step-2">Step 2<br /><small>Validation</small></a></li>
                                    <li><a href="#step-3">Step 3<br /><small>Configuration</small></a></li>

                                </ul>
                                <div class="mt-4">
                                    <div id="step-1">
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <label for="code">Code</label>
                                                <input type="text" class="form-control" id="code" name="code" placeholder="code" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Name Attribute" required>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="type">Type</label>
                                                <select name="type" class="form-control" required>
                                                    <option value="">Please Select Type</option>
                                                    <option value="1">Text</option>
                                                    <option value="2">Textarea</option>
                                                    <option value="3">Price</option>
                                                    <option value="4">Boolean</option>
                                                    <option value="5">Select</option>
                                                    <option value="6">Datetime</option>
                                                    <option value="7">Date</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="step-2">
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="require">Is Required?</label>
                                                <select name="required" class="form-control">
                                                    <option value=""></option>
                                                    <option value="0">No</option>
                                                    <option value="1">Yes</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="unique">Is Unique?</label>
                                                <select name="unique" class="form-control">
                                                    <option value=""></option>
                                                    <option value="0">No</option>
                                                    <option value="1">Yes</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="validation">Validation</label>
                                                <select name="validation" class="form-control">
                                                    <option value=""></option>
                                                    <option value="number">Number</option>
                                                    <option value="decimal">Decimal</option>
                                                    <option value="email">Email</option>
                                                    <option value="url">URL</option>
                                                </select>
                                            </div>

                                        </div>
                                    </div>
                                    <div id="step-3">
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="configurable">`Use` In Configurable Product?</label>
                                                <select name="configurable" class="form-control">
                                                    <option value=""></option>
                                                    <option value="0">No</option>
                                                    <option value="1">Yes</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="filtering">`Use` In Filtering Product?</label>
                                                <select name="filtering" class="form-control">
                                                    <option value=""></option>
                                                    <option value="0">No</option>
                                                    <option value="1">Yes</option>
                                                </select>
                                            </div>
                                        </div>
                                       <div class="form-group col-md-12 col-xs-12">
                                            <button type="submit" id="submit-form" class="btn btn-success btn-block">Save</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="modal-footer col-md-12 justify-content-center">
                                <button type="button" class="btn btn-primary btn-block" data-dismiss="modal">Cancel/Close</button>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- end modal ADD--}}

        {{-- Modal Edit --}}
        <div class="modal fade" id="modal-edit-attribute" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="false">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-primary justify-content-center">
                        <h5 class="modal-title" id="staticBackdropLabel">Edit Attribute</h5>
                    </div>
                    <div class="modal-body">
                        <form  id="form-attribute-edit" enctype="multipart/form-data" action="javascript:void(0)">
                            @csrf
                            <div id="smartwizard-attribute-edit">
                                <ul>
                                    <li><a href="#step-1">Step 1<br /><small>Attribute Info</small></a></li>
                                    <li><a href="#step-2">Step 2<br /><small>Validation</small></a></li>
                                    <li><a href="#step-3">Step 3<br /><small>Configuration</small></a></li>

                                </ul>
                                <div class="mt-4">
                                    <div id="step-1">
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <label for="code_edit">Code</label>
                                                <input type="hidden" class="form-control" id="id" name="id" placeholder="code">
                                                <input type="text" class="form-control" id="code_edit" name="code_edit" placeholder="code" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="name_edit">Name</label>
                                            <input type="text" class="form-control" id="name_edit" name="name_edit" placeholder="Name Attribute" required>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="type_edit">Type</label>
                                                <select name="type_edit" id="type_edit" class="form-control" required>
                                                    <option value="">Please Select Type</option>
                                                    <option value="1">Text</option>
                                                    <option value="2">Textarea</option>
                                                    <option value="3">Price</option>
                                                    <option value="4">Boolean</option>
                                                    <option value="5">Select</option>
                                                    <option value="6">Datetime</option>
                                                    <option value="7">Date</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="step-2">
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="require_edit">Is Required?</label>
                                                <select name="required_edit" id="required_edit" class="form-control">
                                                    <option value=""></option>
                                                    <option value="0">No</option>
                                                    <option value="1">Yes</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="unique_edit">Is Unique?</label>
                                                <select name="unique_edit" id="unique_edit" class="form-control">
                                                    <option value=""></option>
                                                    <option value="0">No</option>
                                                    <option value="1">Yes</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="validation_edit">Validation</label>
                                                <select name="validation_edit" id="validation_edit" class="form-control">
                                                    <option value=""></option>
                                                    <option value="number">Number</option>
                                                    <option value="decimal">Decimal</option>
                                                    <option value="email">Email</option>
                                                    <option value="url">URL</option>
                                                </select>
                                            </div>

                                        </div>
                                    </div>
                                    <div id="step-3">
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="configurable_edit">`Use` In Configurable Product?</label>
                                                <select name="configurable_edit" id="configurable_edit" class="form-control">
                                                    <option value=""></option>
                                                    <option value="0">No</option>
                                                    <option value="1">Yes</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="filtering_edit">`Use` In Filtering Product?</label>
                                                <select name="filtering_edit" id="filtering_edit" class="form-control">
                                                    <option value=""></option>
                                                    <option value="0">No</option>
                                                    <option value="1">Yes</option>
                                                </select>
                                            </div>
                                        </div>
                                       <div class="form-group col-md-12 col-xs-12">
                                            <button type="submit" id="submit-form-edit" class="btn btn-success btn-block">Save</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="modal-footer col-md-12 justify-content-center">
                                <button type="button" class="btn btn-primary btn-block" id="cancel" data-dismiss="modal">Cancel/Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- end modal Edit--}}



    {{--  End product  --}}
@endsection


