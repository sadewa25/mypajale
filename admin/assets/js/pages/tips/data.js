$(document).ready(function() {
  //show data from api
  const host = 'http://mypajale.sahabatj.com/apimypajale/api/'

  //setting quill text editor
  const quillAdd = new Quill('#desc-add', {
    theme: 'snow'
  });

  const quillEdit = new Quill('#desc-edit', {
    theme: 'snow'
  });

  //get data from organ api
  $.getJSON(`${host}kategori-tips/select.php`, function( data ) {
    // console.log(data)
    let html = ""
    $.each(data.result, (i, val) =>{
      html += `<option value="${val.id_kategori_tips}">${val.nama_kategori_tips}</option>`
    })
    $('#kategori-add').append(html)
    $('#kategori-edit').append(html)

  })

  //get data from tanaman api
  $.getJSON(`${host}tanaman/select.php`, function( data ) {
    // console.log(data)
    let html = ""
    $.each(data.result, (i, val) =>{
      html += `<option value="${val.id_tanaman}">${val.nama}</option>`
    })
    $('#tanaman-add').append(html)
    $('#tanaman-edit').append(html)

  })

  //display data to datatable
  const table = $('#mydata').DataTable({
    'ajax' : {
      'url' :`${host}tips/select.php`,
      'dataSrc' : 'result'
    },
    'columns' : [
      {data : 'judul_tips'},
      {data : 'nama_kategori_tips'},
      {data : 'nama_lengkap'},
      {data : 'tanaman'},
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
    let judul = $('#judul-add').val()
    let deskripsi = quillAdd.root.innerHTML
    let tanaman = $('#tanaman-add').val()
    let kategori = $('#kategori-add').val()
    let gambar =  ''
    let idUser = $('#id-user').val()
    let file = new FormData() //form data for file input
    //check if input is empty or not
    if(judul != '' && kategori != '') {
      //check if file is empty or not
      if ($('#img-add')[0].files.length != 0){
        gambar = $('#img-add')[0].files[0].name
        file.append('file', $('#img-add')[0].files[0])
        //upload file to api
        $.ajax({
          url: `${host}tips/upload.php`,
          type: 'post',
          data: file,
          contentType: false,
          processData: false,
          success: function(response){
            return true
          },
        });
      }else{
        gambar = 'noimg.jpg'
      }

      //post data to api
      $.post(`${host}tips/insert.php`,
      { judul_tips: judul,
        gambar_tips: gambar,
        deskripsi_tips: deskripsi,
        id_kategori_tips: kategori,
        id_tanaman: tanaman,
        id_users: idUser },
      function(success){
        //show notif
        $.notify("Data berhasil disimpan", { position: "right bottom", className: "success" });
        //clean input field
        $('#judul-add').val("")
        quillAdd.setText("")
        $('#usaha-add').val("")
        $('#tanaman-add').val("")
        $('#kategori-add').val("")
        $('#img-add').val("")
        //reload datatables
        table.ajax.reload()
      })

    }else{
      //set and show notification is input is empty
      $.notify("Tolong lengkapi data.", { position: "right bottom", className: "error" });
      if (judul == '') {
        $("#judul-add").notify("Tidak boleh kosong.", { position: "left middle", className: "error" });
      }
      if (kategori == '') {
        $("#kategori-add").notify("Pilih salah satu.", { position: "left middle", className: "error" });
      }
      if (tanaman == '') {
        $("#tanaman-add").notify("Pilih salah satu.", { position: "left middle", className: "error" });
      }
    }

  })

  //event click for edit button
  $('#mydata').on('click', '#edit-btn', function(){
    $('#edit-modal').modal('show') //show modal edit form

    //retrive back data to input field form edit
    $('#id-tips-edit').val($(this).val())
    $('#judul-edit').val($(this).attr('judul'))
    quillEdit.setText($(this).attr('desc'))
    $(`#tanaman-edit option:contains(${$(this).attr('tanaman')})`).attr('selected', 'selected')
    $(`#kategori-edit option:contains(${$(this).attr('kategori')})`).attr('selected', 'selected')
    $('#img-edit').attr('title', $(this).attr('img'))
    $('#img-show').attr('src', `http://mypajale.sahabatj.com/apimypajale/api/tips/img/${$(this).attr('img')}`)

  })

  //event click for update button
  $('#update-btn').on('click', function(){
    //get the data from input field
    let id = $('#id-tips-edit').val()
    let judul = $('#judul-edit').val()
    let deskripsi = quillEdit.root.innerHTML
    let tanaman = $('#tanaman-edit').val()
    let kategori = $('#kategori-edit').val()
    let gambar =  ''
    let idUser = $('#id-user').val()
    let file = new FormData() //form data for file input
    //check if input is empty or not
    if(judul != '' && kategori != '') {
      //check if image is change or not
      if ($('#img-edit')[0].files.length != 0){
        //if yes update name of image and file
        gambar = $('#img-edit')[0].files[0].name
        file.append('file', $('#img-edit')[0].files[0])
        //upload file to server
        $.ajax({
          url: `${host}tips/upload.php`,
          type: 'post',
          data: file,
          contentType: false,
          processData: false,
          success: function(response){
            return true
          },
        });
      }else{
        //if no get latest name of image
        gambar =  $('#img-edit').attr('title')
      }

      //send data to the api
      $.post(`${host}tips/update.php`,
      { judul_tips: judul,
        gambar_tips: gambar,
        deskripsi_tips: deskripsi,
        id_kategori_tips: kategori,
        id_tanaman: tanaman,
        id_users: idUser,
        id_tips : id},
      function(success){
        //show notif
        $.notify("Data berhasil diubah", { position: "right bottom", className: "success" });
        table.ajax.reload()
      })
    } else{
      //set and show notification is input is empty
      $.notify("Tolong lengkapi data.", { position: "right bottom", className: "error" });
      if (judul == '') {
        $("#judul-edit").notify("Tidak boleh kosong.", { position: "left middle", className: "error" });
      }
      if (kategori == '') {
        $("#kategori-edit").notify("Pilih salah satu.", { position: "left middle", className: "error" });
      }
      if (tanaman == '') {
        $("#tanaman-edit").notify("Pilih salah satu.", { position: "left middle", className: "error" });
      }
    }
  })

  $('#mydata').on('click', '#detail-btn', function(){
    $('#detail-modal').modal('show')

    let id = $(this).val()
    $.get(`${host}tips/selectone.php`,
    {id_tips: id},
    function(json){
      let data = json.result[0]
      $('#detail-judul').text(data.judul_tips)
      $('#detail-user').text(`Oleh : ${data.nama_lengkap}`)
      $('#detail-kategori').text(`Kategori : ${data.nama_kategori_tips}`)
      $('#detail-tanaman').text(`Tanaman : ${data.tanaman}`)
      $('#detail-img').attr('src', `http://mypajale.sahabatj.com/apimypajale/api/tips/img/${data.gambar_tips}`)
      $('#detail-desc').text(data.deskripsi_tips)
    })
  })

  $('#mydata').on('click', '#delete-btn', function(){
    $('#delete-modal').modal('show')

    $('#id-tips-delete').val($(this).val())
  })

  $('#delete-btn').on('click', function(){
    let id = $('#id-tips-delete').val()

    $.post(`${host}tips/delete.php`,
    {id_tips : id},
    function(success){
      $.notify("Data berhasil dihapus.", { position: "right bottom", className: "success" });
      $('#delete-modal').modal('hide')
      table.ajax.reload()
    })
  })

  function renderActionButton(data){
    return `<button href="#" class="btn btn-primary btn-sm mx-1" id="detail-btn" value="${data.id_tips}"><span class="fas fa-eye h6 mr-1"></span>Detail</button>
            <button class="btn btn-warning btn-sm mx-1" id="edit-btn"
                    value="${data.id_tips}"
                    judul="${data.judul_tips}"
                    desc="${data.deskripsi_tips}"
                    img="${data.gambar_tips}"
                    tanaman="${data.tanaman}"
                    kategori="${data.nama_kategori_tips}"><span class="fas fa-edit h6 mr-1"></span>Edit</button>
            <button href="#" class="btn btn-danger btn-sm mx-1" id="delete-btn" value="${data.id_tips}"><span class="fas fa-trash-alt h6 mr-1"></span>Hapus</button>`
  }

});
