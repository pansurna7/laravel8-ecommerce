@extends('admin.master')
@section('parmission')
    Parmission-List
@endsection
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Parmission Page</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('parmission.index')}}">Parmission</a></li>
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
                                <h3 class="card-title">Parmission List</h3>
                                <a href="{{route('parmission.create')}}" class="card-title float-right">
                                    <i class="fas fa-plus-circle nav-icon"></i>
                                    Add Parmission
                                </a>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                            <table id="tblMaster" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>

                                        <th>Role Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php($i=1)
                                        @foreach ($parmissions as $parmission)
                                            <tr>
                                                <td>{{$i++}}</td>
                                                <td>{{$parmission->role->name}}</td>

                                               <td>
                                                    <a href="{{route('parmission.edit',$parmission->id)}}" title="Edit" class="btn text-success">
                                                        <i class="fas fa-edit nav-icon"></i>
                                                    </a>
                                                    <a href="{{route('parmission.destroy',$parmission->id)}}" title="Delete" class="btn text-danger">
                                                        <i class="fas fa-trash-alt nav-icon"></i>
                                                    </a>

                                                </td>
                                            </tr>

                                        @endforeach

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Role Name</th>
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
