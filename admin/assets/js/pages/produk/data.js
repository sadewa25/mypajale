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
  $.getJSON(`${host}kategori-produk/select.php`, function( data ) {
    // console.log(data)
    let html = ""
    $.each(data.result, (i, val) =>{
      html += `<option value="${val.id_kategori_produk}">${val.nama_kategori_produk}</option>`
    })
    $('#kategori-add').append(html)
    $('#kategori-edit').append(html)

  })

  //get data from organ api
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
      'url' :`${host}produk/select.php`,
      'dataSrc' : 'result'
    },
    'columns' : [
      {data : 'nama_produk'},
      {data : 'nama_usaha'},
      {data : 'nama_kategori_produk'},
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
    let nama = $('#nama-add').val()
    let deskripsi = quillAdd.root.innerHTML
    let usaha = $('#usaha-add').val()
    let tanaman = $('#tanaman-add').val()
    let kategori = $('#kategori-add').val()
    let gambar =  ''
    let idUser = $('#id-user').val()
    let file = new FormData() //form data for file input
    //check if input is empty or not
    if(nama != '' && usaha != '' && kategori != '' && tanaman != '') {
      //check if file is empty or not
      if ($('#img-add')[0].files.length != 0){
        gambar = $('#img-add')[0].files[0].name
        file.append('file', $('#img-add')[0].files[0])
        //upload file to api
        $.ajax({
          url: `${host}produk/upload.php`,
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
      $.post(`${host}produk/insert.php`,
      { nama_produk: nama,
        gambar_produk: gambar,
        deskripsi_produk: deskripsi,
        nama_usaha: usaha,
        id_tanaman: tanaman,
        id_kategori_produk: kategori,
        id_users: idUser },
      function(success){
        //show notif
        $.notify("Data berhasil disimpan", { position: "right bottom", className: "success" });
        //clean input field
        $('#nama-add').val("")
        quillAdd.setText("")
        $('#usaha-add').val("")
        $('#kategori-add').val("")
        $('#tanaman-add').val("")
        $('#img-add').val("")
        //reload datatables
        table.ajax.reload()
      })

    }else{
      //set and show notification is input is empty
      $.notify("Tolong lengkapi data.", { position: "right bottom", className: "error" });
      if (nama == '') {
        $("#nama-add").notify("Tidak boleh kosong.", { position: "left middle", className: "error" });
      }
      if (usaha == '') {
        $("#usaha-add").notify("Tidak boleh kosong.", { position: "left middle", className: "error" });
      }
      if (kategori == '') {
        $("#kategori-add").notify("Pilih salah satu.", { position: "left middle", className: "error" });
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
    $('#id-produk-edit').val($(this).val())
    $('#nama-edit').val($(this).attr('nama'))
    quillEdit.setText($(this).attr('desc'))
    $('#usaha-edit').val($(this).attr('usaha'))
    $(`#tanaman-edit option:contains(${$(this).attr('tanaman')})`).attr('selected', 'selected')
    $(`#kategori-edit option:contains(${$(this).attr('kategori')})`).attr('selected', 'selected')
    $('#img-edit').attr('title', $(this).attr('img'))
    $('#img-show').attr('src', `http://mypajale.sahabatj.com/apimypajale/api/produk/img/${$(this).attr('img')}`)

  })

  //event click for update button
  $('#update-btn').on('click', function(){
    //get the data from input field
    let id = $('#id-produk-edit').val()
    let nama = $('#nama-edit').val()
    let deskripsi = quillEdit.root.innerHTML
    let usaha = $('#usaha-edit').val()
    let tanaman = $('#tanaman-edit').val()
    let kategori = $('#kategori-edit').val()
    let gambar =  ''
    let idUser = $('#id-user').val()
    let file = new FormData() //form data for file input
    //check if input is empty or not
    if(nama != '' && usaha != '' && kategori != '' && tanaman != '') {
      //check if image is change or not
      if ($('#img-edit')[0].files.length != 0){
        //if yes update name of image and file
        gambar = $('#img-edit')[0].files[0].name
        file.append('file', $('#img-edit')[0].files[0])
        //upload file to server
        $.ajax({
          url: `${host}produk/upload.php`,
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
      $.post(`${host}produk/update.php`,
      { nama_produk: nama,
        gambar_produk: gambar,
        deskripsi_produk: deskripsi,
        nama_usaha: usaha,
        id_users: idUser,
        id_tanaman: tanaman,
        id_kategori_produk: kategori,
        id_produk : id},
      function(success){
        //show notif
        $.notify("Data berhasil diubah", { position: "right bottom", className: "success" });
        table.ajax.reload()
      })
    } else{
      //set and show notification is input is empty
      $.notify("Tolong lengkapi data.", { position: "right bottom", className: "error" });
      if (nama == '') {
        $("#nama-edit").notify("Tidak boleh kosong.", { position: "left middle", className: "error" });
      }
      if (usaha == '') {
        $("#usaha-edit").notify("Tidak boleh kosong.", { position: "left middle", className: "error" });
      }
      if (kategori == '') {
        $("#kategori-edit").notify("Pilih salah satu.", { position: "left middle", className: "error" });
      }
      if (tanaman == '') {
        $("#tanaman-edit").notify("Pilih salah satu.", { position: "right middle", className: "error" });
      }
    }
  })

  $('#mydata').on('click', '#detail-btn', function(){
    $('#detail-modal').modal('show')

    let id = $(this).val()
    $.get(`${host}produk/selectone.php`,
    {id_produk: id},
    function(json){
      let data = json.result[0]
      $('#detail-nama').text(data.nama_produk)
      $('#detail-user').text(`Oleh : ${data.nama_lengkap}`)
      $('#detail-usaha').text(`Usaha : ${data.nama_usaha}`)
      $('#detail-kategori').text(`Kategori : ${data.nama_kategori_produk}`)
      $('#detail-img').attr('src', `http://mypajale.sahabatj.com/apimypajale/api/produk/img/${data.gambar_produk}`)
      $('#detail-desc').text(data.deskripsi_produk)
    })
  })

  $('#mydata').on('click', '#delete-btn', function(){
    $('#delete-modal').modal('show')

    $('#id-produk-delete').val($(this).val())
  })

  $('#delete-btn').on('click', function(){
    let idproduk = $('#id-produk-delete').val()

    $.post(`${host}produk/delete.php`,
    {id_produk : idproduk},
    function(success){
      $.notify("Data berhasil dihapus.", { position: "right bottom", className: "success" });
      $('#delete-modal').modal('hide')
      table.ajax.reload()
    })
  })

  function renderActionButton(data){
    return `<button href="#" class="btn btn-primary btn-sm mx-1" id="detail-btn" value="${data.id_produk}"><span class="fas fa-eye h6 mr-1"></span>Detail</button>
            <button class="btn btn-warning btn-sm mx-1" id="edit-btn"
                    value="${data.id_produk}"
                    nama="${data.nama_produk}"
                    desc="${data.deskripsi_produk}"
                    usaha="${data.nama_usaha}"
                    img="${data.gambar_produk}"
                    tanaman="${data.tanaman}"
                    kategori="${data.nama_kategori_produk}"><span class="fas fa-edit h6 mr-1"></span>Edit</button>
            <button href="#" class="btn btn-danger btn-sm mx-1" id="delete-btn" value="${data.id_produk}"><span class="fas fa-trash-alt h6 mr-1"></span>Hapus</button>`
  }

});
