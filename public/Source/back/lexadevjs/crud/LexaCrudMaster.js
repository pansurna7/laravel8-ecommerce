 //+++++++++++CATEGORY++++++++++++++++++++++++++++++++++++++//
$(document).ready( function () {
   // Show Data Table Category
    $("#tbl-category").DataTable({
        processing:true,
        serverSide:true,
        responsive:true,
        autoWidth: true,
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
          {data:"banner", name:"banner"},
          {data:"slug", name:"slug"},
          {data:"status", name:"status"},
          {data:"action", name:"action",orderable: false}
        ]
    })


    //Add modal window
    $('#btn-category-add').click(function(){
        // alert('ok')
        var modal=$('#modal-tambah-category')
        var $el = $('#CategoryForm');
        modal.modal('show');
        // $('#modal-tambah-category').on('shown.bs.modal', function (e) { $(document).off('focusin.modal'); });
        $el.wrap('<form>').closest('form').get(0).reset();
        $el.unwrap();

    });
    // show icon upload image
    $("#input-fa").fileinput({
        theme:"fa",
        uploadUrl:"/file"
    })

    // POST DATA TO CategoryCONTROLLER(store)

    $('#CategoryForm').on('submit',function(e) {
        e.preventDefault();

            $.ajax({
                type: "post",
                url: "store",
                data: $('#CategoryForm').serialize(),
                // cache: false,
                // contentType:false,
                // processData:false,
                dataType:"JSON",

                success: function (res) {
                    console.log(res.data)

                    //   swal({
                    //     type:"Success",
                    //     title: "Success",
                    //     text: res.text,
                    //     icon: "success", //built in icons: success, warning, error, info
                    //     timer: 3000, //timeOut for auto-close
                    //     })
                    iziToast.success({ //tampilkan iziToast dengan notif data berhasil disimpan pada posisi kanan bawah
                        title: 'Success',
                        message: res.massage,
                        position: 'bottomRight'
                    });
                    $('#modal-tambah-category').modal('hide');
                    $('#CategoryForm').find('input[type="text"]').val('');
                    $('#tbl-category').DataTable().ajax.reload(null,false);
                    // window.location.reload();
                },
                // error: function (data) { //jika error tampilkan error pada console
                //     console.log('Error:', data);
                //     $('#submit-form').html('Save');
                // }
            });

    });


})
 //+++++++++++END CATEGORY++++++++++++++++++++++++++++++++++++++//
