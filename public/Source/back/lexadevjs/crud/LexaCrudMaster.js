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
              return data=='0' ? '<span class="badge badge-danger">'+'Darft'+'</span>' : '<span class="badge badge-success">'+'Active'+'</span>'
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

    // UPDATE DATA
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

            error: function (request,status,error) { //jika error tampilkan error pada console

                iziToast.error({ //tampilkan iziToast dengan notif data berhasil disimpan pada posisi kanan bawah
                    title: 'Ups!!!',
                    message: request.responseText,
                    position: 'topRight'
                });


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
    var validator = $( "#product-form" ).validate();
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
           {data:"price", render: $.fn.dataTable.render.number( ',', '.', 0,'Rp ')},

           {data:"status","sortable":true,
           render: function(data){

             if(data=='0'){
               return '<span class="badge badge-danger">'+'Darft'+'</span>'
             } else if(data==1){
               return '<span class="badge badge-success">'+'Active'+'</span>'
             }else{
               return '<span class="badge badge-primary">'+'Inactive'+'</span>'
             }

           }
       },

           {data:"action", name:"action",orderable: false}
         ]
     })


     // show modal tambah Product

     $('#btn-product-add').click(function(){

        modal=$('#modal-tambah-product')
        validator.destroy();
        $('#product-form').trigger("reset");
        modal.modal('show');
        $('#smartwizard').smartWizard("reset");
        $('#modal-tambah-product').on('shown.bs.modal', function (e) { $(document).off('focusin.modal'); });
    })
    $.fn.fileinputBsVersion = "3.3.7";
    $("#file-1").fileinput({
         theme:'fas',
          language : 'id',
          showUpload : false,
          uploadUrl : 'https://localhost',
          allowedFileType : ['image'],
          allowedFileExtensions : ['jpg','jpeg','png'],
          autoOrientImage : false,
          showCaption : true,
          dropZoneEnabled : true,
          showRemove : false,
          maxFileCount : 5,
          maxFileSize : 10000,
        slugCallback: function (filename) {
            return filename.replace('(', '_').replace(']', '_');
        }
    });

    // STEPPER

    $('#smartwizard').smartWizard({
        selected: 0,
        theme: 'arrows',
        autoAdjustHeight:true,
        transitionEffect:'fade',
        showStepURLhash: false,
        toolbarSettings: {
            toolbarButtonPosition: 'center',
            showNextButton: true,
            showPreviousButton: true
        },
        keyboardSettings: {
            keyNavigation: true, // Enable/Disable keyboard navigation(left and right keys are used if enabled)
            keyLeft: [37], // Left key code
            keyRight: [39] // Right key code
        }

    });
    $('#smartwizard').on("leaveStep", function(e, anchorObject, stepNumber, stepDirection) {
        var elmForm = $("#form-step-" + stepNumber);
        if (stepDirection === 'forward' && elmForm) {
            // elmForm.validator('validate');
            // var elmErr = elmForm.children('.has-error');
            // if (elmErr && elmErr.length > 0) {
            //     return false;
            // }

            if ($('#product-form').valid()) {
                return true
            } else {
                return false
            }

        }
        return true;
    })
    // END STEPPER

    // Change Format to money if keyboard press

    $('#price').keyup(function(e) {
            var n = parseInt($(this).val().replace(/\D/g,''),10);
            $(this).val(n.toLocaleString());
    })
    // validation  form submit
    jQuery.validator.setDefaults({
        debug: true,
        success: "valid"
    });


    // POST DATA
    $('#product-form').submit(function(e) {
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
                $('#product-form').trigger("reset");
                $('#modal-tambah-product').modal('hide');
                $('#smartwizard').smartWizard("reset");
                $('#tbl-product').DataTable().ajax.reload(null,false);
                // window.location.reload();
            },
            error: function (request,status,error) { //jika error tampilkan error pada console
                console.log(request);
                iziToast.error({ //tampilkan iziToast dengan notif data berhasil disimpan pada posisi kanan bawah
                    title: 'Ups!!!',
                    message: request.responseText,
                    position: 'topRight'
                });
            }
        });
    });

    //Edit modal window
    $('body').on('click', '.edit-product', function () {
        var id = $(this).attr('product-id');
        var modal=$('#modal-edit-product');
        modal.modal('show');
        modal.on('shown.bs.modal', function (e) { $(document).off('focusin.modal'); });
        $.get("edit/"+id, function (pro) {
            $('#id').val(pro.data.id);
            $('#sku_edit').val(pro.data.sku);
            $('#name_edit').val(pro.data.name);
            $('#price_edit').val(pro.data.price);
            $('#price_edit').number(true,0)
            $('#category_edit').val(pro.data.category_id);
            $('#sd_edit').val(pro.data.text_description);
            $('#description_edit').val(pro.data.description);
            $('#weight_edit').val(pro.data.weight);
            $('#length_edit').val(pro.data.length);
            $('#width_edit').val(pro.data.width);
            $('#height_edit').val(pro.data.height);
            $('#status_edit').val(pro.data.status);
            $("#file-edit").fileinput({
                theme:'fas',
                 language : 'id',
                 showUpload : false,
                 uploadUrl : 'https://localhost',
                 allowedFileType : ['image'],
                 allowedFileExtensions : ['jpg','jpeg','png'],
                 autoOrientImage : false,
                 showCaption : true,
                 dropZoneEnabled : true,
                 showRemove : false,
                 maxFileCount : 5,
                 maxFileSize : 10000,
                 initialPreview: [
                    '/Source/back/dist/img/products/'+pro.data.path
                 ],
               slugCallback: function (filename) {
                   return filename.replace('(', '_').replace(']', '_');
               }
           });

        });

    });

    // Edit STEPPER

    $('#smartwizard_edit').smartWizard({
        selected: 0,
        theme: 'arrows',
        autoAdjustHeight:true,
        transitionEffect:'fade',
        showStepURLhash: false,
        toolbarSettings: {
            toolbarButtonPosition: 'center',
            showNextButton: true,
            showPreviousButton: true
        },
        keyboardSettings: {
            keyNavigation: true, // Enable/Disable keyboard navigation(left and right keys are used if enabled)
            keyLeft: [37], // Left key code
            keyRight: [39] // Right key code
        }

    });
    $('#smartwizard_edit').on("leaveStep", function(e, anchorObject, stepNumber, stepDirection) {
        var elmForm = $("#form-step-" + stepNumber);
        if (stepDirection === 'forward' && elmForm) {
            // elmForm.validator('validate');
            // var elmErr = elmForm.children('.has-error');
            // if (elmErr && elmErr.length > 0) {
            //     return false;
            // }

            if ($('#product-form').valid()) {
                return true
            } else {
                return false
            }

        }
        return true;
    })
    // END EDIT STEPPER

    // UPDATE DATA
    $('#product-form-edit').submit(function(e) {
        e.preventDefault();
        let id=$('#product-edit-form').find('#id').val()
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
                $('#product-form-edit').trigger("reset");
                $('#modal-edit-product').modal('hide');
                $('#smartwizard_edit').smartWizard("reset");
                $('#tbl-product').DataTable().ajax.reload(null,false);
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

    // Delete Category
    $('body').on('click', '.delete-product', function () {
        var product_id=$(this).attr('product-id');
        var product_name=$(this).attr('product-name');
        Swal.fire({
            title: 'Are you sure?',
            text: "Delete Product " + product_name + "?",
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
                    url: "destroy/"+product_id,
                    data: {id:product_id},
                    success: function (res) {
                        $('#tbl-product').DataTable().ajax.reload(null,false);
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
