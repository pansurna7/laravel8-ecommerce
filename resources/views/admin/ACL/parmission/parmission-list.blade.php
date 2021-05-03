@extends('admin.master')
@section('title')
    Parmission-List
@endsection
@section('content')
<div class="content-header mt-4 fixed">
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
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Parmission List</h3>
                                @isset(Auth::guard('admin')->user()->role->parmission['parmission']['Parmission']['add'])
                                    <a href="{{route('parmission.create')}}" class="card-title float-right">
                                        <i class="fas fa-plus-circle nav-icon"></i>
                                        Add Data
                                    </a>
                                @endisset
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                            <table id="tblMaster" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>

                                        <th>Role Name</th>
                                        <th>Parmission</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php($i=1)
                                        @foreach ($parmissions as $parmission)
                                            <tr>
                                                <td>{{$i++}}</td>
                                                <td>{{$parmission->role->name}}</td>
                                                {{--  <td>{{json_encode($parmission->parmission)}}</td>  --}}
                                                <td>

                                                        $pointsArray[$parmission]['id']  = $id = $id + 1 ;
                                                       



                                                        $arrayEncoded = json_encode($pointsArray);

                                                        $decoded = (json_encode(array_values(json_decode($arrayEncoded,true))));


                                                </td>

                                               <td>
                                                @if (@isset(Auth::guard('admin')->user()->role->parmission['parmission']['Parmission']['edit']))
                                                    <a href="{{route('parmission.edit',$parmission->id)}}" title="Edit" class="btn text-success">
                                                        <i class="fas fa-edit nav-icon"></i>
                                                    </a>
                                                @else
                                                    <a href="{{route('parmission.edit',$parmission->id)}}" title="Edit" class="btn text-success disabled" aria-disabled="true">
                                                        <i class="fas fa-edit nav-icon"></i>
                                                    </a>
                                                @endif
                                                @if (@isset(Auth::guard('admin')->user()->role->parmission['parmission']['Parmission']['delete']))
                                                <a href="#" parmission-id="{{$parmission->id}}" parmission-name="{{$parmission->name}}" title="Delete" class="btn text-danger delete-parmission">
                                                    <i class="fas fa-trash-alt nav-icon"></i>
                                                    </a>
                                                @else
                                                <a href="{{route('parmission.destroy',$parmission->id)}}" title="Delete" class="btn text-danger disabled" aria-disabled="true">
                                                    <i class="fas fa-trash-alt nav-icon"></i>
                                                </a>
                                                @endif

                                                </td>
                                            </tr>

                                        @endforeach

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Parmission Name</th>
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
