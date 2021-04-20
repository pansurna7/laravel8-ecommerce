// ====================Menu===================================//
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
        $('#ambah-edit-modal').on('shown.bs.modal', function (e) { $(document).off('focusin.modal'); });
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
        $('#edit-modal').on('shown.bs.modal', function (e) { $(document).off('focusin.modal'); });

        $('body').on('click', '.edit-menu', function () {
            var id = $(this).attr('menu-id');

            $.get("edit/"+id, function (menu) {
                $('#edit-modal').modal('show');
                $('#id').val(menu.data.id);
                $('#name2').val(menu.data.menu);
                $('#right_icon2').val(menu.data.icon_right);
                $('#icon-left2').val(menu.data.icon_left);
                // ("btn-icon-left2").attr('data-icon',menu.data.icon_left)
                $('#btn-icon-left2').iconpicker(
                  {
                  align: 'left', // Only in div tag
                  arrowClass: 'btn-danger',
                  arrowPrevIconClass: 'fas fa-angle-left',
                  arrowNextIconClass: 'fas fa-angle-right',
                  cols: 10,
                  footer: true,
                  header: true,
                  icon: menu.data.icon_left,
                  iconset: 'fontawesome5',
                  labelHeader: '{0} of {1} pages',
                  labelFooter: '{0} - {1} of {2} icons',
                  placement: 'bottom', // Only in button tag
                  rows: 5,
                  search: true,
                  // searchText: menu.data.icon_left,
                 
                  selectedClass: 'btn-success',
                  unselectedClass: ''
                })
                // $('#target').iconpicker('setIcon', menu.data.icon_left)
                $('#btn-icon-left2').on('change', function(e) {
                  $('#icon-left2').val(e.icon);
              });

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
                }
              })



        });
})
//====================End Menu===================================//

//====================Sub Menu===================================//
$(document).ready( function () {
    $("#tbl-submenu").DataTable({
        processing:true,
        serverSide:true,
        responsive:true,
        ajax :{
          url:"show-all-submenu",
          type:"GET"
        },
        columns:[
          {"data": null,"sortable":false,
            render: function(data,type,row,meta){
              return meta.row + meta.settings._iDisplayStart + 1
            }
          },
          {data:"id", name:"id",visible:false},
          {data:"title", name:"sub-menu-name"},
          {data:"parent", name:"parent"},
          {data:"slug", name:"slug"},
          {data:"icon", name:"icon"},
          {data:"action", name:"action",orderable: false}

        ]
    })
    
    $('#btn-submenu-add').click(function(){
      // alert('ok')
        var modal=$('#submenu-modal')
        modal.modal('show');
        
        $('#submenu-form').find('input[type="text"]').val('');
        // $('#id').val('');
        $('#btn-save-submenu').html('Save')
        

     
    });

});

 
 
      
  
  
//====================End Sub Menu===================================//


