<?php

  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Methods: POST");
  header("Access-Control-Max-Age: 3600");
  header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

  require_once '../../dbhelper/connection.php';
  require_once '../../dbhelper/kategori-tips/KategoriTips.php';

  $kategori = new KategoriTips($dbh);

  $id = $_POST['id_kategori_tips'];
  $nama = $_POST['nama_kategori_tips'];
  $keterangan = $_POST['keterangan_kategori_tips'];

  if (!empty($id) && !empty($nama)){
    $kategori->id_kategori_tips = $id;
    $kategori->nama_kategori_tips = $nama;
    $kategori->keterangan_kategori_tips = $keterangan;

    if ($kategori->update()) {
      http_response_code(200);
      echo json_encode(array("value" => 1, "message" => "Kategori tips berhasil dirubah"));

    } else {
      http_response_code(503);
      echo json_encode(array("value" => 0, "message" => "Gagal merubah kategori tips"));

    }

  } else {
    http_response_code(400);
    echo json_encode(array("value" => 0, "message" => "Gagal merubah kategori tips. Data tidak lengkap"));

  }

 ?>
