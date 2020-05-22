<?php

  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Methods: POST");
  header("Access-Control-Max-Age: 3600");
  header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

  require_once '../../dbhelper/connection.php';
  require_once '../../dbhelper/tanaman/Tanaman.php';

  $tanaman = new Tanaman($dbh);

  $id = $_POST['id_tanaman'];

  if (!empty($id)){
    $tanaman->id = $id;

    if ($tanaman->delete()) {
      http_response_code(200);
      echo json_encode(array("value" => 1,"message" => "Tanaman berhasil dihapus"));

    } else {
      http_response_code(503);
      echo json_encode(array("value" => 0,"message" => "Gagal menghapus tanaman"));

    }

  } else {
    http_response_code(400);
    echo json_encode(array("value" => 0,"message" => "Gagal menghapus tanaman. Data tidak lengkap"));

  }

 ?>
