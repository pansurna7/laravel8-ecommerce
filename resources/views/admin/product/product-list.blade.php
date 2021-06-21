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
        <div class="modal fade" id="modal-tambah-product" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="false">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header bg-primary justify-content-center">
                        <h5 class="modal-title" id="staticBackdropLabel">Add Product</h5>
                    </div>
                    <div class="modal-body">
                        <form  id="product-form" enctype="multipart/form-data" action="javascript:void(0)">
                            @csrf
                            <div id="smartwizard">
                                <ul>
                                    <li><a href="#step-1">Step 1<br /><small>Product Info</small></a></li>
                                    <li><a href="#step-2">Step 2<br /><small>Product Dimention</small></a></li>
                                    <li><a href="#step-3">Step 3<br /><small>Product Image</small></a></li>


                                </ul>
                                <div class="mt-4">
                                    <div id="step-1">
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="sku">SKU</label>
                                                <input type="text" class="form-control" id="sku" name="sku"placeholder="sku" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="name">Name</label>
                                                <input type="text" class="form-control" id="name" name="name" placeholder="Name Product" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="price">Price</label>
                                                <input type="text" class="form-control" id="price" placeholder="Rp" name="price" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="category">Category</label>
                                                <select name="category" class="form-control" id="category"  required>
                                                    <option value="">Please select category</option>
                                                    @foreach($category as $cat)
                                                        <option value="{{$cat->id}}">{{$cat->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="sd">Short Description</label>
                                                <textarea class="form-control" id="sd" name="sd" placeholder="Short Description" rows="3" required> </textarea>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="description">Description</label>
                                                <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="step-2">
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="weight">Weight</label>
                                                <input type="text" class="form-control" id="weight" name="weight" placeholder="Weight">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="length">Length</label>
                                                <input type="text" class="form-control" id="length" name="length" placeholder="Lenght">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="width">Width</label>
                                                <input type="text" class="form-control" id="width" name="width" placeholder="width">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="height">Height</label>
                                                <input type="text" class="form-control" id="height" name="height" placeholder="height">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="status">Status</label>
                                                <select name="status" class="form-control" required>
                                                    <option value="">Please Select Status</option>
                                                        <option value="0">Darft</option>
                                                        <option value="1">Active</option>
                                                        <option value="2">Inactive</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="step-3">
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <label class="custom-file-label"for="imageBanner">upload Banner Product Image</label>
                                                <input type="file" class="custom-file-input"  id="imageBanner" name="imageBanner">
                                                <div class="mt-2" id="previewBanner"></div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <label class="custom-file-label" id="images-source" for="images">upload Multi Product Image</label>
                                                <input type="file" class="custom-file-input"  id="images" name="images[]" multiple/>
                                                <div class="mt-2" id="preview"></div>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-12 col-xs-12">
                                            <button type="submit" id="submit-form" class="btn btn-success btn-block">Save</button>
                                        </div>

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
        <div class="modal fade" id="modal-edit-product" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="false">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-primary justify-content-center">
                        <h5 class="modal-title" id="staticBackdropLabel">Edit Product</h5>
                    </div>
                    <div class="modal-body">
                        <form  id="product-form-edit" enctype="multipart/form-data" action="javascript:void(0)">
                            @csrf

                            <div id="smartwizard_edit">
                                <ul>
                                    <li><a href="#step-1">Step 1<br /><small>Product Info</small></a></li>
                                    <li><a href="#step-2">Step 2<br /><small>Product Dimensi</small></a></li>
                                    <li><a href="#step-3">Step 3<br /><small>Product Image</small></a></li>
                                </ul>
                                <div class="mt-4">
                                    <div id="step-1">
                                        <div class="row">

                                            {{--  <div class="form-group col-md-6">  --}}
                                                {{--  <label for="id">ID</label>  --}}
                                                <input type="hidden" class="form-control" id="id" name="id" required>
                                            {{--  </div>  --}}
                                            <div class="form-group col-md-6">
                                                <label for="sku_edit">SKU</label>
                                                <input type="text" class="form-control" id="sku_edit" name="sku_edit" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="name_edit">Name</label>
                                                <input type="text" class="form-control" id="name_edit" name="name_edit"  required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="price_edit">Price</label>
                                                <div class="input-group mb-2">
                                                    <div class="input-group-prepend">
                                                      <div class="input-group-text">Rp</div>
                                                    </div>
                                                    <input type="text" class="form-control" id="price_edit" name="price_edit" required>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="category_edit">Category</label>
                                                <select name="category_edit" class="form-control" id="category_edit"  required>
                                                    <option value="">Please select category</option>
                                                    @foreach($category as $cat)
                                                        <option value="{{$cat->id}}">{{$cat->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="sd_edit">Short Description</label>
                                                <textarea class="form-control" id="sd_edit" name="sd_edit" rows="3" required> </textarea>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="description_edit">Description</label>
                                                <textarea class="form-control" id="description_edit" name="description_edit" rows="3" required></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="step-2">
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="weight_edit">Weight</label>
                                                <input type="text" class="form-control" id="weight_edit" name="weight_edit">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="length_edit">Length</label>
                                                <input type="text" class="form-control" id="length_edit" name="length_edit">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="width_edit">Width</label>
                                                <input type="text" class="form-control" id="width_edit" name="width_edit">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="height_edit">Height</label>
                                                <input type="text" class="form-control" id="height_edit" name="height_edit">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="status_edit">Status</label>
                                                <select name="status_edit" id="status_edit" class="form-control" required>
                                                    <option value="">Please Select Status</option>
                                                        <option value="0">Darft</option>
                                                        <option value="1">Active</option>
                                                        <option value="2">Inactive</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="step-3">
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <label class="custom-file-label"for="imageBannerEdit">upload Banner Product Image</label>
                                                <input type="file" class="custom-file-input"  id="imageBannerEdit" name="imageBannerEdit">
                                                <div class="mt-2" id="previewBannerEdit"></div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <label class="custom-file-label" id="images-source" for="images_edit">upload Image</label>
                                                <input type="file" class="custom-file-input"  id="images_edit" name="images_edit[]" multiple/>
                                                <div class="mt-2" id="preview_edit"></div>
                                            </div>
                                            <div class="form-group col-md-12 col-xs-12">
                                                <button type="submit" id="submit-form-edit" class="btn btn-success btn-block">Save</button>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="modal-footer col-md-12 justify-content-center">
                                <button type="button" class="btn btn-primary" id="cencel" data-dismiss="modal">Cancel</button>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- end modal Edit--}}

        

    {{--  End product  --}}
@endsection


