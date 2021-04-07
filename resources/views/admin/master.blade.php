
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Lexadev||@yield('title')</title>

        {{-- <!-- Google Font: Source Sans Pro --> --}}
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome Icons -->
        <link rel="stylesheet" href="{{asset('/Source/back')}}/plugins/fontawesome-free/css/all.min.css">
        {{-- <!-- Theme style --> --}}

        <link rel="stylesheet" href="{{asset('/Source/back')}}/dist/css/adminlte.min.css">


        {{-- DataTables --}}
        <link rel="stylesheet" href="{{asset('/Source/back')}}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="{{asset('/Source/back')}}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
        <link rel="stylesheet" href="{{asset('/Source/back')}}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">



    </head>
    <body class="hold-transition sidebar-mini layout-fixed layout-footer-fixed">
        <div class="wrapper">
            message swet aler 2
            @include('sweetalert::alert')
            <!-- Navbar -->
            @include('admin.include.nav')
            <!-- /.navbar -->

            <!-- Main Sidebar Container -->
            @include('admin.include.sidebar')

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->

                <!-- /.content-header -->

                <!-- Main content -->
                    @yield('content')
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->

            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
                <div class="p-3">
                <h5>Title</h5>
                <p>Sidebar content</p>
                </div>
            </aside>
            <!-- /.control-sidebar -->

            <!-- Main Footer -->
            <footer class="main-footer">
                <!-- To the right -->
                <div class="float-right d-none d-sm-inline">
                Anything you want
                </div>
                <!-- Default to the left -->
                <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
            </footer>

        </div>
        <!-- ./wrapper -->

        <!-- REQUIRED SCRIPTS -->

        <!-- jQuery -->
        <script src="{{asset('/Source/back')}}/plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="{{asset('/Source/back')}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- AdminLTE App -->
        <script src="{{asset('/Source/back')}}/dist/js/adminlte.min.js"></script>
        <!-- DataTables  & Plugins -->
            <script src="{{asset('/Source/back')}}/plugins/datatables/jquery.dataTables.min.js"></script>
            <script src="{{asset('/Source/back')}}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
            <script src="{{asset('/Source/back')}}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
            <script src="{{asset('/Source/back')}}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
            <script src="{{asset('/Source/back')}}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
            <script src="{{asset('/Source/back')}}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
            <script src="{{asset('/Source/back')}}/plugins/jszip/jszip.min.js"></script>
            <script src="{{asset('/Source/back')}}/plugins/pdfmake/pdfmake.min.js"></script>
            <script src="{{asset('/Source/back')}}/plugins/pdfmake/vfs_fonts.js"></script>
            <script src="{{asset('/Source/back')}}/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
            <script src="{{asset('/Source/back')}}/plugins/datatables-buttons/js/buttons.print.min.js"></script>
            <script src="{{asset('/Source/back')}}/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
            <script src="{{asset('/Source/back')}}/plugins/jquery-validation/jquery.validate.min.js"></script>
            <script src="{{asset('/vendor')}}/sweetalert/sweetalert.all.js"></script>
            <script src="{{asset('/vendor')}}/sweetalert/sweetalert.min.js"></script>



            <script src="{{asset('/Source/back/jscustom')}}/myjs.js"></script>
            <script>
                $(function () {
                  $("#tblMaster").DataTable({
                    "responsive": true, "lengthChange": true, "autoWidth": false,
                    "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
                  }).buttons().container().appendTo('#tblMaster_wrapper .col-md-6:eq(0)');
                  $('#example2').DataTable({
                    "paging": true,
                    "lengthChange": false,
                    "searching": false,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false,
                    "responsive": true,
                  });
                })

                {{--  Priview image Profile User  --}}
                function priviewFile(input){
                    $("#file").attr("")
                    var file=$("input[type=file]").get(0).files[0];
                    if(file)
                    {
                        var reader=new FileReader()
                        reader.onload = function(){
                           $("#priviewImg").attr("src",reader.result)
                        }
                        reader.readAsDataURL(file);
                    }
                }
              </script>

    </body>
</html>
