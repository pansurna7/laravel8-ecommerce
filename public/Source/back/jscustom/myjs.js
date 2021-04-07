
$(document).ready(function(){
    // delete form role-list wih sweet alert
    $(document).ready(function(){

        $('.delete-role').click(function(){
            var role_id=$(this).attr('role-id');
            var role_name=$(this).attr('role-name');

            swal({
                title: "Are you sure?",
                text: "Delete Role Name " + role_name + "?",
                icon: "warning",
                buttons: true,
                dangerMode: true,

              })
              .then((willDelete) => {
                if (willDelete) {
                  window.location='/role/destroy/'+role_id
                } else {
                  swal("Your imaginary file is safe!");
                }
              });
        });


    });
        // delete form parmission wih sweet alert
        $(document).ready(function(){

            $('.delete-parmission').click(function(){
                var parmission_id=$(this).attr('parmission-id');
                var parmission_name=$(this).attr('parmission-name');

                swal({
                    title: "Are you sure?",
                    text: "Delete Parmission Name " + parmission_name + "?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,

                  })
                  .then((willDelete) => {
                    if (willDelete) {
                      window.location='/parmission/destroy/'+parmission_id
                    } else {
                      swal("Your imaginary file is safe!");
                    }
                  });
            });


        });
        // delete form user wih sweet alert
        $(document).ready(function(){

            $('.delete-user').click(function(){
                var user_id=$(this).attr('user-id');
                var user_name=$(this).attr('user-name');

                swal({
                    title: "Are you sure?",
                    text: "Delete user Name " + user_name + "?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,

                  })
                  .then((willDelete) => {
                    if (willDelete) {
                      window.location='/user/destroy/'+user_id
                    } else {
                      swal("Your imaginary file is safe!");
                    }
                  });
            });


        });

        // modal Menu
        $(document).ready(function(){

            $('.MenuAdd').click(function(){
                var modal=$('#MenuAdd')
                modal.modal('show');
                $('#MenuForm').find('input[type="text"]').val('');
            });

            $('.MenuEdit').click(function(){
                // alert('ok')
                var menu_id=$(this).attr('menu-id');
                var modal=$('#MenuEdit');
                modal.modal('show');

            });
        });









});

