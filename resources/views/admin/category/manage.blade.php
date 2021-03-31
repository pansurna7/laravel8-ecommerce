@extends('admin.master')
@section('title')
    Category
@endsection
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Category Page</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('category.manage')}}">Category</a></li>
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

                        {{-- message --}}
                        @if (Session::has('sms'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{Session::get('sms')}}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                        @endif
                        {{-- end message --}}

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Categories</h3>
                                <a href="{{route('category.add')}}" class="card-title float-right">
                                    <i class="fas fa-plus-circle nav-icon"></i>
                                    Add Category
                                </a>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                            <table id="tblMaster" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        {{-- <th>Slug</th> --}}
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php($i=1)
                                        @foreach ($categories as $cate)
                                            <tr>
                                                <td>{{$i++}}</td>
                                                <td>{{$cate->name}}</td>
                                                {{-- <td>{{$cate->slug}}</td> --}}
                                                <td>
                                                    @if($cate->status == 1)
                                                        <li class="text-success">
                                                            Public
                                                        </li>
                                                    @else
                                                        <li class="text-danger">
                                                            Hide
                                                        </li>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a data-toggle="modal" data-target="#CategoryUpdate{{$cate->id}}" title="Edit" class="btn text-success">
                                                        <i class="fas fa-edit nav-icon"></i>
                                                    </a>
                                                    <a href="{{route('category.destroy',$cate->id)}}" title="Delete" class="btn text-danger">
                                                        <i class="fas fa-trash-alt nav-icon"></i>
                                                    </a>
                                                    @if($cate->status == 1)
                                                        <a href="{{route('category.hide',$cate->id)}}" title="Clik To Hide" class="btn text-info">
                                                            <i class="fas fa-arrow-circle-up nav-icon"></i>
                                                        </a>
                                                    @else
                                                        <a href="{{route('category.public',$cate->id)}}" title="Clik To Public" class="btn text-dark">
                                                            <i class="fas fa-arrow-circle-down nav-icon"></i>
                                                        </a>
                                                    @endif

                                                </td>
                                            </tr>

                                            {{-- model --}}


                                            <!-- Modal -->
                                            <div class="modal fade" id="CategoryUpdate{{$cate->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                              <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                  <div class="modal-header bg-dark justify-content-center">
                                                    <h5 class="modal-title" id="staticBackdropLabel">Update Category</h5>

                                                  </div>
                                                  <div class="modal-body">
                                                    <form action="{{route('category.update',$cate->id)}}" method="post" class="form-inline">
                                                        @csrf
                                                        <label  class="mb-2 mr-sm-2">Name</label>
                                                        <input type="text" class="form-control mb-2 mr-sm-2 @error('name') is-invalid @enderror" name="name" value="{{$cate->name}}" placeholder="write category name">
                                                        @error('name')
                                                        <div class="alert alert-danger mb-2 mr-sm-2">{{ $message }}</div>
                                                        @enderror
                                                        {{-- <button type="submit" class="btn btn-info mb-2">Submit</button> --}}

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Save</button>
                                                        </div>
                                                </form>
                                                </div>
                                              </div>
                                            </div>

                                            {{-- end model --}}
                                        @endforeach

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        {{-- <th>Slug</th> --}}
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                    </div>
                </div>
            </div>
    </section>



@endsection
