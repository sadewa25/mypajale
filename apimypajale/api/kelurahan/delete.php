<?php

  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Methods: POST");
  header("Access-Control-Max-Age: 3600");
  header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

  require_once '../../dbhelper/connection.php';
  require_once '../../dbhelper/kelurahan/Kelurahan.php';

  $kelurahan = new Kelurahan($dbh);

  $id = $_POST['id_kel'];

  if (!empty($id)){
    $kelurahan->id_kel = $id;

    if ($kelurahan->delete()) {
      http_response_code(200);
      echo json_encode(array("value" => 1, "message" => "kelurahan berhasil dihapus"));

    } else {
      http_response_code(503);
      echo json_encode(array("value" => 0,"message" => "Gagal menghapus kelurahan"));

    }

  } else {
    http_response_code(400);
    echo json_encode(array("value" => 0,"message" => "Gagal menghapus kelurahan. Data tidak lengkap"));

  }

 ?>
