@extends('admin.master')
@section('title')
    Items
@endsection
@section('content')
            <!-- Content Header (Page header) -->
            <div class                                        = "content-header">
                <div class                                    = "container-fluid">
                    <div class                                = "row mb-2">
                        <div class                            = "col-sm-6">
                                <h1 class                     = "text-right">LIST ITEM</h1>
                        </div><!-- /.col -->
                        <div class                            = "col-sm-6">
                            <ol class                         = "breadcrumb float-sm-right">
                                <li class                     = "breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                                <li class                     = "breadcrumb-item active">@yield('title')</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
                <!-- /.content-header -->
                <div class="container">
                    <h1>Laravel 7 Crud with Ajax</h1>
                    <a class="btn btn-success" href="javascript:void(0)" id="createNewBook"> Create New Book</a>
                    <table class="table table-bordered data-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>name</th>
                                <th>total</th>
                                <th width="300px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                   
               
                <script type="text/javascript">
                    $(function () {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                      });
                      var table = $('.data-table').DataTable({
                          processing: true,
                          serverSide: true,
                          ajax: "{{ route('items.manage') }}",
                          columns: [
                              {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                              {data: 'name', name: 'name'},
                              {data: 'total', name: 'total'},
                              {data: 'action', name: 'action', orderable: false, searchable: false},
                          ]
                      });
                      
                     
                     
                      
                      
                       
                    });
                  </script>
@endsection