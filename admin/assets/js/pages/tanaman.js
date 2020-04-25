$(document).ready(function() {
  //show data from api
  const host = $('#ip-server').text()

  const table = $('#mydata').DataTable({
    'ajax' : `http://${host}/apimypajale/api/tanaman/select.php`,
    'columns' : [
      {data : 'nama'},
      {data : null, render: renderActionButton}
    ],
    responsive: true
  })

  $('#add-btn').on('click', function(){
    $('#add-modal').modal('show')
  })

  $('#mydata').on('click', '#edit-btn', function(){
    $('#edit-modal').modal('show')

    $('#nama-edit').val($(this).attr('name'))
    $('#id-tanaman-edit').val($(this).val())
  })

  $('#save-btn').on('click', function(){
    let namaTanaman = $('#nama-add').val()

    $.post(`http://${host}/apimypajale/api/tanaman/insert.php`,
    {nama: namaTanaman},
    function(success){
      $('#add-modal').modal('hide')
      table.ajax.reload()
    })
  })

  $('#update-btn').on('click', function(){
    let idTanaman = $('#id-tanaman-edit').val()
    let namaTanaman = $('#nama-edit').val()

    $.post(`http://${host}/apimypajale/api/tanaman/update.php`,
    {id : idTanaman, nama: namaTanaman},
    function(success){
      $('#edit-modal').modal('hide')
      table.ajax.reload()
    })
  })

  $('#mydata').on('click', '#delete-btn', function(){
    $('#delete-modal').modal('show')

    $('#id-tanaman-delete').val($(this).val())
  })

  $('#delete-btn').on('click', function(){
    let idTanaman = $('#id-tanaman-delete').val()

    $.post(`http://${host}/apimypajale/api/tanaman/delete.php`,
    {id : idTanaman},
    function(success){
      $('#delete-modal').modal('hide')
      table.ajax.reload()
    })
  })

  function renderActionButton(data){
    return `<button class="btn btn-warning btn-sm mx-1" id="edit-btn" value="${data.id}" name="${data.nama}"><span class="fas fa-edit h6 mr-1"></span>Edit</button>
            <button href="#" class="btn btn-danger btn-sm mx-1" id="delete-btn" value="${data.id}"><span class="fas fa-trash-alt h6 mr-1"></span>Hapus</button>`
  }

});
