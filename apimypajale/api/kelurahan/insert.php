<?php

  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Methods: POST");
  header("Access-Control-Max-Age: 3600");
  header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

  require_once '../../dbhelper/connection.php';
  require_once '../../dbhelper/kelurahan/Kelurahan.php';

  $kelurahan = new Kelurahan($dbh);

  $id_kec = $_POST['id_kec'];
  $nama = $_POST['nama'];
  $id_jenis = $_POST['id_jenis'];

  if (!empty($id_kec) && !empty($nama) && !empty($id_jenis)){
    $kelurahan->id_kec = $id_kec;
    $kelurahan->nama = $nama;
    $kelurahan->id_jenis = $id_jenis;

    if ($kelurahan->insert()) {
      http_response_code(201);
      echo json_encode(array("value" => 1,"message" => "kelurahan berhasil ditambahkan"));

    } else {
      http_response_code(503);
      echo json_encode(array("value" => 0,"message" => "Gagal menambahkan kelurahan"));

    }

  } else {
    http_response_code(400);
    echo json_encode(array("value" => 0,"message" => "Gagal menambahkan kelurahan. Data tidak lengkap"));

  }

 ?>
