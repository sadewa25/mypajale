$(document).ready(function() {
  //show data from api
  const host = 'http://mypajale.sahabatj.com/apimypajale/api/'

  //setting quill text editor
  const quillAdd = new Quill('#ket-add', {
    theme: 'snow'
  });

  const quillEdit = new Quill('#ket-edit', {
    theme: 'snow'
  });

  //display data to datatable
  const table = $('#mydata').DataTable({
    'ajax' : {
      'url' :`${host}kategori-tips/select.php`,
      'dataSrc' : 'result'
    },
    'columns' : [
      {data : 'nama_kategori_tips'},
      {data : 'keterangan_kategori_tips'},
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
    let ket = quillAdd.root.innerHTML

    //check if input is empty or not
    if(nama != '') {
      //post data to api
      $.post(`${host}kategori-tips/insert.php`,
      { nama_kategori_tips: nama,
        keterangan_kategori_tips: ket},
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
    quillEdit.setText($(this).attr('ket'))
  })

  //event click for update button
  $('#update-btn').on('click', function(){
    //get the data from input field
    let id = $('#id-kategori-edit').val()
    let nama = $('#nama-edit').val()
    let ket = quillEdit.root.innerHTML

    //check if input is empty or not
    if(nama != '') {
      //send data to the api
      $.post(`${host}kategori-tips/update.php`,
      { nama_kategori_tips: nama,
        keterangan_kategori_tips: ket,
        id_kategori_tips : id},
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

    $.post(`${host}kategori-tips/delete.php`,
    {id_kategori_tips : id},
    function(success){
      $.notify("Data berhasil dihapus.", { position: "right bottom", className: "success" });
      $('#delete-modal').modal('hide')
      table.ajax.reload()
    })
  })

  function renderActionButton(data){
    return `<button class="btn btn-warning btn-sm mx-1" id="edit-btn"
                    value="${data.id_kategori_tips}"
                    nama="${data.nama_kategori_tips}"
                    ket="${data.keterangan_kategori_tips}"><span class="fas fa-edit h6 mr-1"></span>Edit</button>
            <button href="#" class="btn btn-danger btn-sm mx-1" id="delete-btn" value="${data.id_kategori_tips}"><span class="fas fa-trash-alt h6 mr-1"></span>Hapus</button>`
  }

});
