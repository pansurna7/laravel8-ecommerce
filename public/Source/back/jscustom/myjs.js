

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
        // delete form menu wih sweet alert
        $(document).ready(function(){

          $('#btnDelete').click(function(){
             alert('ok')
          });


      });
        // ===========FOR Menu========== //
        // +++++++++++Show Modal Menu++++//
        $(document).ready(function(){

              $('#btnMenuAdd').click(function(){
                // alert('ok')
                  var modal=$('#MenuAdd')
                  modal.modal('show');
                  $('#MenuForm').find('input[type="text"]').val('');
              });
            });
          // +++++++++++End Show Modal Menu++++//
          // +++++++++++Fetch Data Table server side++++//
          $(document).ready(function(){
            fetch()
          });
          function fetch(){
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
                {data:"menu", name:"name"},
                {data:"icon_right", name:"right_icon"},
                {data:"icon_left", name:"left_icon"},
                {data:"action", name:"action"}
              ]
            })
          }
             
          // +++++++++++end Fetch Data Table++++//

        //+++++++++++  Add Data Menu+++++++++//
        $(document).ready(function(){
          $('#MenuForm').on('submit',function(e) {
            e.preventDefault();
          
            $.ajax({
                type: "post",
                url: "store",
                data: $('#MenuForm').serialize(),
                
                success: function (res) {
                  console.log(res.data)
                  $('#MenuAdd').modal('hide');
                  swal({
                    title: "Success",
                    text: res.text,
                    icon: "success", //built in icons: success, warning, error, info
                    timer: 3000, //timeOut for auto-close
                    })
                  $('#tblMenu').DataTable().ajax.reload(null,false);
                },
                error:function(xhr) {
                  alert(xhr.responJason.text)
                 
                }
            });
          });
        });
        //+++++++++++ END Add Data Menu+++++++++//
      // ===========End FOR Menu========== //



