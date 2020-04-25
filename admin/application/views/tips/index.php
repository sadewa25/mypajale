<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap flex-column align-items-left pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Data tips
      <button class="float-right btn btn-success btn-sm" id="add-btn"><span class="fas fa-plus-square h6 mr-1"></span>Tambah</button>
    </h1>
    <table class="table table-striped w-100" id="mydata">
      <thead>
        <tr>
            <th>Judul</th>
            <th>Kategori</th>
            <th>Pengarang</th>
            <th>Tanaman</th>
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
            <h5 class="modal-title" id="modal-add-title">Tambah Tips</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="judul-add">Judul</label>
              <input type="text" class="form-control" id="judul-add" placeholder="Judul tips" value="">
            </div>
            <div class="form-group">
              <label for="desc-add">Deskripsi</label>
              <div id="desc-add"></div>
            </div>
            <div class="form-group">
              <label for="tanaman-add">Tanaman</label>
              <select id="tanaman-add" class="form-control">
                <option value="">Pilih Tanaman</option>
              </select>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="kategori-add">Kategori</label>
                <select id="kategori-add" class="form-control">
                  <option value="">Pilih Kategori</option>
                </select>
              </div>
              <div class="form-group col-md-6">
                <label for="img-add">Gambar</label>
                <input type="file" class="form-control-file p-1" id="img-add">
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary btn-sm" id="save-btn"><span class="fas fa-save h6 mr-1"></span>Simpan</button>
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal"><span class="fas fa-window-close h6 mr-1"></span>Tutup</button>
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
            <h5 class="modal-title" id="modal-edit-title">Edit Tips</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <input type="hidden" class="form-control" id="id-tips-edit" value="">
            <div class="form-group">
              <label for="judul-edit">Judul</label>
              <input type="text" class="form-control" id="judul-edit" placeholder="Judul tips" value="">
            </div>
            <div class="form-group">
              <label for="desc-add">Deskripsi</label>
              <div id="desc-edit"></div>
            </div>
            <div class="form-group">
              <label for="tanaman-edit">Tanaman</label>
              <select id="tanaman-edit" class="form-control">
                <option value="">Pilih Tanaman</option>
              </select>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="kategori-edit">Kategori</label>
                <select id="kategori-edit" class="form-control">
                  <option value="">Pilih Kategori</option>
                </select>
              </div>
              <div class="form-group col-md-6">
                <label for="nama">Gambar</label>
                <input type="file" class="form-control-file p-1" id="img-edit">
                <small class="text-danger">*kosongi jika tidak ingin mengganti gambar.</small>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="img-show">Gambar Sebelumnya</label>
                <img id="img-show" alt="gambar_berita" class="w-100">
              </div>
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

  <!-- Modal detail -->
  <div class="modal fade" tabindex="-1" role="dialog" id="detail-modal">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <input type="hidden" class="form-control" id="id-tips-detail" value="">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h5 class="modal-title">Detail tips</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <h3 id="detail-judul"></h3>
          </div>
          <div class="form-group">
            <p id="detail-user" class="mb-0"></p>
            <span id="detail-kategori" class="d-block"></span>
            <span id="detail-tanaman" class="d-block"></span>

          </div>
          <div class="form-group">
            <img id="detail-img" alt="detail_gambar" class="w-100">
          </div>
          <div class="form-group">
            <p id="detail-desc"></p>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal"><span class="fas fa-window-close h6 mr-1"></span>Tutup</button>
        </div>
      </div>
    </div>
  </div>
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
            <input type="hidden" class="form-control" id="id-tips-delete" value="">
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
<script src="<?php echo base_url().'assets/js/pages/tips/data.js'?>"></script>
