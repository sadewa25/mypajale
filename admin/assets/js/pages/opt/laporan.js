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

  //show gejala by organ and make to checkbox as input
  const filterOpt =  (tanaman, datas, type) => {
    let opt = datas.filter(data => {
      return data.tanaman == tanaman
    })
    let label = tanaman.toLowerCase()
    let html = `<span class="bg-info p-1 text-white rounded d-block" id="${label}-btn-${type}">${tanaman}</span>
                    <div id="${label}-box-${type}">`
    for(let i = 0; i < opt.length; i++){
      html += `<div class="form-check">
                    <input class="form-check-input" type=radio value="${opt[i].id}" name="opt-${type}" id="opt-${type}-${label +"-"+ i}">
                    <label class="form-check-label" for="opt-${type}-${label +"-"+ i}">
                      ${opt[i].nama}
                    </label>
                </div>`
    }
    html = html + '</div>'
    return html
  }

  const showOpt = (tanaman, value, type) => {
    $.post(`${host}opt/selectbytanaman.php`,
    {id_tanaman: value},
    function(json){
      let result = json.result
      let html = `<div id="data-opt-${type}">`

      let data = filterOpt(tanaman, result, type)

      html = html + data +'</div>'
      $(`#show-opt-${type}`).html(html)
    })
    $(`#opt-box-${type}`).removeClass('d-none')
  }

  const allOpt = (value, type) => {
    if (value == 'T1') {
      showOpt('Padi', value, type)
    }
    if (value == 'T2') {
      showOpt('Jagung', value, type)
    }
    if (value == 'T3') {
      showOpt('Kedelai', value, type)
    }
  }

  const chooseOpt = (selector, type) => {
    $(selector).on('change', function(){
      allOpt($(this).val(),type)
    })
  }

  const searchOpt = value => {
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

  let validateCheck = (type) => {
    let checked = false
    $(`#data-opt-${type} input[type=radio]`).each(function(){
      if($(this).is(':checked')){
        checked =  true;
      }
    })
    return checked;
  }

  const getInput = type => {
    data = {
      id_user: $('#id-user').val(),
      judul_laporan : $(`#judul-${type}`).val(),
      id_penyakit : $(`#data-opt-${type} input:checked`).val(),
      id_kab : $(`#kab-${type}`).val(),
      id_kec : $(`#kec-${type}`).val(),
      desa : $(`#desa-${type}`).val(),
      nama_kelompok_tani : $(`#nama-tani-${type}`).val(),
      id_jenis_tanaman : $(`#tanaman-${type}`).val(),
      varietas : $(`#varietas-${type}`).val(),
      umur : $(`#umur-${type}`).val(),
      intensitas_serangan : $(`#intensitas-${type}`).val(),
      luas_terserang : $(`#terserang-${type}`).val(),
      luas_hamparan : $(`#hamparan-${type}`).val(),
      gambar : '',
      jenis_musuh_alami: $(`#musuh-${type}`).val(),
      kesimpulan : '',
      rekomendasi : '',
      tanggal : $(`#tgl-${type}`).val(),
      id_laporan_opt: $('#id-laporan-edit').val()
    }
    let file = new FormData() //form data for file input

    if(type == 'add') {
      // data.kesimpulan = quillSimpulAdd.root.innerHTML
      // data.rekomendasi = quillRekomAdd.root.innerHTML
      data.kesimpulan = $('#kesimpulan-add').val();
      data.rekomendasi = $('#rekomendasi-add').val();
    }
    if(type == 'edit') {
      // data.kesimpulan = quillSimpulEdit.root.innerHTML
      // data.rekomendasi = quillRekomEdit.root.innerHTML
      data.kesimpulan = $('#kesimpulan-edit').val();
      data.rekomendasi = $('#rekomendasi-edit').val();
      if (data.id_penyakit === undefined) {
        data.id_penyakit = $('#id-opt-edit').val()
      }
    }

    if ($(`#img-${type}`)[0].files.length != 0){
      file.append('file', $(`#img-${type}`)[0].files[0])
      data.gambar = $(`#img-${type}`)[0].files[0].name
      //upload file to api
      $.ajax({
        url: `${host}laporan-opt/upload.php`,
        type: 'post',
        data: file,
        contentType: false,
        processData: false,
        success: function(response){
          return true
        }
      })
    }else{
      if (type === 'edit') {
        data.gambar = $('#img-name').text
      }
      data.gambar = 'noimg.jpg'
    }

    if(data.judul_laporan != '' && data.id_penyakit != '' && data.id_kab != '' && data.id_kec != '' && data.desa != '' &&
       data.nama_kelompok_tani != '' && data.id_jenis_tanaman != '' && data.varietas != '' && data.umur != '' &&
       data.intensitas_serangan != '' && data.luas_serangan != '' && data.luas_hamparan != '' && data.tanggal != ''){
      return data
    }else{
      //set and show notification is input is empty
      $.notify("Tolong lengkapi data.", { position: "right bottom", className: "error" });
      if (data.judul_laporan == '') {
        $(`#judul-${type}`).notify("Tidak boleh kosong.", { position: "left middle", className: "error" });
      }
      if (!validateCheck(type)) {
        $(`#data-opt-${type}`).notify("Pilih salah satu.", { position: "left top", className: "error" });
      }
      if (data.id_kab == '') {
        $(`#kab-${type}`).notify("Pilih salah satu.", { position: "left middle", className: "error" });
      }
      if (data.id_kec == '') {
        $(`#kec-${type}`).notify("Pilih salah satu.", { position: "right middle", className: "error" });
      }
      if (data.desa == '') {
        $(`#desa-${type}`).notify("Tidak boleh kosong.", { position: "left middle", className: "error" });
      }
      if (data.nama_kelompok_tani == '') {
        $(`#nama-tani-${type}`).notify("Tidak boleh kosong.", { position: "left middle", className: "error" });
      }
      if (data.id_jenis_tanaman == '') {
        $(`#tanaman-${type}`).notify("Pilih salah satu.", { position: "right middle", className: "error" });
      }
      if (data.varietas == '') {
        $(`#varietas-${type}`).notify("Tidak boleh kosong.", { position: "right middle", className: "error" });
      }
      if (data.umur == '') {
        $(`#umur-${type}`).notify("Tidak boleh kosong.", { position: "left middle", className: "error" });
      }
      if (data.intensitas_serangan == '') {
        $(`#intensitas-${type}`).notify("Tidak boleh kosong.", { position: "right middle", className: "error" });
      }
      if (data.luas_terserang == '') {
        $(`#terserang-${type}`).notify("Tidak boleh kosong.", { position: "left middle", className: "error" });
      }
      if (data.luas_hamparan == '') {
        $(`#hamparan-${type}`).notify("Tidak boleh kosong.", { position: "right middle", className: "error" });
      }
      if (data.jenis_musuh_alami == '') {
        $(`#musuh-${type}`).notify("Tidak boleh kosong.", { position: "left middle", className: "error" });
      }
      if (data.tanggal == '') {
        $(`#tgl-${type}`).notify("Pilih tanggal.", { position: "left middle", className: "error" });
      }
      return false
    }

  }

  const table = $('#mydata').DataTable({
    'ajax' : {
      'url' : `${host}laporan-opt/select.php`,
      'dataSrc': 'result'
    },
    'columns' : [
      {data : 'judul_laporan'},
      {data : 'tanaman'},
      {data : 'nama_lengkap'},
      {data : 'kecamatan'},
      {data : 'kabupaten'},
      {data : null, render: renderActionButton}
    ],
    responsive: true
  })

  //setting quill text editor
  // const quillSimpulAdd = new Quill('#kesimpulan-add', {
  //   theme: 'snow'
  // });
  // const quillSimpulEdit = new Quill('#kesimpulan-edit', {
  //   theme: 'snow'
  // });
  //
  // const quillRekomAdd = new Quill('#rekomendasi-add', {
  //   theme: 'snow'
  // });
  // const quillRekomEdit = new Quill('#rekomendasi-edit', {
  //   theme: 'snow'
  // });

  //get data  from kabupaten api and display to select input
  $.getJSON(`${host}kabupaten/select.php`, function( data ) {
    let html = ""
    $.each(data.result, (i, val) =>{
      html += `<option value="${val.id_kab}">${val.nama}</option>`
    })
    $('#kab-add').append(html)
    $('#kab-edit').append(html)
  })

  chooseKec('#kab-add', 'add')
  chooseKec('#kab-edit', 'edit')

  //get data from tanaman api
  $.getJSON(`${host}tanaman/select.php`, function( data ) {
    let html = ""
    $.each(data.result, (i, val) =>{
      html += `<option value="${val.id_tanaman}">${val.nama}</option>`
    })
    $('#tanaman-add').append(html)
    $('#tanaman-edit').append(html)
  })

  chooseOpt('#tanaman-add', 'add')
  chooseOpt('#tanaman-edit', 'edit')

  $('#search-opt-add').on('input', function(){
    searchOpt($(this).val())
  })
  $('#search-opt-edit').on('input', function(){
    searchOpt($(this).val())
  })

  $('#add-btn').on('click', function(){
    $('#add-modal').modal('show')
  })

  //insert to api
  $('#save-btn').on('click', function(e){
    e.preventDefault()
    let inputValue = getInput('add')
    if(inputValue){
      // console.log(inputValue)
      $.post(`${host}laporan-opt/insert.php`,
      inputValue,
      function(success){
        $.notify("Data berhasil disimpan", { position: "right bottom", className: "success" });
        $(`#judul-add`).val('')
        $(`#kab-add`).val('')
        $(`#kec-add`).val('')
        $(`#desa-add`).val('')
        $(`#nama-tani-add`).val('')
        $(`#tanaman-add`).val('')
        $(`#varietas-add`).val('')
        $(`#umur-add`).val('')
        $(`#intensitas-add`).val('')
        $(`#terserang-add`).val('')
        $(`#hamparan-add`).val('')
        $(`#musuh-add`).val('')
        $(`#tgl-add`).val('')
        $('#img-add').val(null);
        // quillSimpulAdd.setText("")
        // quillRekomAdd.setText("")
        $('#kesimpulan-add').val('');
        $('#rekomendasi-add').val('');
        $(`#opt-box-add`).addClass('d-none')
        $('#data-opt-add input').each(function() {
            $(this).prop('checked', false)
        });
        table.ajax.reload()
      })
    }

  })

  //display data to form
  $('#mydata').on('click', '#edit-btn', function(e){
    e.preventDefault()
    $('#edit-modal').modal('show')

    $('#id-laporan-edit').val($(this).val())
    $(`#judul-edit`).val($(this).attr('judul'))
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

    $(`#desa-edit`).val($(this).attr('desa'))
    $(`#nama-tani-edit`).val($(this).attr('tani'))
    $(`#tanaman-edit option:contains(${$(this).attr('tanaman')})`).attr('selected', 'selected')
    $(`#varietas-edit`).val($(this).attr('varietas'))
    $(`#umur-edit`).val($(this).attr('umur'))
    $(`#intensitas-edit`).val($(this).attr('serangan'))
    $(`#terserang-edit`).val($(this).attr('terserang'))
    $(`#hamparan-edit`).val($(this).attr('hamparan'))
    $(`#musuh-edit`).val($(this).attr('musuh'))
    $(`#tgl-edit`).val($(this).attr('tgl'))
    // quillSimpulEdit.setText($(this).attr('simpulan'))
    // quillRekomEdit.setText($(this).attr('rekom'))
    $('#kesimpulan-edit').val($(this).attr('simpulan'))
    $('#rekomendasi-edit').val($(this).attr('rekom'))
    $('#img-show').attr('src', `http://mypajale.id/apimypajale/api/laporan-opt/img/${$(this).attr('img')}`)
    allOpt($('#tanaman-edit').val(), 'edit')
    $('#nama-opt').text($(this).attr('opt'))
    $('#id-opt-edit').val($(this).attr('idopt'))
    $('#img-name').text($(this).attr('img'))

  })

  $('#update-btn').on('click', function(e){
    e.preventDefault()
    let inputValue = getInput('edit')
    if(inputValue){
      // console.log(inputValue)
      $.post(`${host}laporan-opt/update.php`,
      inputValue,
      function(success){
        $.notify("Data berhasil diubah", { position: "right bottom", className: "success" });
        table.ajax.reload()
        $('#edit-modal').modal('hide')
      })
    }
  })

  $('#mydata').on('click', '#delete-btn', function(e){
    e.preventDefault()
    $('#delete-modal').modal('show')

    $('#id-laporan-delete').val($(this).val())
  })

  $('#delete-btn').on('click', function(e){
    e.preventDefault()
    let id = $('#id-laporan-delete').val()

    $.post(`${host}laporan-opt/delete.php`,
    {id_laporan_opt : id},
    function(success){
      $('#delete-modal').modal('hide')
      $.notify("Data berhasil dihapus.", { position: "right bottom", className: "success" });

      table.ajax.reload()
    })
  })

  function renderActionButton(data){
    return `<button class="btn btn-warning btn-sm m-1" id="edit-btn"
                    value="${data.id_laporan_opt}"
                    kab="${data.kabupaten}"
                    kec="${data.kecamatan}"
                    judul="${data.judul_laporan}"
                    nama="${data.nama_lengkap}"
                    tanaman="${data.tanaman}"
                    desa="${data.desa}"
                    opt="${data.nama_opt}"
                    tani="${data.nama_kelompok_tani}"
                    varietas="${data.varietas}"
                    umur="${data.umur}"
                    serangan="${data.intensitas_serangan}"
                    terserang="${data.luas_terserang}"
                    hamparan="${data.luas_hamparan}"
                    img="${data.gambar}"
                    tgl="${data.tanggal}"
                    musuh="${data.jenis_musuh_alami}"
                    simpulan="${data.kesimpulan}"
                    rekom="${data.rekomendasi}"
                    idopt=${data.id_penyakit}><span class="fas fa-edit h6 mr-1"></span>Edit</button>
            <button href="#" class="btn btn-danger btn-sm m-1" id="delete-btn" value="${data.id_laporan_opt}"><span class="fas fa-trash-alt h6 mr-1"></span>Hapus</button>`
  }

});
