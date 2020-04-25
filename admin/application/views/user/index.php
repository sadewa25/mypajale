<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap flex-column align-items-left pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Data User
      <button class="float-right btn btn-success btn-sm" id="add-btn"><span class="fas fa-plus-square h6 mr-1"></span>Tambah</button>
    </h1>
    <table class="table table-striped w-100" id="mydata">
      <thead>
        <tr>
            <th>Nama</th>
            <th>Email</th>
            <th>Telephone</th>
            <th>Profresi</th>
            <th>Alamat</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
      </thead>
    </table>
  </div>

  <!-- Modal add form -->
  <form enctype="multipart/form-data">
    <div class="modal fade" tabindex="-1" role="dialog" id="add-modal">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header bg-success">
            <h5 class="modal-title" id="modal-add-title">Tambah User</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="nama-add">Nama Lengkap</label>
              <input type="text" class="form-control" id="nama-add" placeholder="Nama lengkap..." value="" required>
            </div>
            <div class="form-group">
              <label for="email-add">Email</label>
              <input type="email" class="form-control" id="email-add" placeholder="Email..." value="" required>
            </div>
            <div class="form-group">
              <label for="pass-add">Password</label>
              <input type="password" class="form-control" id="pass-add" placeholder="Password..." value="" required>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="phone-add">No. Telp</label>
                <input type="text" class="form-control" id="phone-add" placeholder="No telephone..." value="" required>
              </div>
              <div class="form-group col-md-6">
                <label for="profesi-add">Profesi</label>
                <input type="text" class="form-control" id="profesi-add" placeholder="Profesi..." value="" required>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="kab-add">Kabupaten</label>
                <select id="kab-add" class="form-control">
                  <option value="">Pilih Kabupaten</option>
                </select>
              </div>
              <div class="form-group col-md-6">
                <label for="kec-add">Kecamatan</label>
                <select id="kec-add" class="form-control" disabled>
                  <option value="">Pilih Kecamatan</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="alamat-add">Alamat</label>
              <textarea class="form-control-file p-1" id="alamat-add"></textarea>
            </div>
            <div class="form-group">
              <label for="status-add">Status User</label>
              <select id="status-add" class="form-control">
                <option value="">Pilih Status</option>
              </select>
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

  <!-- Modal edit form -->
  <form>
    <div class="modal fade" tabindex="-1" role="dialog" id="edit-modal">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header bg-warning">
            <h5 class="modal-title" id="modal-edit-title">Edit User</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <input type="hidden" class="form-control" id="id-user-edit">
            <div class="form-group">
              <label for="nama-edit">Nama Lengkap</label>
              <input type="text" class="form-control" id="nama-edit" placeholder="Nama lengkap..." value="" required>
            </div>
            <div class="form-group">
              <label for="email-edit">Email</label>
              <input type="email" class="form-control" id="email-edit" placeholder="Email..." value="" required>
            </div>
            <div class="form-group">
              <input type="hidden" id="pass-before">
              <label for="pass-edit">Password</label>
              <input type="password" class="form-control" id="pass-edit" placeholder="Password..." value="" required>
              <small class="text-danger">*kosongi jika tidak ingin mengganti password</small>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="phone-edit">No. Telp</label>
                <input type="text" class="form-control" id="phone-edit" placeholder="No telephone..." value="" required>
              </div>
              <div class="form-group col-md-6">
                <label for="profesi-edit">Profesi</label>
                <input type="text" class="form-control" id="profesi-edit" placeholder="Profesi..." value="" required>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="kab-edit">Kabupaten</label>
                <select id="kab-edit" class="form-control">
                  <option value="">Pilih Kabupaten</option>
                </select>
              </div>
              <div class="form-group col-md-6">
                <label for="kec-edit">Kecamatan</label>
                <select id="kec-edit" class="form-control">
                  <option value="">Pilih Kecamatan</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="alamat-edit">Alamat</label>
              <textarea class="form-control-file p-1" id="alamat-edit"></textarea>
            </div>
            <div class="form-group">
              <label for="status-edit">Status User</label>
              <select id="status-edit" class="form-control">
                <option value="">Pilih Status</option>
              </select>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary btn-sm" id="update-btn"><span class="fas fa-save h6 mr-1"></span>Simpan</button>
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal"><span class="fas fa-window-close h6 mr-1"></span>Tutup</button>
          </div>
        </div>
      </div>
    </div>
  </form>

  <!-- Modal delete form -->
  <form>
    <div class="modal fade" tabindex="-1" role="dialog" id="delete-modal">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header bg-danger">
            <h5 class="modal-title">Konfirmasi</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <input type="hidden" class="form-control" id="id-user-delete" value="">
            <p>Anda yakin ingin menghapus data ini ?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary btn-sm" id="delete-btn"><span class="fas fa-check-square h6 mr-1"></span>Ya</button>
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal"><span class="fas fa-window-close h6 mr-1"></span>Tidak</button>
          </div>
        </div>
      </div>
    </div>
  </form>
</main>
<!-- all script for this page start from here -->
<script src="<?php echo base_url().'assets/js/pages/user.js'?>"></script>
