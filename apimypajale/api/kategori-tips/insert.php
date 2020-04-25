<?php

  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Methods: POST");
  header("Access-Control-Max-Age: 3600");
  header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

  require_once '../../dbhelper/connection.php';
  require_once '../../dbhelper/kategori-tips/KategoriTips.php';

  $kategori = new KategoriTips($dbh);

  $nama = $_POST['nama_kategori_tips'];
  $keterangan = $_POST['keterangan_kategori_tips'];

  if (!empty($nama)){
    $kategori->nama_kategori_tips = $nama;
    $kategori->keterangan_kategori_tips = $keterangan;

    if ($kategori->insert()) {
      http_response_code(201);
      echo json_encode(array("value" => 1, "message" => "Kategori tips berhasil ditambahkan"));

    } else {
      http_response_code(503);
      echo json_encode(array("value" => 0, "message" => "Gagal menambahkan kategori tips"));

    }

  } else {
    http_response_code(400);
    echo json_encode(array("value" => 0, "message" => "Gagal menambahkan kategori tips. Data tidak lengkap"));

  }

 ?>
