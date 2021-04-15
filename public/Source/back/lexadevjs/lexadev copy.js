$(document).ready( function () {
    // Show Data Table Menu
    $("#tblMenu").DataTable({
        processing:true,
        serverSide:true,
        responsive:true,
        ajax :{
          url:"show-all-menu",
          type:"GET"
        },
        columns:[
          {"data": null,"sortable":false,
            render: function(data,type,row,meta){
              return meta.row + meta.settings._iDisplayStart + 1
            }
          },
          {data:"id", name:"id",visible:false},
          {data:"menu", name:"name"},
          {data:"icon_right", name:"right_icon"},
          {data:"icon_left", name:"left_icon"},
          {data:"action", name:"action",orderable: false}
        ]
    })

        //Add modal window
        $('#btnMenuAdd').click(function(){
            // alert('ok')
              var modal=$('#tambah-edit-modal')
              modal.modal('show');
              $('#MenuForm').find('input[type="text"]').val('');
              $('#id').val('');
              $('#submitForm').html('Save')
          });

        // POST DATA TO MENUCONTROLLER(store)

            $('#MenuForm').on('submit',function(e) {
                e.preventDefault();

                    $.ajax({
                        type: "post",
                        url: "store",
                        data: $('#MenuForm').serialize(),
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
                                message: res.text,
                                position: 'bottomRight'
                            });
                            $('#tambah-edit-modal').modal('hide');
                            $('#MenuForm').find('input[type="text"]').val('');
                            $('#tblMenu').DataTable().ajax.reload(null,false);
                        },
                        error: function (data) { //jika error tampilkan error pada console
                            console.log('Error:', data);
                            $('#submitForm').html('Save');
                        }
                    });

            });


        //Edit modal window
        $('body').on('click', '.edit-menu', function () {
            var id = $(this).attr('menu-id');

            $.get("edit/"+id, function (menu) {
                $('#edit-modal').modal('show');
                $('#id').val(menu.data.id);
                $('#name2').val(menu.data.menu);
                $('#right_icon2').val(menu.data.icon_right);
                $('#left_icon2').val(menu.data.icon_left);

            })
        });


        // save Edit Data
        $('#MenuEditForm').on('submit',function(e) {
            e.preventDefault();
            let id=$('#MenuEditForm').find('#id').val()
            let formData=$('#MenuEditForm').serialize()
            console.log(formData)
            // alert(id)
            $.ajax({
                type: "PATCH",
                url: "update/" + id,
                data: formData,

                success: function (res) {


                //   swal({
                //     type:"Success",
                //     title: "Success",
                //     text: res.text,
                //     icon: "success", //built in icons: success, warning, error, info
                //     timer: 3000, //timeOut for auto-close
                //     })
                iziToast.success({ //tampilkan iziToast dengan notif data berhasil disimpan pada posisi kanan bawah
                    title: 'Success',
                    message: res.msg,
                    position: 'bottomRight'
                });
                $('#edit-modal').modal('hide');

                  $('#tblMenu').DataTable().ajax.reload(null,false);
                },
                error: function (data) { //jika error tampilkan error pada console
                    console.log('Error:', data);

                 }
            });
          });

          //Delete Record
          $('body').on('click', '.delete-menu', function () {
            var menu_id=$(this).attr('menu-id');
            var menu_name=$(this).attr('menu-name');
            Swal.fire({
                title: 'Are you sure?',
                text: "Delete Menu Name " + menu_name + "?",
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
                        url: "destroy/"+menu_id,
                        data: {id:menu_id},
                        success: function (res) {
                            $('#tblMenu').DataTable().ajax.reload(null,false);
                            iziToast.success({ //tampilkan iziToast dengan notif data berhasil disimpan pada posisi kanan bawah
                                title: 'Success',
                                message: res.msg,
                                position: 'bottomRight'
                            });
                        }
                    });
                //   Swal.fire(
                //     'Deleted!',
                //     'Your file has been deleted.',
                //     'success'
                //   )
                }
              })



        });


})

