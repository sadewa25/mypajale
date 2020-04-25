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

  if (!empty($nama)){
    $organisme->nama = $nama;

    if ($organisme->insert()) {
      http_response_code(201);
      echo json_encode(array("value" => 1,"message" => "Organisme berhasil ditambahkan"));

    } else {
      http_response_code(503);
      echo json_encode(array("value" => 0,"message" => "Gagal menambahkan organisme"));

    }

  } else {
    http_response_code(400);
    echo json_encode(array("value" => 0,"message" => "Gagal menambahkan organisme. Data tidak lengkap"));

  }

 ?>
