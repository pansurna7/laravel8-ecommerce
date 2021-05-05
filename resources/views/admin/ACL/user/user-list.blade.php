@extends('admin.master')
@section('title')
    User List
@endsection
@section('content')
    <div class="content-header mt-4 fixed">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">User Page</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">

                                <a href="{{route('all-user')}}" class="card-title">User List</a>

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
                            <div class="alert alert-success alert-dismissible fade show" user="alert">
                                {{Session::get('sms')}}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                        @endif
                        {{-- end message --}}

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">user List</h3>
                                @isset(Auth::guard('admin')->user()->role->parmission['parmission']['User']['add'])
                                    <a href="{{route('user.create')}}" class="card-title float-right">
                                        <i class="fas fa-plus-circle nav-icon"></i>
                                        Add user
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
                                        <th>Role</th>
                                        <th>Email</th>
                                        <th>Image</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php($i=1)
                                        @foreach ($users as $user)
                                            <tr>
                                                <td>{{$i++}}</td>
                                                <td>{{$user->name}}</td>
                                                <td>{{$user->role->name}}</td>
                                                <td>{{$user->email}}</td>
                                                <td> <img src="{{asset('Source/back/dist/img/profile')}}/{{$user->image}}" class="img-circle elevation-2" alt="User Image" style="max-width:60px">
                                                </td>

                                               <td>
                                                @if (@isset(Auth::guard('admin')->user()->role->parmission['parmission']['User']['edit']))
                                                        <a href="{{route('user-edit',$user->id)}}" title="Change this" class="btn text-success ">
                                                            <i class="fas fa-edit nav-icon"></i>
                                                        </a>
                                                    @else
                                                        <a data-toggle="modal"  data-target="#userUpdate{{$user->id}}" title="Edit" class="btn text-success disabled" aria-disabled="true">
                                                            <i class="fas fa-edit nav-icon"></i>
                                                        </a>
                                                    @endif

                                                    @if (@isset(Auth::guard('admin')->user()->role->parmission['parmission']['User']['edit']))

                                                         <a href="#" user-id="{{$user->id}}" user-name="{{$user->name}}" title="Delete" class="btn text-danger delete-user">
                                                            <i class="fas fa-trash-alt nav-icon"></i>
                                                   @else
                                                        <a disable="true" href="{{route('user.destroy',$user->id)}}" title="Delete" class="btn text-danger disabled" aria-disabled="true">
                                                            <i class="fas fa-trash-alt nav-icon"></i>
                                                        </a>
                                                    @endif

                                                </td>
                                            </tr>

                                            {{-- model --}}



                                        @endforeach

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Role</th>
                                        <th>Email</th>
                                        <th>Image</th>
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
