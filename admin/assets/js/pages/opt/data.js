$(document).ready(function() {
  //show data from api
  const host = 'http://mypajale.sahabatj.com/apimypajale/api/'

  //label for organ
  let header = []

  //show gejala by organ and make to checkbox as input
  const showGejala =  (organ, datas, type) => {
    let gejala = datas.filter(data => {
      return data.organ_terserang == organ
    })
    let organLabel = organ.toLowerCase().replace(" ", "").replace("/", "").replace(" ", "")
    let html = `<span class="bg-info p-1 text-white rounded d-none" id="${organLabel}-btn-${type}">${organ}</span>
                    <div id="${organLabel}-box-${type}" class="d-none">`
    for(let i = 0; i < gejala.length; i++){
      html += `<div class="form-check">
                    <input class="form-check-input" type="checkbox" value="${gejala[i].id_gejala}" name="gejala-${type}" id="gejala-${type}-${organ.toLowerCase().replace(" ", "") +i}">
                    <label class="form-check-label" for="gejala-${type}-${organLabel + i}">
                      ${gejala[i].nama}
                    </label>
                </div>`
    }
    html = html + '</div>'
    $(`#data-organ-${type}`).append(`<option value="${organLabel  }">${organ}</option>`)
    header.push(organLabel)
    return html
  }

  //search gejala to filter checkbox input
  const searchGejala = value => {
    $(`.form-check`).each(function(){
      var found = false
      $(this).each(function(){
        if($(this).text().toLowerCase().indexOf(value.toLowerCase()) >= 0){
          found = true
        }
        if(found){
          $(this).show()
        }else{
          $(this).hide()
        }
      })
    })
  }

  const gejalaAllTanaman = (value, type) => {
    if(value == 'T1'){
      $(`#data-organ-${type}`).empty().append(`<option value="">Pilih Organ</option>`)
      $.get(`${host}gejala/selectbytanaman.php`,
      {id_tanaman: "T1"},
      function(json){
        let result = json.result
        let html = `<div id="data-gejala-${type}" class="d-none">`

        let akar = showGejala('Akar', result, type)
        let batang = showGejala('Batang', result, type)
        let daun = showGejala('Daun', result, type)
        let malai = showGejala('Malai', result, type)
        let seluruh = showGejala('Seluruh Tanaman', result, type)

        html = html + akar + batang + daun + malai + seluruh +'</div>'
        $(`#show-gejala-${type}`).html(html)
      })
      $(`#gejala-box-${type}`).removeClass('d-none')
    }
    if(value == 'T2'){
      $(`#data-organ-${type}`).empty().append(`<option value="">Pilih Organ</option>`)
      $.get(`${host}gejala/selectbytanaman.php`,
      {id_tanaman: "T2"},
      function(json){
        let result = json.result
        let html = `<div id="data-gejala-${type}" class="d-none">`

        let akar = showGejala('Akar', result, type)
        let batang = showGejala('Batang', result, type)
        let bunga = showGejala('Bunga', result, type)
        let daun = showGejala('Daun', result, type)
        let seluruh = showGejala('Seluruh Tanaman', result, type)
        let tongkol = showGejala('Tongkol / Buah', result, type)

        html = html + akar + bunga + batang + daun + seluruh + tongkol +'</div>'
        $(`#show-gejala-${type}`).html(html)
      })
      $(`#gejala-box-${type}`).removeClass('d-none')
    }
    if(value == 'T3'){
      $(`#data-organ-${type}`).empty().append(`<option value="">Pilih Organ</option>`)
      $.get(`${host}gejala/selectbytanaman.php`,
      {id_tanaman: "T3"},
      function(json){
        let result = json.result
        let html = `<div id="data-gejala-${type}" class="d-none">`

        let akar = showGejala('Akar', result, type)
        let batang = showGejala('Batang', result, type)
        let bunga = showGejala('Bunga', result, type)
        let daun = showGejala('Daun', result, type)
        let polong = showGejala('Polong', result, type)
        let seluruh = showGejala('Seluruh Tanaman', result, type)
        let umum = showGejala('Umum', result, type)

        html = html + akar + batang + bunga + daun + polong + seluruh + umum +'</div>'
        $(`#show-gejala-${type}`).html(html)
      })
      $(`#gejala-box-${type}`).removeClass('d-none')
    }
  }

  //function show  all gejala by type input
  const showAllGejala = (selector, type) => {
    $(selector).on('change', function(){
      gejalaAllTanaman($(this).val(), type)
    })
  }

  const filterGejala = (selector, type) => {
    $(selector).on('change', function(){
      for (let i = 0; i < header.length; i++) {
        if($(this).val() === header[i]){
          $(`#${header[i]}-btn-${type}`).removeClass('d-none').addClass('d-block')
          $(`#${header[i]}-box-${type}`).removeClass('d-none')
          $(`#data-gejala-${type}`).removeClass('d-none')
        }else{
          $(`#${header[i]}-btn-${type}`).removeClass('d-block').addClass('d-none')
          $(`#${header[i]}-box-${type}`).removeClass('d-block').addClass('d-none')
          $(`#data-gejala-${type}`).removeClass('d-none')
        }
      }
    })
  }

  let validateCheck = (type) => {
    let checked = false
    $(`#data-gejala-${type} input[type=checkbox]`).each(function(){
      if($(this).is(':checked')){
        checked =  true;
      }
    })
    return checked;
  }

  //setting quill text editor
  const quillAdd = new Quill('#solusi-add', {
    theme: 'snow'
  });
  const quillAddDesc = new Quill('#deskripsi-add', {
    theme: 'snow'
  });

  const quillEdit = new Quill('#solusi-edit', {
    theme: 'snow'
  });
  const quillEditDesc = new Quill('#deskripsi-edit', {
    theme: 'snow'
  });


  const table = $('#mydata').DataTable({
    'ajax' : {
      'url' :`${host}opt/select.php`,
      'dataSrc' : 'result'
    },
    'columns' : [
      {data : 'nama'},
      {data : 'kategori'},
      {data : 'organisme'},
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

  showAllGejala('#tanaman-add', 'add')
  showAllGejala('#tanaman-edit', 'edit')

  filterGejala('#data-organ-add', 'add')
  filterGejala('#data-organ-edit', 'edit')

  $('#search-gejala-add').on('input', function(){
    searchGejala($(this).val())
  })
  $('#search-gejala-edit').on('input', function(){
    searchGejala($(this).val())
  })

  //get data from organ api for select option input
  $.getJSON(`${host}organisme/select.php`, function( data ) {
    let html = ""
    $.each(data.result, (i, val) =>{
      html += `<option value="${val.id_organisme}">${val.nama}</option>`
    })
    $('#organisme-add').append(html)
    $('#organisme-edit').append(html)

  })

  //get data from organ api for select option input
  $.getJSON(`${host}kategori-opt/select.php`, function( data ) {
    let html = ""
    $.each(data.result, (i, val) =>{
      html += `<option value="${val.id_kategori_opt}">${val.nama}</option>`
    })
    $('#kategori-add').append(html)
    $('#kategori-edit').append(html)

  })

  $('#add-btn').on('click', function(){
    $('#add-modal').modal('show')
  })
  //save data
  $('#save-btn').on('click', function(){
    //get data from input field
    let nama = $('#nama-add').val()
    let deskripsi = quillAddDesc.root.innerHTML
    let solusi = quillAdd.root.innerHTML
    let tanaman = $('#tanaman-add').val()
    let organisme = $('#organisme-add').val()
    let gejala = "";
    let kategori = $('#kategori-add').val()
    let gambar =  ''
    let file = new FormData() //form data for file input

    //check if input is empty or not
    if(nama != '' && organisme != '' && tanaman != '' && kategori != '' && validateCheck('add')) {
      $('#data-gejala-add input:checked').each(function() {
          gejala += $(this).val()+",";
      });
      gejala = gejala.substring(0,gejala.length-1)
      //check if file is empty or not
      if ($('#img-add')[0].files.length != 0){
        file.append('file', $('#img-add')[0].files[0])
        gambar = $('#img-add')[0].files[0].name
        //upload file to api
        $.ajax({
          url: `${host}opt/upload.php`,
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

      $.post(`${host}opt/insert.php`,
      { nama: nama,
        gejala: gejala,
        gambar_opt: gambar,
        solusi: solusi,
        id_kategori: kategori,
        id_organisme: organisme,
        id_tanaman: tanaman,
        deskripsi_opt: deskripsi },
      function(success){
        //show notif
        $.notify("Data berhasil disimpan", { position: "right bottom", className: "success" });
        //clean input field
        $('#nama-add').val("")
        $(`#organisme-add`).val("")
        $(`#tanaman-add`).val("")
        $(`#kategori-add`).val("")
        $('#data-organ-add').val("")
        $('#search-gejala-add').val("")
        quillAddDesc.setText("")
        quillAdd.setText("")
        $('#data-gejala-add input').each(function() {
            $(this).prop('checked', false)
        });
        //reload datatables
        table.ajax.reload()
      })
    }else{
      //set and show notification is input is empty
      $.notify("Tolong lengkapi data.", { position: "right bottom", className: "error" });
      if (nama == '') {
        $("#nama-add").notify("Tidak boleh kosong.", { position: "left middle", className: "error" });
      }
      if (organisme == '') {
        $("#organisme-add").notify("Pilih salah satu.", { position: "right middle", className: "error" });
      }
      if (tanaman == '') {
        $("#tanaman-add").notify("Pilih salah satu.", { position: "left middle", className: "error" });
      }
      if (!validateCheck('add') && $('#data-organ-add').val() != '') {
        $("#data-organ-add").notify("Centang setidaknya satu gejala.", { position: "left middle", className: "error" });
      }
      if (kategori == '') {
        $("#kategori-add").notify("Pilih salah satu.", { position: "left middle", className: "error" });
      }
    }
  })

  $('#mydata').on('click', '#edit-btn', function(){
    $('#edit-modal').modal('show')
    $('#gejala-before').empty()
    $('#value-gejala-before').val($(this).attr('gejala'))
    let gejala = $(this).attr('gejala').split(",")

    if ($('#data-gejala-edit input[type=checkbox]').length ) {
      $.each(gejala, function(i, val){
        console.log($("input[value='" + val + "']").length)
        $("input[value='" + val + "']").prop('checked', true);
      });
    }

    $('#id-opt-edit').val($(this).val())
    $('#nama-edit').val($(this).attr('name'))
    quillEditDesc.setText($(this).attr('deskripsi'))
    quillEdit.setText($(this).attr('solusi'))
    $(`#organisme-edit option:contains(${$(this).attr('organisme')})`).attr('selected', 'selected')
    $(`#tanaman-edit option:contains(${$(this).attr('tanaman')})`).attr('selected', 'selected')
    $(`#kategori-edit option:contains(${$(this).attr('kategori')})`).attr('selected', 'selected')
    $('#img-edit').attr('title', $(this).attr('img'))
    $('#img-show').attr('src', `http://mypajale.sahabatj.com/apimypajale/api/opt/img/${$(this).attr('img')}`)
    gejalaAllTanaman($('#tanaman-edit').val(), 'edit')

    for(let i = 0; i < gejala.length; i++){
      $.get(`${host}/gejala/selectone.php`,
      {id_gejala: gejala[i]},
      function(json){
        $('#gejala-before').append(`<li>${json.result[0].nama}</li>`)
      })
    }

  })
  //update data
  $('#update-btn').on('click', function(){
    //get data from input field
    let id = $('#id-opt-edit').val()
    let nama = $('#nama-edit').val()
    let deskripsi = quillEditDesc.root.innerHTML
    let solusi = quillEdit.root.innerHTML
    let tanaman = $('#tanaman-edit').val()
    let organisme = $('#organisme-edit').val()
    let gejala = "";
    let kategori = $('#kategori-edit').val()
    let gambar =  ''
    let file = new FormData() //form data for file input

    //check if input is empty or not
    if(nama != '' && organisme != '' && tanaman != '' && kategori != '') {
      if (validateCheck('edit')) {
        $('#data-gejala-edit input:checked').each(function() {
            gejala += $(this).val()+",";
        });
        gejala = gejala.substring(0,gejala.length-1)
      }else{
        gejala = $('#value-gejala-before').val()
      }

      //check if file is empty or not
      if ($('#img-edit')[0].files.length != 0){
        file.append('file', $('#img-edit')[0].files[0])
        gambar = $('#img-edit')[0].files[0].name
        //upload file to api
        $.ajax({
          url: `${host}opt/upload.php`,
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

      $.post(`${host}opt/update.php`,
      { nama: nama,
        gejala: gejala,
        gambar_opt: gambar,
        solusi: solusi,
        id_kategori: kategori,
        id_organisme: organisme,
        id_tanaman: tanaman,
        deskripsi_opt: deskripsi,
        id_opt: id },
      function(success){
        //show notif
        $.notify("Data berhasil diubah", { position: "right bottom", className: "success" });
        //reload datatables
        table.ajax.reload()
      })
    }else{
      //set and show notification is input is empty
      $.notify("Tolong lengkapi data.", { position: "right bottom", className: "error" });
      if (nama == '') {
        $("#nama-edit").notify("Tidak boleh kosong.", { position: "left middle", className: "error" });
      }
      if (organisme == '') {
        $("#organisme-edit").notify("Tidak boleh kosong.", { position: "right middle", className: "error" });
      }
      if (tanaman == '') {
        $("#tanaman-edit").notify("Tidak boleh kosong.", { position: "left middle", className: "error" });
      }
      if (kategori == '') {
        $("#kategori-edit").notify("Tidak boleh kosong.", { position: "left middle", className: "error" });
      }
    }
  })

  $('#mydata').on('click', '#delete-btn', function(){
    $('#delete-modal').modal('show')

    $('#id-opt-delete').val($(this).val())
  })

  $('#delete-btn').on('click', function(){
    let id = $('#id-opt-delete').val()

    $.post(`${host}opt/delete.php`,
    {id_opt : id},
    function(success){
      $.notify("Data berhasil dihapus.", { position: "right bottom", className: "success" });
      $('#delete-modal').modal('hide')
      table.ajax.reload()
    })
  })

  function renderActionButton(data){
    return `<button class="btn btn-warning btn-sm mx-1" id="edit-btn"
                    value="${data.id}"
                    name="${data.nama}"
                    gejala="${data.gejala}"
                    img="${data.gambar_opt}"
                    solusi="${data.solusi}"
                    kategori="${data.kategori}"
                    organisme="${data.organisme}"
                    tanaman="${data.tanaman}"
                    deskripsi="${data.deskripsi_opt}"><span class="fas fa-edit h6 mr-1"></span>Edit</button>
            <button href="#" class="btn btn-danger btn-sm mx-1" id="delete-btn" value="${data.id}"><span class="fas fa-trash-alt h6 mr-1"></span>Hapus</button>`
  }

});
