<?php

  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Methods: POST");
  header("Access-Control-Max-Age: 3600");
  header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

  require_once '../../dbhelper/connection.php';
  require_once '../../dbhelper/kategori-opt/KategoriOPT.php';

  $kategori = new KategoriOPT($dbh);

  $nama = $_POST['nama'];

  if (!empty($nama)){
    $kategori->nama = $nama;

    if ($kategori->insert()) {
      http_response_code(201);
      echo json_encode(array("value" => 1, "message" => "Kategori OPT berhasil ditambahkan"));

    } else {
      http_response_code(503);
      echo json_encode(array("value" => 0, "message" => "Gagal menambahkan kategori OPT"));

    }

  } else {
    http_response_code(400);
    echo json_encode(array("value" => 0, "message" => "Gagal menambahkan kategori OPT. Data tidak lengkap"));

  }

 ?>
