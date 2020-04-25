<?php

  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Methods: POST");
  header("Access-Control-Max-Age: 3600");
  header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

  require_once '../../dbhelper/connection.php';
  require_once '../../dbhelper/provinsi/Provinsi.php';

  $provinsi = new Provinsi($dbh);

  $nama = $_POST['nama'];
  $id_prov = $_POST['id_prov'];

  if (!empty($nama) && !empty($id_prov)){
    $provinsi->nama = $nama;
    $provinsi->id_prov = $id_prov;

    if ($provinsi->update()) {
      http_response_code(201);
      echo json_encode(array("value" => 1,"message" => "provinsi berhasil diperbarui"));

    } else {
      http_response_code(503);
      echo json_encode(array("value" => 0,"message" => "Gagal memperbarui provinsi"));

    }

  } else {
    http_response_code(400);
    echo json_encode(array("value" => 0,"message" => "Gagal memperbarui provinsi. Data tidak lengkap"));

  }

 ?>
