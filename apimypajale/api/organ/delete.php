<?php

  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Methods: POST");
  header("Access-Control-Max-Age: 3600");
  header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

  require_once '../../dbhelper/connection.php';
  require_once '../../dbhelper/organ/Organ.php';

  $organ = new Organ($dbh);

  $id = $_POST['id_organ'];

  if (!empty($id)){
    $organ->id = $id;

    if ($organ->delete()) {
      http_response_code(200);
      echo json_encode(array("value" => 1,"message" => "Organ tanaman berhasil dihapus"));

    } else {
      http_response_code(503);
      echo json_encode(array("value" => 0,"message" => "Gagal menghapus organ tanaman"));

    }

  } else {
    http_response_code(400);
    echo json_encode(array("value" => 0,"message" => "Gagal menghapus organ tanaman. Data tidak lengkap"));

  }

 ?>
