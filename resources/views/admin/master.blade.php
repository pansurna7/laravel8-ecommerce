
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
        {{-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"> --}}
        <link rel="stylesheet" href="{{asset('/Source/back/lexadevcss')}}/googlefont.css">
        <link rel="stylesheet" href="{{asset('/Source/back')}}/plugins/bootstrap/css/bootstrap.min.css"/>
        {{-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"/>  --}}
         <link rel="stylesheet" href="{{asset('/Source/back')}}/lexadevfont/fontawesome/css/all.css"/>
         {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-iconpicker/1.10.0/css/bootstrap-iconpicker.min.css"/>  --}}
         <link rel="stylesheet" href="{{asset('/Source/back')}}/lexadevcss/bootstrap-iconpicker.min.css"/>

        {{-- <!-- Theme style --> --}}
        <link rel="stylesheet" href="{{asset('/Source/back')}}/dist/css/adminlte.css">
        {{-- DataTables --}}
        <link rel="stylesheet" href="{{asset('/Source/back')}}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="{{asset('/Source/back')}}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
        <link rel="stylesheet" href="{{asset('/Source/back')}}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">


        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.css">
        {{--  <link rel="stylesheet" href="{{asset('/Source/back')}}/lexadevcss/iziToast.css">  --}}


        {{-- for file input --}}
        {{-- <link rel="stylesheet" href="{{asset('/Source/back')}}/lexadevcss/bootstrap-fileinput-min.css"> --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.1.5/css/fileinput.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.1.5/themes/explorer-fas/theme.min.css">



        {{-- for smart wizard or input steeper --}}

        <link href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/smart_wizard.min.css" rel="stylesheet" type="text/css" />
        <link href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/smart_wizard_theme_arrows.min.css" rel="stylesheet" type="text/css" />

          {{-- end for smart wizard or input steeper --}}

        <link rel="stylesheet" href="{{asset('/Source/back/lexadevcss')}}/lexadev-helper.css">


        {{-- <link rel="stylesheet" href="{{asset('/Source/back')}}/lexadevcss/lexavalidate.css"> --}}


         {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.1.5/css/fileinput.min.css"> --}}

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
                Lexadev Panggabean
                </div>
                <!-- Default to the left -->
                <strong>Copyright &copy; {{date("Y")}} <a href="https://lexadev.id">lexadev.id</a>.</strong> All rights reserved.
            </footer>

        </div>
        <!-- ./wrapper -->

        <!-- REQUIRED SCRIPTS -->

        <!-- jQuery -->
            <script type="text/javascript" src="{{asset('/Source/back/lexadevjs')}}/jquery-3.3.1.min.js"></script>
            <!-- Bootstrap CDN -->
            <script type="text/javascript" src="{{asset('/Source/back')}}/plugins/bootstrap/js/bootstrap.bundle.js"></script>

            <!-- Bootstrap-Iconpicker Bundle -->
            <script src="{{asset('/Source/back/lexadevjs')}}/bootstrap-iconpicker.bundle.min.js"></script>

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
            <script src="{{asset('/Source/back/lexadevjs')}}/iziToast.js"></script>
            {{-- file input --}}
            {{-- <script src="{{asset('/Source/back/lexadevjs')}}/bootstrap-fileinput.min.js"></script>
            <script src="{{asset('/Source/back/lexadevjs')}}/bootsrap-fileinput-theme.min.js"></script> --}}
            <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.1.5/js/fileinput.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.1.5/js/locales/id.min.js"></script>

            <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.1.5/themes/fas/theme.min.js"></script>
           <script src="https://cdn.jsdelivr.net/npm/piexifjs@1.0.6/piexif.min.js"></script>
            {{-- end file input --}}

            <script type="text/javascript" src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/jquery.smartWizard.min.js"></script>



            <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/additional-methods.js"></script>

            <script src="{{asset('/Source/back/lexadevjs')}}/lexadev.js"></script>
            <script src="{{asset('/Source/back/lexadevjs/crud')}}/LexaCrudMaster.js"></script>
            <script src="{{asset('/Source/back/lexadevjs')}}/jquery.number.js"></script>

            <script>
                $(function () {
                  $("#tblMaster").DataTable({
                    "paging": true,
                    "lengthChange": false,
                    "searching": false,
                    "ordering": true,
                    "info": true,
                    "autoWidth": true,
                    "responsive": true,
                    "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
                  }).buttons().container().appendTo('#tblMaster_wrapper .col-md-6:eq(0)');
                  $('#example2').DataTable({
                    "paging": true,
                    "lengthChange": false,
                    "searching": false,
                    "ordering": true,
                    "info": true,
                    "autoWidth": true,
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
