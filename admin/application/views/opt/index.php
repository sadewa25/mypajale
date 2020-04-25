<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap flex-column align-items-left pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Data OPT
      <button class="float-right btn btn-success btn-sm" id="add-btn"><span class="fas fa-plus-square h6 mr-1"></span>Tambah</button>
    </h1>
    <table class="table table-striped w-100" id="mydata">
      <thead>
        <tr>
            <th>Nama</th>
            <th>Kategori</th>
            <th>Organisme</th>
            <th>Tanaman</th>
            <th>Action</th>
        </tr>
      </thead>
    </table>
  </div>

  <!-- Modal add form -->
  <form>
    <div class="modal fade" tabindex="-1" role="dialog" id="add-modal">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header bg-success">
            <h5 class="modal-title" id="modal-add-title">Tambah OPT</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="nama-add">Nama</label>
              <input type="text" class="form-control" id="nama-add" placeholder="Nama Gejala" value="">
            </div>
            <div class="form-group">
              <label for="deskripsi-add">Deskripsi</label>
              <div id="deskripsi-add"></div>
            </div>
            <div class="form-group">
              <label for="solusi-add">Solusi</label>
              <div id="solusi-add"></div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="nama">Tanaman</label>
                <select class="form-control" id="tanaman-add">
                  <option value="">Pilih Tanaman</option>
                </select>
              </div>
              <div class="form-group col-md-6">
                <label for="organ-terserang-add">Organisme</label>
                <select class="form-control" id="organisme-add">
                  <option value="">Pilih Organisme</option>
                </select>
              </div>
            </div>
            <div class="form-group d-none" id="gejala-box-add">
              <label for="gejala-add">Gejala</label>
              <div class="form-group">
                <div class="form-row">
                  <div class="form-group col-md-4">
                    <select class="form-control" id="data-organ-add">
                    </select>
                  </div>
                  <div class="form-group col-md-8">
                    <input type="text" class="form-control" id="search-gejala-add" placeholder="Cari...">
                  </div>
                </div>
                <div id="show-gejala-add"></div>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="nama">Kategori</label>
                <select class="form-control" id="kategori-add">
                  <option value="">Pilih Kategori</option>
                </select>
              </div>
              <div class="form-group col-md-6">
                <label for="nama">Gambar</label>
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
            <h5 class="modal-title" id="modal-edit-title">Edit OPT</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <input type="hidden" class="form-control" id="id-opt-edit" value="">

            <div class="form-group">
              <label for="nama-add">Nama</label>
              <input type="text" class="form-control" id="nama-edit" placeholder="Nama Gejala" value="">
            </div>
            <div class="form-group">
              <label for="deskripsi-edit">Deskripsi</label>
              <div id="deskripsi-edit"></div>
            </div>
            <div class="form-group">
              <label for="solusi-add">Solusi</label>
              <div id="solusi-edit"></div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="nama">Tanaman</label>
                <select class="form-control" id="tanaman-edit">
                  <option value="">Pilih Tanaman</option>
                </select>
              </div>
              <div class="form-group col-md-6">
                <label for="organ-terserang-add">Organisme</label>
                <select class="form-control" id="organisme-edit">
                  <option value="">Pilih Organisme</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="gejala-before">Nama Gejala</label>
              <ul id="gejala-before"></ul>
              <input type="hidden" id='value-gejala-before' value="">
            </div>
            <div class="form-group d-none" id="gejala-box-edit">
              <label for="gejala-add">Gejala</label>
              <div class="form-group">
                <div class="form-row">
                  <div class="form-group col-md-4">
                    <select class="form-control" id="data-organ-edit">
                    </select>
                  </div>
                  <div class="form-group col-md-8">
                    <input type="text" class="form-control" id="search-gejala-edit" placeholder="Cari...">
                  </div>
                </div>
                <div id="show-gejala-edit"></div>
                <small class="text-danger">*jangan pilih apapun jika tidak ingin mengganti gejala.</small>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="nama">Kategori</label>
                <select class="form-control" id="kategori-edit">
                  <option value="">Pilih Kategori</option>
                </select>
              </div>
              <div class="form-group col-md-6">
                <label for="nama">Gambar</label>
                <input type="file" class="form-control-file p-1" id="img-edit">
                <small class="text-danger">*kosongi jika tidak ingin mengganti gambar.</small>
              </div>
            </div>
            <div class="form-group">
              <label for="img-show">Gambar Sebelumnya</label>
              <img id="img-show" alt="gambar_berita" class="w-100">
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
            <input type="hidden" class="form-control" id="id-opt-delete" value="">
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
<script src="<?php echo base_url().'assets/js/pages/opt/data.js'?>"></script>
