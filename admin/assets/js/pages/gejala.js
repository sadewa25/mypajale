$(document).ready(function() {
  //show data from api
  const host = 'http://mypajale.sahabatj.com/apimypajale/api/'

  const table = $('#mydata').DataTable({
    'ajax' : {
      'url' :`${host}gejala/select.php`,
      'dataSrc' : 'result'
    },
    'columns' : [
      {data : 'nama'},
      {data : 'organ_terserang'},
      {data : 'tanaman'},
      {data : null, render: renderActionButton}
    ],
    responsive: true
  })

  //get data from organ api for select option input
  $.getJSON(`${host}organ/select.php`, function( data ) {
    let html = ""
    $.each(data.result, (i, val) =>{
      html += `<option value="${val.id_organ}">${val.nama}</option>`
    })
    $('#organ-terserang-add').append(html)
    $('#organ-terserang-edit').append(html)

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

  $('#add-btn').on('click', function(){
    $('#add-modal').modal('show')
  })

  $('#save-btn').on('click', function(){
    //get data from input field
    let nama = $('#nama-add').val()
    let organTerserang = $('#organ-terserang-add').val()
    let tanaman = $('#tanaman-add').val()

    //check if input is empty or not
    if(nama != '' && organTerserang != '' && tanaman != '') {
      $.post(`${host}gejala/insert.php`,
      { nama: nama,
        id_organ_terserang: organTerserang,
        id_tanaman: tanaman },
      function(success){
        //show notif
        $.notify("Data berhasil disimpan", { position: "right bottom", className: "success" });
        //clean input field
        $('#nama-add').val("")
        $('#organ-terserang-add').val("")
        $('#tanaman-add').val("")
        //reload datatables
        table.ajax.reload()
      })
    }else{
      //set and show notification is input is empty
      $.notify("Tolong lengkapi data.", { position: "right bottom", className: "error" });
      if (nama == '') {
        $("#nama-add").notify("Tidak boleh kosong.", { position: "left middle", className: "error" });
      }
      if (organTerserang == '') {
        $("#organ-terserang-add").notify("Tidak boleh kosong.", { position: "left middle", className: "error" });
      }
      if (tanaman == '') {
        $("#tanaman-add").notify("Tidak boleh kosong.", { position: "right middle", className: "error" });
      }
    }
  })

  $('#mydata').on('click', '#edit-btn', function(){
    $('#edit-modal').modal('show')

    $('#id-gejala-edit').val($(this).val())
    $('#nama-edit').val($(this).attr('name'))
    $(`#organ-terserang-edit option:contains(${$(this).attr('organ')})`).attr('selected', 'selected')
    $(`#tanaman-edit option:contains(${$(this).attr('tanaman')})`).attr('selected', 'selected')
  })

  $('#update-btn').on('click', function(){
    let id = $('#id-gejala-edit').val()
    let nama = $('#nama-edit').val()
    let organTerserang = $('#organ-terserang-edit').val()
    let tanaman = $('#tanaman-edit').val()
    //check if input is empty or not
    if(nama != '' && organTerserang != '' && tanaman != '') {
      $.post(`${host}gejala/update.php`,
      { id_gejala : id,
        nama: nama,
        id_organ_terserang: organTerserang,
        id_tanaman: tanaman},
      function(success){
        $.notify("Data berhasil diubah", { position: "right bottom", className: "success" });
        table.ajax.reload()
      })
    }else{
      //set and show notification is input is empty
      $.notify("Tolong lengkapi data.", { position: "right bottom", className: "error" });
      if (nama == '') {
        $("#nama-add").notify("Tidak boleh kosong.", { position: "left middle", className: "error" });
      }
      if (organTerserang == '') {
        $("#organ-terserang-add").notify("Tidak boleh kosong.", { position: "left middle", className: "error" });
      }
      if (tanaman == '') {
        $("#tanaman-add").notify("Tidak boleh kosong.", { position: "right middle", className: "error" });
      }
    }
  })

  $('#mydata').on('click', '#delete-btn', function(){
    $('#delete-modal').modal('show')

    $('#id-gejala-delete').val($(this).val())
  })

  $('#delete-btn').on('click', function(){
    let id = $('#id-gejala-delete').val()

    $.post(`${host}gejala/delete.php`,
    {id_gejala : id},
    function(success){
      $.notify("Data berhasil dihapus.", { position: "right bottom", className: "success" });
      $('#delete-modal').modal('hide')
      table.ajax.reload()
    })
  })

  function renderActionButton(data){
    return `<button class="btn btn-warning btn-sm mx-1" id="edit-btn"
                    value="${data.id_gejala}" name="${data.nama}"
                    organ="${data.organ_terserang}"
                    tanaman="${data.tanaman}"><span class="fas fa-edit h6 mr-1"></span>Edit</button>
            <button href="#" class="btn btn-danger btn-sm mx-1" id="delete-btn" value="${data.id_gejala}"><span class="fas fa-trash-alt h6 mr-1"></span>Hapus</button>`
  }

});
