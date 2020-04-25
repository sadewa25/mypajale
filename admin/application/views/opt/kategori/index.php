<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap flex-column align-items-left pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Data Kategori OPT
      <button class="float-right btn btn-success btn-sm" id="add-btn"><span class="fas fa-plus-square h6 mr-1"></span>Tambah</button>
    </h1>
    <table class="table table-striped w-100" id="mydata">
      <thead>
        <tr>
            <th>Nama</th>
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
          <div class="modal-header">
            <h5 class="modal-title">Tambah Kategori OPT</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="nama">Nama</label>
              <input type="text" class="form-control" id="nama-add" placeholder="Nama Tanaman" value="">
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
          <div class="modal-header">
            <h5 class="modal-title">Edit Kategori OPT</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <input type="hidden" class="form-control" id="id-kategori-edit" value="">
            <div class="form-group">
              <label for="nama">Nama</label>
              <input type="text" class="form-control" id="nama-edit" placeholder="Nama Tanaman" value="">
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
          <div class="modal-header">
            <h5 class="modal-title">Konfirmasi</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <input type="hidden" class="form-control" id="id-kategori-delete" value="">
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
<script src="<?php echo base_url().'assets/js/pages/opt/kategori.js'?>"></script>
