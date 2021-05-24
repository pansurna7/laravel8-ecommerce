@extends('admin.master')
@section('title')
    Category-List
@endsection


@section('content')
    <div class="content-header mt-4 fixed">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Category List</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('category.index')}}">Category</a></li>
                            <li class="breadcrumb-item active">List</li>
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
                                @isset(Auth::guard('admin')->user()->role->parmission['parmission']['Category']['add'])
                                    <button  class="card-title float-left btn btn-success tambah-category" id="btn-category-add">
                                        <i class="fas fa-plus-circle nav-icon"></i>
                                            Add Category
                                    </button>
                                @endisset
                                <h3 class="text-center">Category List</h3>
                            </div>
                            <div class="card-body">
                                <table id="tbl-category" class="table table-bordered table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Banner</th>
                                            <th>Slug</th>
                                            <th>Status</th>
                                            <th width="140px">Action</th>
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
    {{--  category  --}}
        {{--Modal ADD--}}
        <div class="modal fade" id="modal-tambah-category" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-primary justify-content-center">
                        <h5 class="modal-title" id="staticBackdropLabel">Add Category</h5>
        
                    </div>
                    <div class="modal-body">
        
                        <form  id="CategoryForm" enctype="multipart/form-data" action="javascript:void(0)">
                            @csrf
                            <div class="form-group">
                                <label for="name" class="col-form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}" placeholder="Write Title Category" required oninvalid="this.setCustomValidity('Tidak Boleh Kosong')" oninput="this.setCustomValidity('')">
                            </div>
                            <label for="banner" class="col-form-label">Image Banner</label>
                                    {{--  ini untuk upload multiple image  menggunakan library upload cek di master js dan css nya --}}
                            {{--  <div class="input-group mb-3">
                                <input id="input-fa" name="file" type="file"  class="form-control file" data-max-file-count="1" data-browse-on-zone-click="true">
                            </div>  --}}
                            {{--  upload single image  --}}
                            <div class="form-group col-md-12">
                                <input type="file" class="custom-file-input" onchange="priviewFile(this)" id="image" name="image" required>
                                @error('image')
                                    <div class="alert alert-danger mb-2 mr-sm-2">{{ $message }}</div>
                                @enderror
                                <label class="custom-file-label" for="image">Upload Image</label>
                                <img src="https://www.riobeauty.co.uk/images/product_image_not_found.gif" id="priviewImg"  style="max-height: 250px;margin-top:30px"/>
                               
                            </div>
        
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="status" name="status" wire:model="active" value="1">
                                <label class="form-check-label" for="status">Active</label>
                            </div>
        
                            <div class="modal-footer col-md-12 justify-content-center">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" id="submit-form" class="btn btn-primary">Save</button>
                            </div>
        
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- end modal ADD--}}

        {{-- Modal Edit --}}
        <div class="modal fade" id="modal-edit-category" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-primary justify-content-center">
                        <h5 class="modal-title" id="staticBackdropLabel">Edit Category</h5>
                    </div>
                    <div class="modal-body">
                        <form  id="category-edit-form"  enctype="multipart/form-data" action="javascript:void(0)">
                            @csrf
                            <div class="form-group">
                                <label for="id" class="col-form-label">id</label>
                                <input type="text" class="form-control" id="id" name="id" value="{{old('id')}}" placeholder="Write Title Category" required oninvalid="this.setCustomValidity('Tidak Boleh Kosong')" oninput="this.setCustomValidity('')">
                            </div>
                            <div class="form-group">
                                <label for="name-edit" class="col-form-label">Name</label>
                                <input type="text" class="form-control" id="name-edit" name="name_edit" value="{{old('name-edit')}}" placeholder="Write Title Category" required oninvalid="this.setCustomValidity('Tidak Boleh Kosong')" oninput="this.setCustomValidity('')">
                            </div>

                            <label for="banner" class="col-form-label">Image Banner</label>
                          
                            <div class="form-group col-md-12">
                                <input type="file" class="custom-file-input" onchange="priviewFile(this)" id="image_edit" name="image_edit">
                                <label class="custom-file-label" id="image-source" for="image_edit">upload Image</label>
                                <img id="preview-image-before-upload" src="https://www.riobeauty.co.uk/images/product_image_not_found.gif"
                                alt="preview image" style="max-height: 250px;margin-top:30px">
                             </div>
                            <div class="col-md-12 mb-2">
                               
                            </div>

                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="status-edit" name="status_edit" wire:model="active" value="1">
                                <label class="form-check-label" for="status-edit">Active</label>
                            </div>

                            <div class="modal-footer col-md-12 justify-content-center">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" id="submit-form-edit" class="btn btn-primary">Update</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- end modal Edit--}}
    {{--  End category  --}}
@endsection


