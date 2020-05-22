<?php

  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Methods: POST");
  header("Access-Control-Max-Age: 3600");
  header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

  require_once '../../dbhelper/connection.php';
  require_once '../../dbhelper/status-user/StatusUser.php';

  $status = new StatusUser($dbh);

  $nama_status_user = $_POST['nama_status_user'];

  if (!empty($nama_status_user)){
    $status->nama_status_user = $nama_status_user;

    if ($status->insert()) {
      http_response_code(201);
      echo json_encode(array("value" => 1,"message" => "status berhasil ditambahkan"));

    } else {
      http_response_code(503);
      echo json_encode(array("value" => 0,"message" => "Gagal menambahkan status"));

    }

  } else {
    http_response_code(400);
    echo json_encode(array("value" => 0,"message" => "Gagal menambahkan status. Data tidak lengkap"));

  }

 ?>
