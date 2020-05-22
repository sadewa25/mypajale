<?php

  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Methods: POST");
  header("Access-Control-Max-Age: 3600");
  header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

  require_once '../../dbhelper/connection.php';
  require_once '../../dbhelper/laporan-opt/LaporanOPT.php';

  $laporan = new LaporanOPT($dbh);

  $id_user = $_POST['id_user'];
  $judul_laporan = $_POST['judul_laporan'];
  $id_penyakit = $_POST['id_penyakit'];
  $id_kab = $_POST['id_kab'];
  $id_kec = $_POST['id_kec'];
  $desa = $_POST['desa'];
  $nama_kelompok_tani = $_POST['nama_kelompok_tani'];
  $id_jenis_tanaman = $_POST['id_jenis_tanaman'];
  $varietas = $_POST['varietas'];
  $umur = $_POST['umur'];
  $intensitas_serangan = $_POST['intensitas_serangan'];
  $luas_terserang = $_POST['luas_terserang'];
  $luas_hamparan = $_POST['luas_hamparan'];
  $gambar = $_POST['gambar'];
  $tanggal = $_POST['tanggal'];
  $jenis_musuh_alami = $_POST['jenis_musuh_alami'];
  $kesimpulan = $_POST['kesimpulan'];
  $rekomendasi = $_POST['rekomendasi'];

  if (!empty($id_user) &&
      !empty($id_penyakit) &&
      !empty($id_kab) &&
      !empty($id_kec) &&
      !empty($id_jenis_tanaman)){

        $laporan->id_user = $id_user;
        $laporan->judul_laporan = $judul_laporan;
        $laporan->id_penyakit = $id_penyakit;
        $laporan->id_kab = $id_kab;
        $laporan->id_kec = $id_kec;
        $laporan->desa = $desa;
        $laporan->nama_kelompok_tani = $nama_kelompok_tani;
        $laporan->id_jenis_tanaman = $id_jenis_tanaman;
        $laporan->varietas = $varietas;
        $laporan->umur = $umur;
        $laporan->intensitas_serangan = $intensitas_serangan;
        $laporan->luas_tersrang = $luas_terserang;
        $laporan->luas_hamparan = $luas_hamparan;
        $laporan->gambar = $gambar;
        $laporan->tanggal = $tanggal;
        $laporan->jenis_musuh_alami = $jenis_musuh_alami;
        $laporan->kesimpulan = $kesimpulan;
        $laporan->rekomendasi = $rekomendasi;

    if ($laporan->insert()) {
      http_response_code(201);
      echo json_encode(array("value" => 1, "message" => "laporan berhasil ditambahkan"));

    } else {
      http_response_code(503);
      echo json_encode(array("value" => 0, "message" => "Gagal menambahkan laporan"));

    }

  } else {
    http_response_code(400);
    echo json_encode(array("value" => 0, "message" => "Gagal menambahkan laporan. Data tidak lengkap"));

  }

 ?>
