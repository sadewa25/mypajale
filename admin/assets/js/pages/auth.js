$(document).ready(function(){
  //event clik for add button
  $('#forget-btn').on('click', function(){
    $('#forget-modal').modal('show') //show modal add form
  })

  $('#save-btn').on('click', function(){
    let email = $('#email-add').val()
    let pass = $('#password-add').val()
    let conPass = $('#ulang-add').val()

    const confirm = () => {
      let ok = false
      if (pass === conPass) {
        ok = true
      }
      return ok
    }

    if (email != '' && pass != '' && conPass != '' && confirm() ) {
      $.post(`http://mypajale.id/apimypajale/api/users/changepassword.php`,
      {email_user: email,
       password_user: pass},
      function(json){
        console.log(json.value)
        if (json.value > 0) {
          $.notify("Password berhasil diubah", { position: "right bottom", className: "success" });
          $('#forget-modal').modal('hide')
        }else{
          $.notify("Email tidak terdaftar.", { position: "right bottom", className: "error" });
          $('#forget-modal').modal('hide')
        }
        $('#email-add').val('')
        $('#password-add').val('')
        $('#ulang-add').val('')
      })


    }else{
      //set and show notification is input is empty
      $.notify("Tolong lengkapi data.", { position: "right bottom", className: "error" });
      if (email == '') {
        $("#email-add").notify("Tidak boleh kosong.", { position: "left middle", className: "error" });
      }
      if (pass == '') {
        $("#password-add").notify("Tidak boleh kosong.", { position: "left middle", className: "error" });
      }
      if (conPass == '') {
        $("#ulang-add").notify("Tidak boleh kosong.", { position: "left middle", className: "error" });
      }
      if (!confirm()) {
        $("#ulang-add").notify("Password tidak sama.", { position: "left middle", className: "error" });
      }
    }
  })
})
