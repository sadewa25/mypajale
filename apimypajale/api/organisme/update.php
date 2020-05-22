<?php

  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Methods: POST");
  header("Access-Control-Max-Age: 3600");
  header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

  require_once '../../dbhelper/connection.php';
  require_once '../../dbhelper/organisme/Organisme.php';

  $organisme = new Organisme($dbh);
  $nama = $_POST['nama'];
  $id = $_POST['id_organisme'];

  if (!empty($id) && !empty($nama)){
    $organisme->id = $id;
    $organisme->nama = $nama;

    if ($organisme->update()) {
      http_response_code(200);
      echo json_encode(array("value" => 1,"message" => "Organisme berhasil dirubah"));

    } else {
      http_response_code(503);
      echo json_encode(array("value" => 0,"message" => "Gagal merubah organisme"));

    }

  } else {
    http_response_code(400);
    echo json_encode(array("value" => 0,"message" => "Gagal merubah organisme. Data tidak lengkap"));

  }

 ?>
