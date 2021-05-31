 //+++++++++++CATEGORY++++++++++++++++++++++++++++++++++++++//
$(document).ready( function () {
   // Show Data Table Category
    $("#tbl-category").DataTable({
        processing:true,
        serverSide:true,
        responsive:true,
        autoWidth: true,
        "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
        ajax :{
          url:"show-all-category",
          type:"GET",
          dataType:"JSON"
        },
        columns:[
          {"data": null,"sortable":false,
            render: function(data,type,row,meta){
              return meta.row + meta.settings._iDisplayStart + 1
            }
          },
          {data:"id", name:"id",visible:false},
          {data:"name", name:"name"},
        //   {data:"banner", name:"banner"},
        {data:"banner","sortable":false,
            render: function(data){
              return '<img src="/Source/back/dist/img/category/'+data+'" width="150" height="150">'
            }
        },
          {data:"slug", name:"slug"},

        {data:"status","sortable":true,
            render: function(data){
              return data=='1' ? '<span class="badge badge-success">'+'Active'+'</span>' : '<span class="badge badge-danger">'+'Not Active'+'</span>'
            }
        },
          {data:"action", name:"action",orderable: false}
        ]
    })


    // show modal tambah category

    $('#btn-category-add').click(function(){

        var modal=$('#modal-tambah-category')
        var $el = $('#CategoryForm');
        modal.modal('show');
        $('#modal-tambah-category').on('shown.bs.modal', function (e) { $(document).off('focusin.modal'); });
        $el.wrap('<form>').closest('form').get(0).reset();
        $el.unwrap();
        $('#priviewImg').attr('src', '');

    })

    // POST DATA
    $('#CategoryForm').submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
           type:'POST',
           url: "store",
           dataType:'json',
           data: formData,
           cache:false,
           contentType: false,
           processData: false,
           success: (res) => {
                iziToast.success({ //tampilkan iziToast dengan notif data berhasil disimpan pada posisi kanan bawah
                    title: 'Success',
                    message: res.massage,
                    position: 'topRight'

                });
                $('#modal-tambah-category').modal('hide');
                $('#CategoryForm').find('input[type="text"]').val('');
                $('#tbl-category').DataTable().ajax.reload(null,false);
                // window.location.reload();
            },
            error: function (request,status,error) { //jika error tampilkan error pada console

                iziToast.error({ //tampilkan iziToast dengan notif data berhasil disimpan pada posisi kanan bawah
                    title: 'Ups!!!',
                    message: request.responseText,
                    position: 'topRight'
                });
            }
        });
    });
    //priview image
    $('#image_edit').change(function(){
        let reader = new FileReader();
        reader.onload = (e) => {
            $('#preview-image-before-upload').attr('src', e.target.result);
        }
        reader.readAsDataURL(this.files[0]);
    });
    //Edit modal window
    $('body').on('click', '.edit-category', function () {
        var id = $(this).attr('category-id');
        var modal=$('#modal-edit-category');
        modal.modal('show');
        $('#modal-edit-category').on('shown.bs.modal', function (e) { $(document).off('focusin.modal'); });
        $.get("edit/"+id, function (cat) {
            $('#id').val(cat.data.id);
            $('#name-edit').val(cat.data.name);
            $('#status-edit').prop('checked',cat.data.status);
            // $('#image-source').empty();
            // $("#image-source").html(cat.data.banner);
            $('#preview-image-before-upload').attr('src','/Source/back/dist/img/category/'+cat.data.banner);
        })

    });

    // SAVE EDIT DATA
    $('#category-edit-form').submit(function(e) {
        e.preventDefault();
        let id=$('#category-edit-form').find('#id').val()
        var formData = new FormData(this);
        $.ajax({
           type:'POST',
           url: "update/" +id,
           data: formData,
           cache:false,
           contentType: false,
           processData: false,
           success: (res) => {
                iziToast.success({ //tampilkan iziToast dengan notif data berhasil disimpan pada posisi kanan bawah
                    title: 'Success',
                    message: res.msg,
                    position: 'topRight'
                });
                $('#modal-edit-category').modal('hide');
                $('#category-edit-form').find('input[type="text"]').val('');
                $('#tbl-category').DataTable().ajax.reload(null,false);
                // window.location.reload();
            },

            error: function (data) { //jika error tampilkan error pada console
                console.log('Error:', data);

            }
        });
    });

    // Delete Category
    $('body').on('click', '.delete-category', function () {
        var category_id=$(this).attr('category-id');
        var category_name=$(this).attr('category-name');
        Swal.fire({
            title: 'Are you sure?',
            text: "Delete category " + category_id + "?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
          })

          .then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "get",
                    url: "destroy/"+category_id,
                    data: {id:category_id},
                    success: function (res) {
                        $('#tbl-category').DataTable().ajax.reload(null,false);
                        // window.location.reload();
                        iziToast.success({ //tampilkan iziToast dengan notif data berhasil disimpan pada posisi kanan bawah
                            title: 'Success',
                            message: res.msg,
                            position: 'bottomRight'
                        });
                    }
                });
            }
          })



        });

})
 //+++++++++++END CATEGORY++++++++++++++++++++++++++++++++++++++//

 //+++++++++++PRODUCT++++++++++++++++++++++++++++++++++++++//
