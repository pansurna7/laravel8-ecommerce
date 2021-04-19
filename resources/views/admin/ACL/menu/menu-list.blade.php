@extends('admin.master')
@section('title')
    Menu-List
@endsection
@section('content')
    <div class="content-header mt-4 fixed">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Parent Menu List & Sub Menu List</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('menu.index')}}">Menu</a></li>
                            <li class="breadcrumb-item active">Manage</li>
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
                                @isset(Auth::guard('admin')->user()->role->parmission['parmission']['menu']['add'])
                                    <button  class="card-title float-left btn btn-success MenuAdd" id="btnMenuAdd">
                                        <i class="fas fa-plus-circle nav-icon"></i>
                                            Add Menu
                                    </button>
                                @endisset
                                <h3 class="text-center">Parent Menu</h3>
                            </div>
                            <div class="card-body">
                                <table id="tblMenu" class="table table-bordered table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>ID</th>
                                            <th>Menu Name</th>
                                            <th>Ringht Icon</th>
                                            <th>Left Icon</th>
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
    {{--Modal ADD--}}
    <div class="modal fade" id="tambah-edit-modal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary justify-content-center">
                    <h5 class="modal-title" id="staticBackdropLabel">Add Menu</h5>

                </div>
                <div class="modal-body">

                    <form  id="MenuForm">
                        @csrf
                        {{-- <input type="hidden" name="id" id="id"> --}}
                        <div class="form-group">
                            <label for="name" class="col-form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}" placeholder="write Title Menu" required oninvalid="this.setCustomValidity('Tidak Boleh Kosong')" oninput="this.setCustomValidity('')">


                        </div>
                        <div class="form-group">
                            <label for="right_icon" class="col-form-label">Right Icon</label>
                            <input type="text" class="form-control" id="right_icon" name="right_icon" value="{{old('right_icon')}}" placeholder="Right Icon Menu">
                        </div>
                        <div class="form-group">
                            <label for="left_icon" class="col-form-label">Left Icon</label>
                            <input type="text" class="form-control" id="left_icon" name="left_icon" value="{{old('left_icon')}}" placeholder="Left Icon Menu" required oninvalid="this.setCustomValidity('Tidak Boleh Kosong')" oninput="this.setCustomValidity('')">
                        </div>

                            <div class="modal-footer col-md-12 justify-content-center">

                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" id="submitForm" class="btn btn-primary">Save</button>
                                {{-- <input type="submit" name="action_button" id="action_button" class="btn btn-warning" value="Add" /> --}}
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
                        <div class="form-group">
                            <label for="right_icon2" class="col-form-label">Right Icon</label>
                            <input type="text" class="form-control" id="right_icon2" name="right_icon2">
                        </div>
                        <div class="form-group">
                            <label for="left_icon2" class="col-form-label">Left Icon</label>
                            <input type="text" class="form-control" id="left_icon2" name="left_icon2"  required oninvalid="this.setCustomValidity('Tidak Boleh Kosong')" oninput="this.setCustomValidity('')">
                        </div>

                            <div class="modal-footer col-md-12 justify-content-center">

                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" id="submitEditForm" class="btn btn-primary">Update</button>
                                {{-- <input type="submit" name="action_button" id="action_button" class="btn btn-warning" value="Add" /> --}}
                            </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- end modal Edit--}}
    {{--  End Menu  --}}


    {{--  SubMenu  --}}
    <!-- /.card-header -->
    <div class="card-header col-12">
        <div class="card-header col-12">
            @isset(Auth::guard('admin')->user()->role->parmission['parmission']['menu']['add'])
                <button  class="card-title float-left btn btn-success MenuAdd" id="btn-submenu-add">
                    <i class="fas fa-plus-circle nav-icon"></i>
                        Add Menu
                </button>
            @endisset
            <h3 class="text-center">Sub Menu</h3>
        </div>

    </div>
    <div class="card-body">
        <table id="tbl-submenu" class="table table-bordered table-striped table-sm">
            <thead>
                <tr>
                    <th>No</th>
                    <th>ID</th>
                    <th>SubMenu Name</th>
                    <th>Parent Menu</th>
                    <th>Slug</th>
                    <th>Icon</th>
                    <th width="140px">Action</th>

                </tr>
            </thead>

        </table>
    </div>
    <!-- /.card-body -->
     {{--Modal Sub Menu Add--}}
    <div class="modal fade" id="tambah-submenu-modal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary justify-content-center">
                    <h5 class="modal-title" id="staticBackdropLabel">Add Menu</h5>
                </div>
                <div class="modal-body">

                    <form  id="submenu-form">
                        @csrf
                        {{-- <input type="hidden" name="id" id="id"> --}}
                        <div class="form-group">
                            <label for="sub-menu-name" class="col-form-label">Name</label>
                            <input type="text" class="form-control" id="sub-menu-name" name="sub-menu-name" value="{{old('sub-menu-name')}}" placeholder="write Title Menu" required oninvalid="this.setCustomValidity('Tidak Boleh Kosong')" oninput="this.setCustomValidity('')">


                        </div>
                        <div class="form-group">
                            <label for="slug" class="col-form-label">Parent Menu</label>
                            <select name="parent" class="form-control">
                                <option value="">Please select a parent menu</option>
                                @foreach($menus as $menu)
                                    <option value="{{$menu->id}}">{{$menu->menu}}</option>
                                @endforeach
                            </select>
                            @error('parent')
                            <span class="text-danger">
                                {{$message}}
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="slug" class="col-form-label">Slug</label>
                            <input type="text" class="form-control" id="slug" name="slug" value="{{old('slug')}}" placeholder="Slug/url Menu" required oninvalid="this.setCustomValidity('Tidak Boleh Kosong')" oninput="this.setCustomValidity('')">
                        </div>
                        <div class="form-group">
                            <label for="icon" class="col-form-label">Icon</label>
                            {{--  <input type="text" class="form-control" id="icon" name="icon" value="{{old('icon')}}" placeholder="Icon SubMenu" required oninvalid="this.setCustomValidity('Tidak Boleh Kosong')" oninput="this.setCustomValidity('')">  --}}
                            <select class="form-control">
                                <option><span class="glyphicon glyphicon-cutlery"></span></option>
                                <option><span class="glyphicon glyphicon-eye-open"></span></option>
                                <option><span class="glyphicon glyphicon-heart-empty"></span></option>
                                <option><span class="glyphicon glyphicon-leaf"></span></option>
                                <option><span class="glyphicon glyphicon-music"></span></option>
                                <option><span class="glyphicon glyphicon-send"></span></option>
                                <option><span class="glyphicon glyphicon-star"></span></option>
                              </select>
                        </div>

                        <div class="modal-footer col-md-12 justify-content-center">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" id="btn-save" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- end Modal Sub Menu  Add--}}

    {{-- Modal Edit --}}

    {{-- end modal Edit--}}

    {{--  End SubMenu  --}}


@endsection

