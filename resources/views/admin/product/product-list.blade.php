@extends('admin.master')
@section('title')
    Product-List
@endsection


@section('content')
    <div class="content-header mt-4 fixed">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Product List</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('product.index')}}">Product</a></li>
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
                                @isset(Auth::guard('admin')->user()->role->parmission['parmission']['Product']['add'])
                                    <button  class="card-title float-left btn btn-success tambah-product" id="btn-product-add">
                                        <i class="fas fa-plus-circle nav-icon"></i>
                                            Add Product
                                    </button>
                                @endisset
                                <h3 class="text-center">Data Product</h3>
                            </div>
                            <div class="card-body">
                                <table id="tbl-product" class="table table-bordered table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>SKU</th>
                                            <th>Name</th>
                                            <th>Price</th>
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
    {{--  Product  --}}
        {{--Modal ADD--}}
        <div class="modal fade" id="modal-tambah-product" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-primary justify-content-center">
                        <h5 class="modal-title" id="staticBackdropLabel">Add Product</h5>

                    </div>
                    <div class="modal-body">

                        <form  id="product-form" enctype="multipart/form-data" action="javascript:void(0)">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                  <div class="card card-default">
                                    <div class="card-header">
                                      <h3 class="card-title">bs-stepper</h3>
                                    </div>
                                    <div class="card-body p-0">
                                      <div class="bs-stepper">
                                        <div class="bs-stepper-header" role="tablist">
                                          <!-- your steps here -->
                                          <div class="step" data-target="#logins-part">
                                            <button type="button" class="step-trigger" role="tab" aria-controls="logins-part" id="logins-part-trigger">
                                              <span class="bs-stepper-circle">1</span>
                                              <span class="bs-stepper-label">Logins</span>
                                            </button>
                                          </div>
                                          <div class="line"></div>
                                          <div class="step" data-target="#information-part">
                                            <button type="button" class="step-trigger" role="tab" aria-controls="information-part" id="information-part-trigger">
                                              <span class="bs-stepper-circle">2</span>
                                              <span class="bs-stepper-label">Various information</span>
                                            </button>
                                          </div>
                                        </div>
                                        <div class="bs-stepper-content">
                                          <!-- your steps content here -->
                                          <div id="logins-part" class="content" role="tabpanel" aria-labelledby="logins-part-trigger">
                                            <div class="form-group">
                                              <label for="exampleInputEmail1">Email address</label>
                                              <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                                            </div>
                                            <div class="form-group">
                                              <label for="exampleInputPassword1">Password</label>
                                              <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                                            </div>
                                            <button class="btn btn-primary" onclick="stepper.next()">Next</button>
                                          </div>
                                          <div id="information-part" class="content" role="tabpanel" aria-labelledby="information-part-trigger">
                                            <div class="form-group">
                                              <label for="exampleInputFile">File input</label>
                                              <div class="input-group">
                                                <div class="custom-file">
                                                  <input type="file" class="custom-file-input" id="exampleInputFile">
                                                  <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                                </div>
                                                <div class="input-group-append">
                                                  <span class="input-group-text">Upload</span>
                                                </div>
                                              </div>
                                            </div>
                                            <button class="btn btn-primary" onclick="stepper.previous()">Previous</button>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <!-- /.card-body -->
                                    <div class="card-footer">
                                      Visit <a href="https://github.com/Johann-S/bs-stepper/#how-to-use-it">bs-stepper documentation</a> for more examples and information about the plugin.
                                    </div>
                                  </div>
                                  <!-- /.card -->
                                </div>
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
        <div class="modal fade" id="modal-edit-product" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                                <input type="hidden" class="form-control" id="id" name="id" value="{{old('id')}}" placeholder="Write Title Category" required oninvalid="this.setCustomValidity('Tidak Boleh Kosong')" oninput="this.setCustomValidity('')">
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
    {{--  End product  --}}
@endsection