$(document).ready( function () {
    // Show All Data On Data Table
     $("#tbl-product").DataTable({
         processing:true,
         serverSide:true,
         responsive:true,
         autoWidth: true,
         "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
         ajax :{
           url:"show-all-product",
           type:"GET",
           dataType:"JSON"
         },
         columns:[
           {"data": null,"sortable":false,
             render: function(data,type,row,meta){
               return meta.row + meta.settings._iDisplayStart + 1
             }
           },
           {data:"sku", name:"sku",visible:false},
           {data:"name", name:"name"},
           {data:"price", name:"price"},

            {data:"status","sortable":true,
                 render: function(data){
                    return data=='1' ? '<span class="badge badge-success">'+'Active'+'</span>' : '<span class="badge badge-danger">'+'Not Active'+'</span>'
                 }
            },
           {data:"action", name:"action",orderable: false}
         ]
     })


     // show modal tambah category

     $('#btn-product-add').click(function(){

         var modal=$('#modal-tambah-product')
         var $el = $('#product-form');
         modal.modal('show');
         $('#modal-tambah-category').on('shown.bs.modal', function (e) { $(document).off('focusin.modal'); });
         $el.wrap('<form>').closest('form').get(0).reset();
         $el.unwrap();
         $('#priviewImg').attr('src', '');

     })

     // POST DATA
     $('#CategoryForm').submit(function(e) {
         e.preventDefault();
         var formData = new FormData(this);
         $.ajax({
            type:'POST',
            url: "store",
            dataType:'json',
            data: formData,
            cache:false,
            contentType: false,
            processData: false,
            success: (res) => {
                 iziToast.success({ //tampilkan iziToast dengan notif data berhasil disimpan pada posisi kanan bawah
                     title: 'Success',
                     message: res.massage,
                     position: 'topRight'

                 });
                 $('#modal-tambah-category').modal('hide');
                 $('#CategoryForm').find('input[type="text"]').val('');
                 $('#tbl-category').DataTable().ajax.reload(null,false);
                 // window.location.reload();
             },
             error: function (request,status,error) { //jika error tampilkan error pada console

                 iziToast.error({ //tampilkan iziToast dengan notif data berhasil disimpan pada posisi kanan bawah
                     title: 'Ups!!!',
                     message: request.responseText,
                     position: 'topRight'
                 });
             }
         });
     });
     //priview image
     $('#image_edit').change(function(){
         let reader = new FileReader();
         reader.onload = (e) => {
             $('#preview-image-before-upload').attr('src', e.target.result);
         }
         reader.readAsDataURL(this.files[0]);
     });
     //Edit modal window
     $('body').on('click', '.edit-category', function () {
         var id = $(this).attr('category-id');
         var modal=$('#modal-edit-category');
         modal.modal('show');
         $('#modal-edit-category').on('shown.bs.modal', function (e) { $(document).off('focusin.modal'); });
         $.get("edit/"+id, function (cat) {
             $('#id').val(cat.data.id);
             $('#name-edit').val(cat.data.name);
             $('#status-edit').prop('checked',cat.data.status);
             // $('#image-source').empty();
             // $("#image-source").html(cat.data.banner);
             $('#preview-image-before-upload').attr('src','/Source/back/dist/img/category/'+cat.data.banner);
         })

     });

     // SAVE EDIT DATA
     $('#category-edit-form').submit(function(e) {
         e.preventDefault();
         let id=$('#category-edit-form').find('#id').val()
         var formData = new FormData(this);
         $.ajax({
            type:'POST',
            url: "update/" +id,
            data: formData,
            cache:false,
            contentType: false,
            processData: false,
            success: (res) => {
                 iziToast.success({ //tampilkan iziToast dengan notif data berhasil disimpan pada posisi kanan bawah
                     title: 'Success',
                     message: res.msg,
                     position: 'topRight'
                 });
                 $('#modal-edit-category').modal('hide');
                 $('#category-edit-form').find('input[type="text"]').val('');
                 $('#tbl-category').DataTable().ajax.reload(null,false);
                 // window.location.reload();
             },

             error: function (data) { //jika error tampilkan error pada console
                 console.log('Error:', data);

             }
         });
     });

     // Delete Row Data
     $('body').on('click', '.delete-category', function () {
         var category_id=$(this).attr('category-id');
         var category_name=$(this).attr('category-name');
         Swal.fire({
             title: 'Are you sure?',
             text: "Delete category " + category_id + "?",
             icon: 'warning',
             showCancelButton: true,
             confirmButtonColor: '#3085d6',
             cancelButtonColor: '#d33',
             confirmButtonText: 'Yes, delete it!'
           })

           .then((result) => {
             if (result.isConfirmed) {
                 $.ajax({
                     type: "get",
                     url: "destroy/"+category_id,
                     data: {id:category_id},
                     success: function (res) {
                         $('#tbl-category').DataTable().ajax.reload(null,false);
                         // window.location.reload();
                         iziToast.success({ //tampilkan iziToast dengan notif data berhasil disimpan pada posisi kanan bawah
                             title: 'Success',
                             message: res.msg,
                             position: 'bottomRight'
                         });
                     }
                 });
             }
           })



         });

 })
  //+++++++++++END PRODUCT++++++++++++++++++++++++++++++++++++++//
