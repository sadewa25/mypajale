<?php

  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Methods: POST");
  header("Access-Control-Max-Age: 3600");
  header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

  require_once '../../dbhelper/connection.php';
  require_once '../../dbhelper/kecamatan/Kecamatan.php';

  $kecamatan = new Kecamatan($dbh);

  $id_kab = $_POST['id_kab'];
  $nama = $_POST['nama'];

  if (!empty($id_kab) && !empty($nama)){
    $kecamatan->id_kab = $id_kab;
    $kecamatan->nama = $nama;
    
    if ($kecamatan->insert()) {
      http_response_code(201);
      echo json_encode(array("value" => 1,"message" => "kecamatan berhasil ditambahkan"));

    } else {
      http_response_code(503);
      echo json_encode(array("value" => 0,"message" => "Gagal menambahkan kecamatan"));

    }

  } else {
    http_response_code(400);
    echo json_encode(array("value" => 0,"message" => "Gagal menambahkan kecamatan. Data tidak lengkap"));

  }

 ?>
