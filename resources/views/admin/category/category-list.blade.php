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

                        <form  id="CategoryForm" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="name" class="col-form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}" placeholder="Write Title Category" required oninvalid="this.setCustomValidity('Tidak Boleh Kosong')" oninput="this.setCustomValidity('')">
                            </div>


                            <label for="banner" class="col-form-label">Image Banner</label>

                            <div class="input-group mb-3">
                                <input id="input-fa" name="file" type="file"  class="form-control file" data-max-file-count="1" data-browse-on-zone-click="true">
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
        <div class="modal fade" id="edit-modal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-primary justify-content-center">
                        <h5 class="modal-title" id="staticBackdropLabel">Edit Menu</h5>
                    </div>
                    <div class="modal-body">
                        <form  id="MenuEditForm">
                            @csrf
                            <input type="hidden" name="id" id="id">
                            <div class="form-group">
                                <label for="name2" class="col-form-label">Name</label>
                                <input type="text" class="form-control" id="name2" name="name2"  required oninvalid="this.setCustomValidity('Tidak Boleh Kosong')" oninput="this.setCustomValidity('')">


                            </div>
                            {{-- <div class="form-group">
                                <label for="right_icon2" class="col-form-label">Right Icon</label>
                                <input type="text" class="form-control" id="right_icon2" name="right_icon2">
                            </div> --}}
                            <div class="row">
                                <div class="mb-1 col-sm d-inline">
                                    <label for="left-icon2" class="col-form-label">Left Icon</label>
                                </div>
                                <div class="mb-1 col-sm d-inline ustify-content-right">
                                    <label for="right-icon2" class="col-form-label">Right Icon</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-group col-sm">
                                    <span class="input-group-prepend">
                                        <button class="btn btn-secondary" data-icon="fas fa-map-marker-alt" id="btn-icon-left2"></button>
                                    </span>
                                    <input type="text" class="form-control"  id="icon-left2" name="icon_left2" required oninvalid="this.setCustomValidity('Tidak Boleh Kosong')" oninput="this.setCustomValidity('')">
                                </div>

                                <div class="input-group col-sm">
                                    <input type="text" class="form-control"  id="icon-right2" name="icon_right2" required oninvalid="this.setCustomValidity('Tidak Boleh Kosong')" oninput="this.setCustomValidity('')">
                                    <span class="input-group-append">
                                        <button class="btn btn-outline-secondary" data-icon="fas fa-home" id="btn-icon-right2"></button>
                                    </span>
                                </div>
                            </div>

                                <div class="modal-footer col-md-12 justify-content-center">

                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" id="submitEditForm" class="btn btn-primary">Update</button>

                                </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- end modal Edit--}}
    {{--  End Menu  --}}
@endsection


