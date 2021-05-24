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

            error: function (data) { //jika error tampilkan error pada console
                console.log('Error:', data);
                $('#submit-form').html('Save');
            }
        });
    });

    //Edit modal window
    $('body').on('click', '.edit-category', function () {
        var id = $(this).attr('category-id');
        var modal=$('#modal-edit-category');
        var SITEURL = "{{URL::to('')}}";

        modal.modal('show');
        $('#modal-edit-category').on('shown.bs.modal', function (e) { $(document).off('focusin.modal'); });
        $.get("edit/"+id, function (cat) {
            $('#id').val(cat.data.id);
            $('#name-edit').val(cat.data.name);
            $('#status-edit').prop('checked',cat.data.status);
            $('#image-source').empty();
            $('#image-source').append(cat.data.banner);
            $('#priviewImg-edit').attr('src','/Source/back/dist/img/category/'+cat.data.banner);
        })

    });

    // SAVE EDIT DATA
    $('#category-edit-form').submit(function(e) {
        e.preventDefault();
        let id=$('#category-edit-form').find('#id').val()
        var formData = new FormData(this);

        $.ajax({
           type:'PATCH',
           url: "update/" +id,
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

            error: function (data) { //jika error tampilkan error pada console
                console.log('Error:', data);

            }
        });
    });

})
 //+++++++++++END CATEGORY++++++++++++++++++++++++++++++++++++++//
