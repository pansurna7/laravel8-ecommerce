// ====================Menu===================================//
$(document).ready( function () {

    let icon_picker=
    ({
        align: 'left', // Only in div tag
        arrowClass: 'btn-danger',
        arrowPrevIconClass: 'fas fa-angle-left',
        arrowNextIconClass: 'fas fa-angle-right',
        cols: 10,
        footer: true,
        header: true,

        iconset: 'fontawesome5',
        labelHeader: '{0} of {1} pages',
        labelFooter: '{0} - {1} of {2} icons',
        placement: 'bottom', // Only in button tag
        rows: 5,
        search: true,
        // searchText: menu.data.icon_left,

        selectedClass: 'btn-success',
        unselectedClass: ''
    });
    // Show Data Table Menu
    $("#tblMenu").DataTable({
        processing:true,
        serverSide:true,
        responsive:true,
        autoWidth: true,
        ajax :{
          url:"show-all-menu",
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
          {data:"menu", name:"name"},
          {data:"submenu", name:"submenu"},
          {data:"icon_left", name:"left_icon"},
          {data:"icon_right", name:"right_icon"},
          {data:"action", name:"action",orderable: false}
        ]
    })

        //Add modal window
        $('#btnMenuAdd').click(function(){
            // alert('ok')
            var modal=$('#tambah-edit-modal')
            modal.modal('show');
            $('#tambah-edit-modal').on('shown.bs.modal', function (e) { $(document).off('focusin.modal'); });
            $('#MenuForm').find('input[type="text"]').val('');
            $('#id').val('');
            $('#left_icon').val('');
            $('#right_icon').val('');
            $('#btn-icon-left').iconpicker(icon_picker)
            $('#btn-icon-right').iconpicker(icon_picker)
            $('#submitForm').html('Save')
            $('#btn-icon-left').on('change', function(e) {
                $('#left_icon').val(e.icon);
            });
            $('#btn-icon-right').on('change', function(e) {
                $('#right_icon').val(e.icon);
            });
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
                            // $('#tblMenu').DataTable().ajax.reload(null,false);
                            window.location.reload();
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
            var modal=$('#edit-modal')
            modal.modal('show');
            $('#edit-modal').on('shown.bs.modal', function (e) { $(document).off('focusin.modal'); });
            $.get("edit/"+id, function (menu) {
                $('#id').val(menu.data.id);
                $('#name2').val(menu.data.menu);
                $('#icon-right2').val(menu.data.icon_right);
                $('#icon-left2').val(menu.data.icon_left);
                $('#btn-icon-left2').iconpicker(icon_picker)
                $('#btn-icon-left2').iconpicker('setIcon',menu.data.icon_left)
                $('#btn-icon-right2').iconpicker(icon_picker)
                $('#btn-icon-right2').iconpicker('setIcon',menu.data.icon_right)


                $('#btn-icon-left2').on('change', function(e) {
                    $('#icon-left2').val(e.icon);

                });
                $('#btn-icon-right2').on('change', function(e) {

                    $('#icon-right2').val(e.icon);
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

                success: function (res2) {


                //   swal({
                //     type:"Success",
                //     title: "Success",
                //     text: res.text,
                //     icon: "success", //built in icons: success, warning, error, info
                //     timer: 3000, //timeOut for auto-close
                //     })
                iziToast.success({ //tampilkan iziToast dengan notif data berhasil disimpan pada posisi kanan bawah
                    title: 'Success',
                    message: res2.msg,
                    position: 'bottomRight'
                });
                $('#edit-modal').modal('hide');

                //   $('#tblMenu').DataTable().ajax.reload(null,false);
                window.location.reload();
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
    let icon_picker=
    ({
        align: 'left', // Only in div tag
        arrowClass: 'btn-danger',
        arrowPrevIconClass: 'fas fa-angle-left',
        arrowNextIconClass: 'fas fa-angle-right',
        cols: 10,
        footer: true,
        header: true,

        iconset: 'fontawesome5',
        labelHeader: '{0} of {1} pages',
        labelFooter: '{0} - {1} of {2} icons',
        placement: 'bottom', // Only in button tag
        rows: 5,
        search: true,
        // searchText: menu.data.icon_left,

        selectedClass: 'btn-success',
        unselectedClass: ''
    });
    // view index
    $("#tbl-submenu").DataTable({
        processing:true,
        serverSide:true,
        responsive:true,
        autoWidth: true,
        ajax :{
          url:"show-all-submenu",
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
          {data:"title", name:"sub-menu-name"},
          {data:"parent", name:"parent"},
          {data:"slug", name:"slug"},
          {data:"icon", name:"icon"},
          {data:"action", name:"action",orderable: false,autoWidth:true}

        ]
    })

       //Add modal window
    $('#btn-submenu-add').click(function(){
        // alert('ok')
        var modal=$('#submenu-modal')
        modal.modal('show');
        $('#submenu-modal').on('shown.bs.modal', function (e) { $(document).off('focusin.modal'); });
        $('#MenuForm').find('input[type="text"]').val('');
        $('#id').val('');
        $('#sb_icon').val('');
        $('#btn-icon-sbmenu').iconpicker(icon_picker)

        $('#btn-save-submenu').html('Save')
        $('#btn-icon-sbmenu').on('change', function(e) {
            $('#sb_icon_add').val(e.icon);
        });

    });

    // POST DATA TO SUbMENU CONTROLLER(store)

    $('#submenu-form').on('submit',function(e) {
        e.preventDefault();

            $.ajax({
                type: "post",
                url: "smstore",
                data: $('#submenu-form').serialize(),
                // cache: false,
                // contentType:false,
                // processData:false,
                dataType:"JSON",

                success: function (res) {
                    // console.log(res.data)
                    iziToast.success({ //tampilkan iziToast dengan notif data berhasil disimpan pada posisi kanan bawah
                        title: 'Success',
                        message: res.text,
                        position: 'bottomRight'
                    });
                    $('#submenu-modal').modal('hide');
                    $('#submenu-form').find('input[type="text"]').val('');
                    // $('#tbl-submenu').DataTable().ajax.reload(null,false);
                    window.location.reload();
                },
                error: function (data) { //jika error tampilkan error pada console
                    console.log('Error:', data);

                }
            });

    });

    //Edit modal window
    $('#sub-menu-modal-edit').on('shown.bs.modal', function (e) { $(document).off('focusin.modal'); });

    $('body').on('click', '.edit-sbmenu', function () {
        var id = $(this).attr('sbmenu-id');
        $.get("smedit/"+id, function (sbmenu) {
         $('#sub-menu-modal-edit').modal('show');
         $('#id_edit').val(sbmenu.data.id);
         $('#sub-menu-edit-name').val(sbmenu.data.title);
         $('#parent_edit').val(sbmenu.data.menu_id);
         $('#slug-edit').val(sbmenu.data.slug);
         $('#sb_icon_edit').val(sbmenu.data.icon);
         $('#btn-icon-sbmenu-edit').iconpicker(icon_picker)
         $('#btn-icon-sbmenu-edit').iconpicker('setIcon',sbmenu.data.icon)

         $('#btn-icon-sbmenu-edit').on('change', function(e) {
             $('#sb_icon_edit').val(e.icon);

         });


        })

    });

    // save Edit Data
    $('#sub-menu-edit-form').on('submit',function(e) {
        e.preventDefault();
        let id=$('#sub-menu-edit-form').find('#id_edit').val()
        let formData=$('#sub-menu-edit-form').serialize()
        console.log(formData)
        // alert(id)
        $.ajax({
            type: "PATCH",
            url: "smupdate/" + id,
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
            $('#sub-menu-modal-edit').modal('hide');

            //   $('#tblMenu').DataTable().ajax.reload(null,false);
            window.location.href="/menu/show-all-menu";
            },
            error: function (data) { //jika error tampilkan error pada console
                console.log('Error:', data);

             }
        });
    });
      //Delete Record
      $('body').on('click', '.delete-sbmenu', function () {
        var sbmenu_id=$(this).attr('sbmenu-id');
        var sbmenu_name=$(this).attr('sbmenu-name');
        Swal.fire({
            title: 'Are you sure?',
            text: "Delete Sub Menu " + sbmenu_name + "?",
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
                    url: "smdestroy/"+sbmenu_id,
                    data: {id:sbmenu_id},
                    success: function (res) {
                        // $('#tblMenu').DataTable().ajax.reload(null,false);
                        window.location.reload();
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


});
//====================End Sub Menu===================================//
//====================Akfit/nonakti MENU and SUBMENU SIDEBAR===================================//
$(document).ready(function(){
    // VERISI I TIDAK BISA MENGHENDEL TREEVIEW JADI LOOPNYA HARUS DI DALAM TREEVIEW
            //    /** add active class and stay opened when selected */
            //    var url = window.location;

            //    // for sidebar menu entirely but not cover treeview
            //    $('ul.nav-sidebar a').filter(function() {
            //        return this.href == url;
            //    }).addClass('active');

            //    // for treeview
            //    $('ul.nav-treeview a').filter(function() {
            //        return this.href == url;
            //    }).parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open').prev('a').addClass('active');

    // VERSI 2 SUDAH BISA HANDEL TREEVIEW JADI LOOPNYA DILUAR TREEVIEEW
            const url = window.location;

            $('ul.nav-sidebar a').filter(function() {
                return this.href == url;
            }).parent().addClass('active');

            $('ul.nav-treeview a').filter(function() {
                return this.href == url;
            }).parentsUntil(".sidebar-menu > .nav-treeview").addClass('menu-open');

            $('ul.nav-treeview a').filter(function() {
                return this.href == url;
            }).addClass('active');

            $('li.has-treeview a').filter(function() {
                return this.href == url;
            }).addClass('active');

            $('ul.nav-treeview a').filter(function() {
                return this.href == url;
            }).parentsUntil(".sidebar-menu > .nav-treeview").children(0).addClass('active')
});
//====================END Akfit/nonakti MENU AND SUBMENU SIDEBAR===================================//


// auto logout Jika Mouse dan key boar tidak bekerja

function idleLogout() {

    var t;
    window.onload = resetTimer;
    window.onmousemove = resetTimer;
    window.onmousedown = resetTimer;  // catches touchscreen presses as well
    window.ontouchstart = resetTimer; // catches touchscreen swipes as well
    window.onclick = resetTimer;      // catches touchpad clicks as well
    window.onkeydown = resetTimer;
    window.addEventListener('scroll', resetTimer, true); // improved; see comments

    function yourFunction() {

        //  $('#pesan').innerHTML='ok'
        //  document.getElementById("#pesan").innerHTML = "my text"

        window.location.href = 'dashboar/logout';
        window.location.href = '/';
        localStorage.setItem("logoutMessage", true);



    }

    function resetTimer() {
        clearTimeout(t);
        t = setTimeout(yourFunction, 900000);  // time is in milliseconds
    }
}
idleLogout();

// Delete Parmission

$('body').on('click', '.delete-parmission', function () {
    var parmission_id=$(this).attr('parmission-id');

    Swal.fire({
        title: 'Are you sure?',
        text: "Delete Parmission id " + parmission_id + "?",
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
                url: "destroy/"+parmission_id,
                data: {id:parmission_id},
                success: function (res) {
                    // $('#tblMenu').DataTable().ajax.reload(null,false);
                    window.location.reload();
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

//End Delete Parmission

// Delete Role

$('body').on('click', '.delete-role', function () {
    var role_id=$(this).attr('role-id');
    var role_name=$(this).attr('role-name');

    Swal.fire({
        title: 'Are you sure?',
        text: "Delete Role Name " + role_name + "?",
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
                url: "destroy/"+role_id,
                data: {id:role_id},
                success: function (res) {
                    // $('#tblMenu').DataTable().ajax.reload(null,false);
                    window.location.reload();
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

//End Delete Parmission



