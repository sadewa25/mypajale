$(document).ready(function() {
  //show data from api
  const host = 'http://mypajale.sahabatj.com/apimypajale/api/'

  //display data to datatable
  const table = $('#mydata').DataTable({
    'ajax' : {
      'url' :`${host}kategori-produk/select.php`,
      'dataSrc' : 'result'
    },
    'columns' : [
      {data : 'nama_kategori_produk'},
      {data : null, render: renderActionButton}
    ],
    responsive: true
  })

  //event clik for add button
  $('#add-btn').on('click', function(){
    $('#add-modal').modal('show') //show modal add form
  })

  //event click for save button
  $('#save-btn').on('click', function(){
    //get text data from input form
    let nama = $('#nama-add').val()

    //check if input is empty or not
    if(nama != '') {
      //post data to api
      $.post(`${host}kategori-produk/insert.php`,
      { nama_kategori_produk: nama},
      function(success){
        //show notif
        $.notify("Data berhasil disimpan", { position: "right bottom", className: "success" });
        //clean input field
        $('#nama-add').val("")
        //reload datatables
        table.ajax.reload()
      })

    }else{
      //set and show notification is input is empty
      $.notify("Tolong lengkapi data.", { position: "right bottom", className: "error" })
      $("#nama-add").notify("Tidak boleh kosong.", { position: "left middle", className: "error" })
    }

  })

  //event click for edit button
  $('#mydata').on('click', '#edit-btn', function(){
    $('#edit-modal').modal('show') //show modal edit form
    //retrive back data to input field form edit
    $('#id-kategori-edit').val($(this).val())
    $('#nama-edit').val($(this).attr('nama'))
  })

  //event click for update button
  $('#update-btn').on('click', function(){
    //get the data from input field
    let id = $('#id-kategori-edit').val()
    let nama = $('#nama-edit').val()

    //check if input is empty or not
    if(nama != '') {
      //send data to the api
      $.post(`${host}kategori-produk/update.php`,
      { nama_kategori_produk: nama,
        id_kategori_produk : id},
      function(success){
        //show notif
        $.notify("Data berhasil diubah", { position: "right bottom", className: "success" });
        table.ajax.reload()
      })
    } else{
      //set and show notification is input is empty
      $.notify("Tolong lengkapi data.", { position: "right bottom", className: "error" });
      $("#nama-edit").notify("Tidak boleh kosong.", { position: "left middle", className: "error" });
    }
  })

  $('#mydata').on('click', '#delete-btn', function(){
    $('#delete-modal').modal('show')

    $('#id-kategori-delete').val($(this).val())
  })

  $('#delete-btn').on('click', function(){
    let id = $('#id-kategori-delete').val()

    $.post(`${host}kategori-produk/delete.php`,
    {id_kategori_produk : id},
    function(success){
      $.notify("Data berhasil dihapus.", { position: "right bottom", className: "success" });
      $('#delete-modal').modal('hide')
      table.ajax.reload()
    })
  })

  function renderActionButton(data){
    return `<button class="btn btn-warning btn-sm mx-1" id="edit-btn"
                    value="${data.id_kategori_produk}"
                    nama="${data.nama_kategori_produk}"><span class="fas fa-edit h6 mr-1"></span>Edit</button>
            <button href="#" class="btn btn-danger btn-sm mx-1" id="delete-btn" value="${data.id_kategori_produk}"><span class="fas fa-trash-alt h6 mr-1"></span>Hapus</button>`
  }

});
