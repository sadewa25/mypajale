$(document).ready(function() {
  //show data from api
  const host = 'http://mypajale.id/apimypajale/api/'

  const chooseKec = (selector, type) => {
    $(selector).on('change', function(){
      if ($(this).val() != '') {
        $(`#kec-${type}`).empty().append(`<option value="">Pilih Kecamatan</option>`).prop('disabled',false)
        //get data  from kecamatan api and display to select input
        $.post(`${host}kecamatan/selectbykabupaten.php`,
          {id_kab: $(this).val()},
          function(json) {
          let html = ""
          $.each(json.result, (i, val) =>{
            html += `<option value="${val.id_kec}">${val.nama}</option>`
          })
          $(`#kec-${type}`).append(html)
        })
      }else{
        $(`#kec-${type}`).prop('disabled',true)
      }
    })
  }

  const getInput = type => {
    data = {
      username_user: $(`#username-${type}`).val(),
      nama_lengkap : $(`#nama-${type}`).val(),
      email_user : $(`#email-${type}`).val(),
      password_user : $(`#pass-${type}`).val(),
      telephone_user : $(`#phone-${type}`).val(),
      profesi : $(`#profesi-${type}`).val(),
      kabupaten : $(`#kab-${type} option:selected`).text(),
      kecamatan : $(`#kec-${type} option:selected` ).text(),
      alamat : $(`#alamat-${type}`).val(),
      id_koordinator: $(`#koordinator-${type}`).val(),
      id_status_users : $(`#status-${type}`).val(),
    }
    if (type != 'add') {
      if (data.password_user == '') {
        data.password_user = $('#pass-before').val()
      }
    }
    if(type != 'edit'){
      $.post(`${host}users/selectusername.php`,
      {username_user: data.username_user},
      function(success){
        if(success.value == 0){
          $(`#username-${type}`).notify("Username sudah digunakan", { position: "left middle", className: "error" });
        }
      })
    }

    if(data.username_user != '' && data.nama_lengkap != '' && data.email_user != '' &&
      data.kabupaten != 'Pilih Kabupaten' && data.kecamatan != 'Pilih Kecamatan' && data.id_status_users != ''){
      return data
    }else{
      //set and show notification is input is empty
      $.notify("Tolong lengkapi data.", { position: "right bottom", className: "error" });
      if (data.nama_lengkap == '') {
        $(`#nama-${type}`).notify("Tidak boleh kosong.", { position: "left middle", className: "error" });
      }
      if (data.username_user == '') {
        $(`#username-${type}`).notify("Tidak boleh kosong", { position: "left middle", className: "error" });
      }
      if (data.kabupaten == 'Pilih Kabupaten') {
        $(`#kab-${type}`).notify("Pilih salah satu.", { position: "left middle", className: "error" });
      }
      if (data.kecamatan == 'Pilih Kecamatan') {
        $(`#kec-${type}`).notify("Pilih salah satu.", { position: "right middle", className: "error" });
      }
      if (data.email_user == '') {
        $(`#email-${type}`).notify("Tidak boleh kosong.", { position: "left middle", className: "error" });
      }
      if(type != 'edit'){
        if (data.password_user == '') {
          $(`#pass-${type}`).notify("Tidak boleh kosong.", { position: "left middle", className: "error" });
        }
      }
      if (data.id_status_users == '') {
        $(`#tanaman-${type}`).notify("Pilih salah satu.", { position: "right middle", className: "error" });
      }
      return false
    }

  }
  //display data to datatable
  const table = $('#mydata').DataTable({
    'ajax' : {
      'url' :`${host}users/select.php`,
      'dataSrc' : 'result'
    },
    'columns' : [
      {data : 'nama_lengkap'},
      {data : 'id_user'},
      {data : 'email_user'},
      {data : 'telephone_user'},
      {data : 'profesi'},
      {data : 'alamat'},
      {data : 'id_status_users'},
      {data : null, render: renderActionButton}
    ],
    responsive: true
  })

  //get data  from kabupaten api and display to select input
  $.getJSON(`${host}kabupaten/select.php`, function( data ) {
    let html = ""
    $.each(data.result, (i, val) =>{
      html += `<option value="${val.id_kab}">${val.nama}</option>`
    })
    $('#kab-add').append(html)
    $('#kab-edit').append(html)
  })

  $.getJSON(`${host}status-user/select.php`, function( data ) {
    let html = ""
    $.each(data.result, (i, val) =>{
      html += `<option value="${val.id_status_user}">${val.nama_status_user}</option>`
    })
    $('#status-add').append(html)
    $('#status-edit').append(html)
  })

  chooseKec('#kab-add', 'add')
  chooseKec('#kab-edit', 'edit')

  //event clik for add button
  $('#add-btn').on('click', function(e){
    e.preventDefault()
    $('#add-modal').modal('show') //show modal add form
  })

  //event click for save button
  $('#save-btn').on('click', function(e){
    e.preventDefault()
    let inputValue = getInput('add')
    if(inputValue){
      console.log(inputValue)
      $.post(`${host}users/insert.php`,
      inputValue,
      function(success){
        $.notify("Data berhasil disimpan", { position: "right bottom", className: "success" });
        $(`#nama-add`).val('')
        $(`#username-add`).val('')
        $(`#koordinator-add`).val('')
        $(`#email-add`).val('')
        $(`#pass-add`).val('')
        $(`#phone-add`).val('')
        $(`#profesi-add`).val('')
        $(`#kab-add`).val('')
        $(`#kec-add`).val('')
        $(`#alamat-add`).val('')
        $(`#status-add`).val('')
        table.ajax.reload()
      })
    }
  })

  //event click for edit button
  $('#mydata').on('click', '#edit-btn', function(e){
    e.preventDefault()

    $('#edit-modal').modal('show') //show modal edit form

    //retrive back data to input field form edit
    $('#id-user-edit').val($(this).val())
    $(`#nama-edit`).val($(this).attr('nama'))
    $(`#username-edit`).val($(this).attr('username'))
    $(`#koordinator-edit`).val($(this).attr('koordinator'))
    $(`#email-edit`).val($(this).attr('email'))
    $(`#phone-edit`).val($(this).attr('phone'))
    $(`#profesi-edit`).val($(this).attr('profesi'))
    $(`#kab-edit option:contains(${$(this).attr('kab')})`).attr('selected', 'selected')
    let kec = $(this).attr('kec')
    $(`#kec-edit`).prop('disabled',false)
    //get data  from kecamatan api and display to select input
    $.post(`${host}kecamatan/selectbykabupaten.php`,
      {id_kab: $(`#kab-edit`).val()},
      function(json) {
      let html = ""
      let data = ''
      $.each(json.result, (i, val) =>{
        if (val.nama === kec) {
          data = `<option value="${val.id_kec}" selected>${val.nama}</option>`
        }else{
          data = `<option value="${val.id_kec}">${val.nama}</option>`
        }
        html += data
      })
      $(`#kec-edit`).append(html)
    })
    $(`#alamat-edit`).val($(this).attr('alamat'))
    $(`#status-edit option[value=${$(this).attr('status')}]`).attr('selected','selected');
    $('#pass-before').val($(this).attr('pass'))
  })

  //event click for update button
  $('#update-btn').on('click', function(e){
    e.preventDefault()

    let inputValue = getInput('edit')
    if(inputValue){
      console.log(inputValue)
      $.post(`${host}users/update.php`,
      inputValue,
      function(success){
        $.notify("Data berhasil diubah", { position: "right bottom", className: "success" });
        $('#edit-modal').modal('hide')
        table.ajax.reload()
      })
    }
  })

  $('#mydata').on('click', '#detail-btn', function(e){
    e.preventDefault()

    $('#detail-modal').modal('show')

    let id = $(this).val()
    $.get(`${host}berita/selectone.php`,
    {id_berita: id},
    function(json){
      let data = json.result[0]
      $('#detail-judul').text(data.judul_berita)
      $('#detail-user').text(`Oleh : ${data.nama_lengkap}`)
      $('#detail-tgl').text(`Tanggal : ${data.tgl_berita}`)
      $('#detail-img').attr('src', `http://mypajale.id/apimypajale/api/berita/img/${data.gambar_berita}`)
      $('#detail-desc').text(data.deskripsi_berita)
      $('#detail-tanaman').text(`Tanaman : ${data.tanaman}`)

    })
  })

  $('#mydata').on('click', '#delete-btn', function(e){
    e.preventDefault()

    $('#delete-modal').modal('show')

    $('#id-user-delete').val($(this).val())
  })

  $('#delete-btn').on('click', function(e){
    e.preventDefault()

    let id = $('#id-user-delete').val()

    $.post(`${host}users/delete.php`,
    {id_users : id},
    function(success){
      $.notify("Data berhasil dihapus.", { position: "right bottom", className: "success" });
      $('#delete-modal').modal('hide')
      table.ajax.reload()
    })
  })

  function renderActionButton(data){
    return `<button class="btn btn-warning btn-sm m-1" id="edit-btn"
                    value="${data.id_user}"
                    nama="${data.nama_lengkap}"
                    username="${data.id_user}"
                    koordinator="${data.id_koordinator}"
                    email="${data.email_user}"
                    pass="${data.password_user}"
                    phone="${data.telephone_user}"
                    profesi="${data.profesi}"
                    kab="${data.kabupaten}"
                    kec="${data.kecamatan}"
                    alamat="${data.alamat}"
                    status="${data.id_status_users}"><span class="fas fa-edit h6 mr-1"></span>Edit</button>
            <button href="#" class="btn btn-danger btn-sm m-1" id="delete-btn" value="${data.id_user}"><span class="fas fa-trash-alt h6 mr-1"></span>Hapus</button>`
  }

});
