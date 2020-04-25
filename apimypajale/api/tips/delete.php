<?php

  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Methods: POST");
  header("Access-Control-Max-Age: 3600");
  header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

  require_once '../../dbhelper/connection.php';
  require_once '../../dbhelper/tips/Tips.php';

  $tips = new Tips($dbh);

  $id_tips = $_POST['id_tips'];

  if (!empty($id_tips)){
    $tips->id_tips = $id_tips;

    if ($tips->delete()) {
      http_response_code(200);
      echo json_encode(array("value" => 1, "message" => "tips berhasil dihapus"));

    } else {
      http_response_code(503);
      echo json_encode(array("value" => 0, "message" => "Gagal menghapus tips"));

    }

  } else {
    http_response_code(400);
    echo json_encode(array("value" => 0,"message" => "Gagal menghapus tips. Data tidak lengkap"));

  }

 ?>
