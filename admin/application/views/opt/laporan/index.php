<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap flex-column align-items-left pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Data Laporan
      <button class="float-right btn btn-success btn-sm" id="add-btn"><span class="fas fa-plus-square h6 mr-1"></span>Tambah</button>
    </h1>
    <table class="table table-striped w-100" id="mydata">
      <thead>
        <tr>
            <th>Judul</th>
            <th>Tanaman</th>
            <th>Pelapor</th>
            <th>Kecamatan</th>
            <th>Kabupaten</th>
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
          <div class="modal-header bg-primary">
            <h5 class="modal-title">Tambah laporan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="judul-add">Judul</label>
              <input type="text" class="form-control" id="judul-add" placeholder="Judul laporan" value="">
            </div>
            <div class="form-row">
              <div class="form-group col-sm-6">
                <label for="kab-add">Kabupaten</label>
                <select id="kab-add" class="form-control">
                  <option value="">Pilih Kabupaten</option>
                </select>
              </div>
              <div class="form-group col-sm-6">
                <label for="kec-add">Kecamatan</label>
                <select id="kec-add" class="form-control" disabled>
                  <option value="">Pilih Kecamatan</option>
                </select>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-sm-6">
                <label for="desa-add">Desa</label>
                <input type="text" class="form-control" id="desa-add" placeholder="Nama desa" value="">
              </div>
              <div class="form-group col-sm-6">
                <label for="tanaman-add">Tanaman</label>
                <select class="form-control" id="tanaman-add">
                  <option value="">Pilih Tanaman</option>
                </select>
              </div>
            </div>
            <div class="form-group d-none" id="opt-box-add">
              <label for="opt-add">OPT</label>
              <input type="text" class="form-control" id="search-opt-add" placeholder="Cari...">
              <div id="show-opt-add" class="mt-2"></div>
            </div>
            <div class="form-row">
              <div class="form-group col-sm-6">
                <label for="nama-tani-add">Kelompok Tani</label>
                <input type="text" class="form-control" id="nama-tani-add" placeholder="Nama kelompok tani...">
              </div>
              <div class="form-group col-sm-6">
                <label for="varietas-add">Varietas</label>
                <input type="text" class="form-control" id="varietas-add" placeholder="Varietas...">
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-sm-6">
                <label for="umur-add">Umur</label>
                <input type="text" class="form-control" id="umur-add" placeholder="Umur...">
              </div>
              <div class="form-group col-sm-6">
                <label for="intensitas-add">Intensitas Serangan</label>
                <input type="text" class="form-control" id="intensitas-add" placeholder="Intensitas serangan...">
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-sm-6">
                <label for="terserang-add">Luas Terserang</label>
                <input type="text" class="form-control" id="terserang-add" placeholder="Luas terserang...">
              </div>
              <div class="form-group col-sm-6">
                <label for="hamparan-add">Luas Hamparan</label>
                <input type="text" class="form-control" id="hamparan-add" placeholder="Luas hamparan...">
              </div>
            </div>
            <div class="form-group">
              <label for="musuh-add">Jenis Musuh Alami</label>
              <input type="text" class="form-control" id="musuh-add" placeholder="Nama musuh...">
            </div>
            <div class="form-group">
              <label for="kesimpulan-add">Kesimpulan</label>
              <div id="kesimpulan-add"></div>
            </div>
            <div class="form-group">
              <label for="rekomendasi-add">Rekomendasi</label>
              <div id="rekomendasi-add"></div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="organ-terserang-add">Tanggal</label>
                <input type="date" class="form-control" id="tgl-add">
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
          <div class="modal-header">
            <h5 class="modal-title">Edit Laporan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <input type="hidden" id="id-laporan-edit" value="">
            <input type="hidden" id="id-opt-edit" value="">
            <div class="form-group">
              <label for="judul-add">Judul</label>
              <input type="text" class="form-control" id="judul-edit" placeholder="Judul laporan" value="">
            </div>
            <div class="form-row">
              <div class="form-group col-sm-6">
                <label for="kab-edit">Kabupaten</label>
                <select id="kab-edit" class="form-control">
                  <option value="">Pilih Kabupaten</option>
                </select>
              </div>
              <div class="form-group col-sm-6">
                <label for="kec-edit">Kecamatan</label>
                <select id="kec-edit" class="form-control">
                  <option value="">Pilih Kecamatan</option>
                </select>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-sm-6">
                <label for="desa-edit">Desa</label>
                <input type="text" class="form-control" id="desa-edit" placeholder="Nama desa" value="">
              </div>
              <div class="form-group col-sm-6">
                <label for="tanaman-edit">Tanaman</label>
                <select class="form-control" id="tanaman-edit">
                  <option value="">Pilih Tanaman</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="gejala-before">Nama OPT</label>
              <br>
              <span id="nama-opt"></span>
            </div>
            <div class="form-group d-none" id="opt-box-edit">
              <label for="opt-edit">OPT</label><small class="text-danger">*jangan pilih apapun jika tidak ingin mengganti opt.</small>
              <input type="text" class="form-control" id="search-opt-edit" placeholder="Cari...">
              <div id="show-opt-edit" class="mt-2"></div>
            </div>
            <div class="form-row">
              <div class="form-group col-sm-6">
                <label for="nama-tani-edit">Kelompok Tani</label>
                <input type="text" class="form-control" id="nama-tani-edit" placeholder="Nama kelompok tani...">
              </div>
              <div class="form-group col-sm-6">
                <label for="varietas-edit">Varietas</label>
                <input type="text" class="form-control" id="varietas-edit" placeholder="Varietas...">
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-sm-6">
                <label for="umur-edit">Umur</label>
                <input type="text" class="form-control" id="umur-edit" placeholder="Umur...">
              </div>
              <div class="form-group col-sm-6">
                <label for="intensitas-edit">Intensitas Serangan</label>
                <input type="text" class="form-control" id="intensitas-edit" placeholder="Intensitas serangan...">
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-sm-6">
                <label for="terserang-edit">Luas Terserang</label>
                <input type="text" class="form-control" id="terserang-edit" placeholder="Luas terserang...">
              </div>
              <div class="form-group col-sm-6">
                <label for="hamparan-edit">Luas Hamparan</label>
                <input type="text" class="form-control" id="hamparan-edit" placeholder="Luas hamparan...">
              </div>
            </div>
            <div class="form-group">
              <label for="musuh-add">Jenis Musuh Alami</label>
              <input type="text" class="form-control" id="musuh-edit" placeholder="Nama musuh...">
            </div>
            <div class="form-group">
              <label for="kesimpulan-edit">Kesimpulan</label>
              <div id="kesimpulan-edit"></div>
            </div>
            <div class="form-group">
              <label for="rekomendasi-edit">Rekomendasi</label>
              <div id="rekomendasi-edit"></div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="organ-terserang-edit">Tanggal</label>
                <input type="date" class="form-control" id="tgl-edit">
              </div>
              <div class="form-group col-md-6">
                <label for="img-edit">Gambar</label>
                <input type="file" class="form-control-file p-1" id="img-edit">
                <small class="text-danger">*kosongi jika tidak ingin mengganti gambar.</small>
              </div>
            </div>
            <div class="form-group">
              <label for="img-show">Gambar Sebelumnya</label>
              <span id="img-name" class="d-none"></span>
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
          <div class="modal-header">
            <h5 class="modal-title">Konfirmasi</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <input type="hidden" class="form-control" id="id-laporan-delete" value="">
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
<script src="<?php echo base_url().'assets/js/pages/opt/laporan.js'?>"></script>
