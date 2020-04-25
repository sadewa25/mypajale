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
  $id_kec = $_POST['id_kec'];

  if (!empty($id_kab) && !empty($nama) && !empty($id_kec)){
    $kecamatan->id_kab = $id_kab;
    $kecamatan->nama = $nama;
    $kecamatan->id_kec = $id_kec;

    if ($kecamatan->update()) {
      http_response_code(201);
      echo json_encode(array("value" => 1,"message" => "kecamatan berhasil diperbarui"));

    } else {
      http_response_code(503);
      echo json_encode(array("value" => 0,"message" => "Gagal memperbarui kecamatan"));

    }

  } else {
    http_response_code(400);
    echo json_encode(array("value" => 0,"message" => "Gagal memperbarui kecamatan. Data tidak lengkap"));

  }

 ?>
