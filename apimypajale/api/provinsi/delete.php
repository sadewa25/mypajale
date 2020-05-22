<?php

  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Methods: POST");
  header("Access-Control-Max-Age: 3600");
  header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

  require_once '../../dbhelper/connection.php';
  require_once '../../dbhelper/provinsi/Provinsi.php';

  $provinsi = new Provinsi($dbh);

  $id = $_POST['id_prov'];

  if (!empty($id)){
    $provinsi->id_prov = $id;

    if ($provinsi->delete()) {
      http_response_code(200);
      echo json_encode(array("value" => 1, "message" => "Provinsi berhasil dihapus"));

    } else {
      http_response_code(503);
      echo json_encode(array("value" => 0,"message" => "Gagal menghapus provinsi"));

    }

  } else {
    http_response_code(400);
    echo json_encode(array("value" => 0,"message" => "Gagal menghapus provinsi. Data tidak lengkap"));

  }

 ?>
