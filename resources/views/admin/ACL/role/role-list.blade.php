@extends('admin.master')
@section('title')
    Role List
@endsection
@section('content')
    <div class="content-header mt-4 fixed">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Role Page</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">

                                <a href="{{route('role.index')}}" class="card-title">Role List</a>

                        </li>
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
                                <h3 class="card-title">Role List</h3>
                                @isset(Auth::guard('admin')->user()->role->parmission['parmission']['role']['add'])
                                    <a href="{{route('role.create')}}" class="card-title float-right">
                                        <i class="fas fa-plus-circle nav-icon"></i>
                                        Add Role
                                    </a>

                                @endisset
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                            <table id="tblMaster" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php($i=1)
                                        @foreach ($roles as $role)
                                            <tr>
                                                <td>{{$i++}}</td>
                                                <td>{{$role->name}}</td>
                                               <td>
                                                   @if (@isset(Auth::guard('admin')->user()->role->parmission['parmission']['role']['edit']))
                                                        <a data-toggle="modal" data-target="#RoleUpdate{{$role->id}}" title="Edit" class="btn text-success">
                                                            <i class="fas fa-edit nav-icon"></i>
                                                        </a>
                                                    @else
                                                        <a data-toggle="modal"  data-target="#RoleUpdate{{$role->id}}" title="Edit" class="btn text-success disabled" aria-disabled="true">
                                                            <i class="fas fa-edit nav-icon"></i>
                                                        </a>
                                                    @endif

                                                   @if (@isset(Auth::guard('admin')->user()->role->parmission['parmission']['role']['delete']))
                                                        <a href="#" role-id="{{$role->id}}" role-name="{{$role->name}}" title="Delete" class="btn text-danger delete-role">
                                                            <i class="fas fa-trash-alt nav-icon"></i>
                                                        </a>
                                                    @else
                                                        <a disable="true" href="{{route('role.destroy',$role->id)}}" title="Delete" class="btn text-danger disabled" aria-disabled="true">
                                                            <i class="fas fa-trash-alt nav-icon"></i>
                                                        </a>
                                                    @endif

                                                </td>
                                            </tr>

                                            {{-- model --}}


                                            <!-- Modal -->
                                            <div class="modal fade" id="RoleUpdate{{$role->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                              <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                  <div class="modal-header bg-dark justify-content-center">
                                                    <h5 class="modal-title" id="staticBackdropLabel">Update Role</h5>

                                                  </div>
                                                  <div class="modal-body">
                                                    <form action="{{route('role.update',$role->id)}}" method="post" class="form-inline">
                                                        @csrf
                                                        <label  class="mb-2 mr-sm-2">Name</label>
                                                        <input type="text" class="form-control mb-2 mr-sm-2 @error('name') is-invalid @enderror" name="name" value="{{$role->name}}" placeholder="write Role name">
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

                                            {{-- end modal --}}
                                        @endforeach

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
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
