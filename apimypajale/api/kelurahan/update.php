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
  $id_kel = $_POST['id_kel'];

  if (!empty($id_kec) && !empty($nama) && !empty($id_jenis) && !empty($id_kel)){
    $kelurahan->id_kec = $id_kec;
    $kelurahan->nama = $nama;
    $kelurahan->ie_jenis = $id_jenis;
    $kelurahan->id_kel = $id_kel;

    if ($kelurahan->update()) {
      http_response_code(201);
      echo json_encode(array("value" => 1,"message" => "kelurahan berhasil diperbarui"));

    } else {
      http_response_code(503);
      echo json_encode(array("value" => 0,"message" => "Gagal memperbarui kelurahan"));

    }

  } else {
    http_response_code(400);
    echo json_encode(array("value" => 0,"message" => "Gagal memperbarui kelurahan. Data tidak lengkap"));

  }

 ?>
