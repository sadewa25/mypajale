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

  //display data to datatable
  const table = $('#mydata').DataTable({
    'ajax' : {
      'url' :`${host}berita/select.php`,
      'dataSrc' : 'result'
    },
    'columns' : [
      {data : 'judul_berita'},
      {data : 'tgl_berita'},
      {data : 'nama_lengkap'},
      {data : 'tanaman'},
      {data : null, render: renderActionButton}
    ],
    responsive: true
  })
  //get data from tanaman api select option input
  $.getJSON(`${host}tanaman/select.php`, function( data ) {
    let html = ""
    $.each(data.result, (i, val) =>{
      html += `<option value="${val.id_tanaman}">${val.nama}</option>`
    })
    $('#tanaman-add').append(html)
    $('#tanaman-edit').append(html)
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
    let tanggal = $('#tgl-add').val()
    let tanaman = $('#tanaman-add').val()
    let gambar =  ''
    let idUser = $('#id-user').val()
    let file = new FormData() //form data for file input

    //check if input is empty or not
    if(judul != '' && tanggal != '') {
      //check if file is empty or not
      if ($('#img-add')[0].files.length != 0){
        file.append('file', $('#img-add')[0].files[0])
        gambar = $('#img-add')[0].files[0].name
        //upload file to api
        $.ajax({
          url: `${host}berita/upload.php`,
          type: 'post',
          data: file,
          contentType: false,
          processData: false,
          success: function(response){
            return true
          }
        })
      }else{
        gambar = 'noimg.jpg'
      }

      //post data to api
      $.post(`${host}berita/insert.php`,
      { judul_berita: judul,
        deskripsi_berita: deskripsi,
        tgl_berita: tanggal,
        gambar_berita: gambar,
        id_users: idUser,
        id_tanaman: tanaman },
      function(success){
        //show notif
        $.notify("Data berhasil disimpan", { position: "right bottom", className: "success" });
        //clean input field
        $('#judul-add').val("")
        quillAdd.setText("")
        $('#tgl-add').val("")
        $('#img-add').val("")
        $('#tanaman-add').val("")
        //reload datatables
        table.ajax.reload()
      })
    }else{
      //set and show notification is input is empty
      $.notify("Tolong lengkapi data.", { position: "right bottom", className: "error" });
      if (judul == '') {
        $("#judul-add").notify("Tidak boleh kosong.", { position: "left middle", className: "error" });
      }
      if (tanggal == '') {
        $("#tgl-add").notify("Tidak boleh kosong.", { position: "left middle", className: "error" });
      }
      if (tanaman == '') {
        $("#tanaman-add").notify("Pilih salah satu.", { position: "right middle", className: "error" });
      }
    }

  })

  //event click for edit button
  $('#mydata').on('click', '#edit-btn', function(){
    $('#edit-modal').modal('show') //show modal edit form

    //retrive back data to input field form edit
    $('#id-berita-edit').val($(this).val())
    $('#judul-edit').val($(this).attr('judul'))
    quillEdit.setText($(this).attr('desc'))
    $('#tgl-edit').val($(this).attr('tgl'))
    $(`#tanaman-edit option:contains(${$(this).attr('tanaman')})`).attr('selected', 'selected')
    $('#img-edit').attr('title', $(this).attr('img'))
    $('#img-show').attr('src', `http://mypajale.sahabatj.com/apimypajale/api/berita/img/${$(this).attr('img')}`)

  })

  //event click for update button
  $('#update-btn').on('click', function(){
    //get the data from input field
    let id = $('#id-berita-edit').val()
    let judul = $('#judul-edit').val()
    let deskripsi = quillEdit.root.innerHTML
    let tanggal = $('#tgl-edit').val()
    let tanaman = $('#tanaman-edit').val()
    let gambar = ''
    let file = new FormData() //form data for file input
    let idUser = $('#id-user').val()

    //check if input is empty or not
    if(judul != '' && tanggal != '') {
      //check if image is change or not
      if ($('#img-edit')[0].files.length != 0){
        //if yes update name of image and file
        gambar = $('#img-edit')[0].files[0].name
        file.append('file', $('#img-edit')[0].files[0])
        //upload file to server
        $.ajax({
          url: `${host}berita/upload.php`,
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
      $.post(`${host}berita/update.php`,
      { id_berita : id,
        judul_berita: judul,
        deskripsi_berita: deskripsi,
        tgl_berita: tanggal,
        id_tanaman: tanaman,
        gambar_berita: gambar,
        id_users: idUser},
      function(success){
        $.notify("Data berhasil diubah", { position: "right bottom", className: "success" });
        table.ajax.reload()
      })
    }else{
      //set and show notification is input is empty
      $('#modal-edit-title').notify("Tolong lengkapi data.", { position: "right middle", className: "error" });
      if (judul == '') {
        $("#judul-edit").notify("Tidak boleh kosong.", { position: "left middle", className: "error" });
      }
      if (tanggal == '') {
        $("#tgl-edit").notify("Tidak boleh kosong.", { position: "left middle", className: "error" });
      }
      if (tanaman == '') {
        $("#tanaman-edit").notify("Pilih salah satu.", { position: "right middle", className: "error" });
      }
    }
  })

  $('#mydata').on('click', '#detail-btn', function(){
    $('#detail-modal').modal('show')

    let id = $(this).val()
    $.get(`${host}berita/selectone.php`,
    {id_berita: id},
    function(json){
      let data = json.result[0]
      $('#detail-judul').text(data.judul_berita)
      $('#detail-user').text(`Oleh : ${data.nama_lengkap}`)
      $('#detail-tgl').text(`Tanggal : ${data.tgl_berita}`)
      $('#detail-img').attr('src', `http://mypajale.sahabatj.com/apimypajale/api/berita/img/${data.gambar_berita}`)
      $('#detail-desc').text(data.deskripsi_berita)
      $('#detail-tanaman').text(`Tanaman : ${data.tanaman}`)

    })
  })

  $('#mydata').on('click', '#delete-btn', function(){
    $('#delete-modal').modal('show')

    $('#id-berita-delete').val($(this).val())
  })

  $('#delete-btn').on('click', function(){
    let idberita = $('#id-berita-delete').val()

    $.post(`${host}berita/delete.php`,
    {id_berita : idberita},
    function(success){
      $.notify("Data berhasil dihapus.", { position: "right bottom", className: "success" });
      $('#delete-modal').modal('hide')
      table.ajax.reload()
    })
  })

  function renderActionButton(data){
    return `<button href="#" class="btn btn-primary btn-sm mx-1" id="detail-btn" value="${data.id_berita}"><span class="fas fa-eye h6 mr-1"></span>Detail</button>
            <button class="btn btn-warning btn-sm mx-1" id="edit-btn"
                    value="${data.id_berita}"
                    judul="${data.judul_berita}"
                    desc="${data.deskripsi_berita}"
                    tgl="${data.tgl_berita}"
                    tanaman="${data.tanaman}"
                    img="${data.gambar_berita}"><span class="fas fa-edit h6 mr-1"></span>Edit</button>
            <button href="#" class="btn btn-danger btn-sm mx-1" id="delete-btn" value="${data.id_berita}"><span class="fas fa-trash-alt h6 mr-1"></span>Hapus</button>`
  }

});
