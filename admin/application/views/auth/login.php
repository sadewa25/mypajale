<style media="screen">
  body{
    background-color: #dbe5dc;
background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 80 40' width='80' height='40'%3E%3Cpath fill='%2392ac9d' fill-opacity='0.4' d='M0 40a19.96 19.96 0 0 1 5.9-14.11 20.17 20.17 0 0 1 19.44-5.2A20 20 0 0 1 20.2 40H0zM65.32.75A20.02 20.02 0 0 1 40.8 25.26 20.02 20.02 0 0 1 65.32.76zM.07 0h20.1l-.08.07A20.02 20.02 0 0 1 .75 5.25 20.08 20.08 0 0 1 .07 0zm1.94 40h2.53l4.26-4.24v-9.78A17.96 17.96 0 0 0 2 40zm5.38 0h9.8a17.98 17.98 0 0 0 6.67-16.42L7.4 40zm3.43-15.42v9.17l11.62-11.59c-3.97-.5-8.08.3-11.62 2.42zm32.86-.78A18 18 0 0 0 63.85 3.63L43.68 23.8zm7.2-19.17v9.15L62.43 2.22c-3.96-.5-8.05.3-11.57 2.4zm-3.49 2.72c-4.1 4.1-5.81 9.69-5.13 15.03l6.61-6.6V6.02c-.51.41-1 .85-1.48 1.33zM17.18 0H7.42L3.64 3.78A18 18 0 0 0 17.18 0zM2.08 0c-.01.8.04 1.58.14 2.37L4.59 0H2.07z'%3E%3C/path%3E%3C/svg%3E");
  }
</style>
<div class="container-fluid d-flex flex-column justify-content-center align-items-center min-vh-100">
  <div class="title mb-5">
    <h2 class="text-success">MyPaJaLe</h2>
  </div>
  <form action="" method="post" class="shadow p-3 rounded w-25" style="background:aliceblue;">
    <div class="form-group rounded py-1 border-bottom border-success">
      <h4 class="text-center text-info">ADMIN LOGIN</h4>
    </div>
    <div class="form-group">
      <div class="alert alert-danger px-2 py-2 <?php if (@$message != ''){echo 'd-block';}else{echo 'd-none';}?>" role="alert">
        <small class="form-text"><b>Terjadi kesalahan !</b></small>
        <small class="form-text"><?php echo @$message;?></small>
      </div>
    </div>
    <div class="form-group">
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text border-success"><i class="fas fa-envelope"></i></span>
        </div>
        <input type="text" class="form-control border-success" name="email" placeholder="Email address / NIP / ID User">
      </div>
      <?php echo form_error('email','<small class="form-text text-danger">','</small>'); ?>
    </div>
    <div class="form-group">
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text border-success"><i class="fas fa-lock"></i></span>
        </div>
        <input type="password" class="form-control border-success" name="password" placeholder="Password">
      </div>
      <?php echo form_error('password','<small class="form-text text-danger">','</small>'); ?>
    </div>
    <div class="form-group">
      <input type="submit" value="LOGIN" name="login" class="btn btn-success w-100">
    </div>
    <a href="#" id="forget-btn"><span class="text-primary">Lupa Password ?</span></a>
  </form>

  <!-- Modal add form -->
  <form enctype="multipart/form-data">
    <div class="modal fade" tabindex="-1" role="dialog" id="forget-modal">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modal-add-title">Ubah Password</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="email-add">Email</label>
              <input type="email" class="form-control" id="email-add" value="" required>
            </div>
            <div class="form-group">
              <label for="password-add">Password</label>
              <input type="password" class="form-control" id="password-add" value="" required>
            </div>
            <div class="form-group">
              <label for="ulang-add">Ulangi Password</label>
              <input type="password" class="form-control" id="ulang-add" value="" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary btn-sm" id="save-btn"><span class="fas fa-save h6 mr-1"></span>Simpan</button>
            <button class="btn btn-secondary btn-sm" data-dismiss="modal"><span class="fas fa-window-close h6 mr-1"></span>Tutup</button>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>
<!-- all script for this page start from here -->
<script src="<?php echo base_url().'assets/js/pages/auth.js'?>"></script>
